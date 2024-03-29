<?php
/**
 * @package			Advanced Module Manager
 * @version			0.0.0
 *
 * @author			Peter van Westen <peter@nonumber.nl>
 * @link			http://www.nonumber.nl
 * @copyright		Copyright © 2011 All Rights Reserved
 *					Brandon IT Consulting (http://www.metamodpro.com)
 *					NoNumber! (http://www.nonumber.nl)
 *					JoomlArt (http://www.joomlart.com)
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

/**
 * BASE ON JOOMLA CORE FILE:
 * /libraries/joomla/application/module/helper.php
 */

/**
 * @package     Joomla.Platform
 * @subpackage  Application
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

// No direct access
defined('JPATH_PLATFORM') or defined('JPATH_BASE') or die;

jimport('joomla.application.component.helper');

/**
 * Module helper class
 *
 * @package     Joomla.Platform
 * @subpackage  Application
 * @since       11.1
 */
abstract class JModuleHelper
{
	/**
	 * Get module by name (real, eg 'Breadcrumbs' or folder, eg 'mod_breadcrumbs')
	 *
	 * @param   string  $name   The name of the module
	 * @param   string  $title  The title of the module, optional
	 *
	 * @return  object  The Module object
	 *
	 * @since   11.1
	 */
	public static function &getModule($name, $title = null)
	{
		$result = null;
		$modules =& JModuleHelper::_load();
		$total = count($modules);

		for ($i = 0; $i < $total; $i++)
		{
			// Match the name of the module
			if ($modules[$i]->name == $name || $modules[$i]->module == $name)
			{
				// Match the title if we're looking for a specific instance of the module
				if (!$title || $modules[$i]->title == $title)
				{
					// Found it
					$result = &$modules[$i];
					break; // Found it
				}
			}
		}

		// If we didn't find it, and the name is mod_something, create a dummy object
		if (is_null($result) && substr($name, 0, 4) == 'mod_')
		{
			$result            = new stdClass;
			$result->id        = 0;
			$result->title     = '';
			$result->module    = $name;
			$result->position  = '';
			$result->content   = '';
			$result->showtitle = 0;
			$result->control   = '';
			$result->params    = '';
			$result->user      = 0;
		}

		return $result;
	}

	/**
	 * Get modules by position
	 *
	 * @param   string  $position  The position of the module
	 *
	 * @return  array  An array of module objects
	 *
	 * @since   11.1
	 */
	public static function &getModules($position)
	{
		$position = strtolower($position);
		$result = array();

		$modules =& JModuleHelper::_load();

		$total = count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			if ($modules[$i]->position == $position)
			{
				$result[] = &$modules[$i];
			}
		}

		if (count($result) == 0)
		{
			if (JRequest::getBool('tp') && JComponentHelper::getParams('com_templates')->get('template_positions_display'))
			{
				$result[0] = JModuleHelper::getModule('mod_' . $position);
				$result[0]->title = $position;
				$result[0]->content = $position;
				$result[0]->position = $position;
			}
		}

		return $result;
	}

	/**
	 * Checks if a module is enabled
	 *
	 * @param   string  $module  The module name
	 *
	 * @return  boolean
	 *
	 * @since   11.1
	 */
	public static function isEnabled($module)
	{
		$result = JModuleHelper::getModule($module);

		return !is_null($result);
	}

	/**
	 * Render the module.
	 *
	 * @param   object  $module   A module object.
	 * @param   array   $attribs  An array of attributes for the module (probably from the XML).
	 *
	 * @return  string  The HTML content of the module output.
	 *
	 * @since   11.1
	 */
	public static function renderModule($module, $attribs = array())
	{
		static $chrome;

		if (constant('JDEBUG'))
		{
			JProfiler::getInstance('Application')->mark('beforeRenderModule ' . $module->module . ' (' . $module->title . ')');
		}

		$app = JFactory::getApplication();

		// Record the scope.
		$scope = $app->scope;

		// Set scope to component name
		$app->scope = $module->module;

		// Get module parameters
		$params = new JRegistry;
		$params->loadString($module->params);

		// Get module path
		$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);
		$path = JPATH_BASE . '/modules/' . $module->module . '/' . $module->module . '.php';

		// Load the module
		// $module->user is a check for 1.0 custom modules and is deprecated refactoring
		if (empty($module->user) && file_exists($path))
		{
			$lang = JFactory::getLanguage();
			// 1.5 or Core then 1.6 3PD
			$lang->load($module->module, JPATH_BASE, null, false, false) ||
				$lang->load($module->module, dirname($path), null, false, false) ||
				$lang->load($module->module, JPATH_BASE, $lang->getDefault(), false, false) ||
				$lang->load($module->module, dirname($path), $lang->getDefault(), false, false);

			$content = '';
			ob_start();
			include $path;
			$module->content = ob_get_contents() . $content;
			ob_end_clean();
		}

		// Load the module chrome functions
		if (!$chrome)
		{
			$chrome = array();
		}

		include_once JPATH_THEMES . '/system/html/modules.php';
		$chromePath = JPATH_THEMES . '/' . $app->getTemplate() . '/html/modules.php';

		if (!isset($chrome[$chromePath]))
		{
			if (file_exists($chromePath))
			{
				include_once $chromePath;
			}

			$chrome[$chromePath] = true;
		}

		// Make sure a style is set
		if (!isset($attribs['style']))
		{
			$attribs['style'] = 'none';
		}

		// Dynamically add outline style
		if (JRequest::getBool('tp') && JComponentHelper::getParams('com_templates')->get('template_positions_display'))
		{
			$attribs['style'] .= ' outline';
		}

		// Do 3rd party stuff to manipulate module content
		// onRenderModule is allowed to alter the $module, $attribs
		// and may return a boolean.
		// true=remove, any other value = keep.
		// $result holds an array of booleans, 1 from each plugin.
		// we ditch the module if any of them = true.
		$result = $app->triggerEvent( 'onRenderModule', array( &$module, &$attribs ) );
		if ( array_search( true, $result, true ) !== false )
		{
			return '';
		}

		foreach (explode(' ', $attribs['style']) as $style)
		{
			$chromeMethod = 'modChrome_' . $style;

			// Apply chrome and render module
			if (function_exists($chromeMethod))
			{
				$module->style = $attribs['style'];

				ob_start();
				$chromeMethod($module, $params, $attribs);
				$module->content = ob_get_contents();
				ob_end_clean();
			}
		}

		//revert the scope
		$app->scope = $scope;

		if (constant('JDEBUG'))
		{
			JProfiler::getInstance('Application')->mark('afterRenderModule ' . $module->module . ' (' . $module->title . ')');
		}

		return $module->content;
	}

	/**
	 * Get the path to a layout for a module
	 *
	 * @param   string  $module  The name of the module
	 * @param   string  $layout  The name of the module layout. If alternative layout, in the form template:filename.
	 *
	 * @return  string  The path to the module layout
	 *
	 * @since   11.1
	 */
	public static function getLayoutPath($module, $layout = 'default')
	{
		$template = JFactory::getApplication()->getTemplate();
		$defaultLayout = $layout;

		if (strpos($layout, ':') !== false)
		{
			// Get the template and file name from the string
			$temp = explode(':', $layout);
			$template = ($temp[0] == '_') ? $template : $temp[0];
			$layout = $temp[1];
			$defaultLayout = ($temp[1]) ? $temp[1] : 'default';
		}

		// Build the template and base path for the layout
		$tPath = JPATH_THEMES . '/' . $template . '/html/' . $module . '/' . $layout . '.php';
		$bPath = JPATH_BASE . '/modules/' . $module . '/tmpl/' . $defaultLayout . '.php';

		// Do 3rd party stuff to detect layout path for the module
		// onGetLayoutPath should return the path to the $layout of $module or false
		// $results holds an array of results returned from plugins, 1 from each plugin.
		// if a path to the $layout is found and it is a file, return that path
		$app	= JFactory::getApplication();
		$result = $app->triggerEvent( 'onGetLayoutPath', array( $module, $layout ) );
		if (is_array($result))
		{
			foreach ($result as $path)
			{
				if ($path !== false && is_file ($path))
				{
					return $path;
				}
			}
		}

		// If the template has a layout override use it
		if (file_exists($tPath))
		{
			return $tPath;
		}
		else
		{
			return $bPath;
		}
	}

	/**
	 * Load published modules.
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	protected static function &_load()
	{
		static $clean;

		if (isset($clean))
		{
			return $clean;
		}

		$Itemid = JRequest::getInt('Itemid');
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$groups = implode(',', $user->getAuthorisedViewLevels());
		$lang = JFactory::getLanguage()->getTag();
		$clientId = (int) $app->getClientId();

		/*
		$cache = JFactory::getCache('com_modules', '');
		$cacheid = md5(serialize(array($Itemid, $groups, $clientId, $lang)));

		if (!($clean = $cache->get($cacheid)))
		{
		*/
			$db = JFactory::getDbo();

			$query = new stdClass();
			$query->select = array();
			$query->from = array();
			$query->join = array();
			$query->where = array();
			$query->order = array();

			$query->select[] = 'm.published, m.id, m.title, m.module, m.position, m.content, m.showtitle, m.params, mm.menuid';
			$query->from[] = '#__modules AS m';
			$query->join[] = '#__modules_menu AS mm ON mm.moduleid = m.id';
			$query->where[] = 'm.published = 1';

			$query->join[] = '#__extensions AS e ON e.element = m.module AND e.client_id = m.client_id';
			$query->where[] = 'e.enabled = 1';

			$date = JFactory::getDate();
			if ( version_compare( JVERSION, '2.5', 'l' ) )
			{
				$now = $date->toMySql();
			}
			else
			{
				$now = $date->toSql();
			}
			$nullDate = $db->getNullDate();
			$query->where[] = '(m.publish_up = ' . $db->Quote($nullDate) . ' OR m.publish_up <= ' . $db->Quote($now) . ')';
			$query->where[] = '(m.publish_down = ' . $db->Quote($nullDate) . ' OR m.publish_down >= ' . $db->Quote($now) . ')';

			$query->where[] = 'm.access IN ('.$groups.')';
			$query->where[] = 'm.client_id = ' . $clientId;
			$query->where[] = '(mm.menuid = ' . (int) $Itemid . ' OR mm.menuid <= 0)';

			// Filter by language
			if ($app->isSite() && $app->getLanguageFilter())
			{
				$query->where[] = 'm.language IN (' . $db->Quote($lang) . ',' . $db->Quote('*') . ')';
			}

			$query->order[] = 'm.position, m.ordering';

			// Do 3rd party stuff to change query
			$app->triggerEvent( 'onCreateModuleQuery', array( &$query ) );

			$q = $db->getQuery(true);
			// convert array object to query object
			foreach ( $query as $type => $strings )
			{
				foreach ( $strings as $string )
				{
					if ( $type == 'join' )
					{
						$q->{$type}( 'LEFT', $string );
					}
					else
					{
						$q->{$type}( $string );
					}
				}
			}

			// Set the query
			$db->setQuery($q);
			$modules = $db->loadObjectList();
			$clean = array();

			if ($db->getErrorNum())
			{
				JError::raiseWarning(500, JText::sprintf('JLIB_APPLICATION_ERROR_MODULE_LOAD', $db->getErrorMsg()));
				return $clean;
			}

			// Apply negative selections and eliminate duplicates
			$negId = $Itemid ? -(int) $Itemid : false;
			$dupes = array();
			for ($i = 0, $n = count($modules); $i < $n; $i++)
			{
				$module = &$modules[$i];

				// The module is excluded if there is an explicit prohibition or if
				// the Itemid is missing or zero and the module is in exclude mode.
				$negHit = ($negId === (int) $module->menuid) || (!$negId && (int) $module->menuid < 0);

				if (isset($dupes[$module->id]))
				{
					// If this item has been excluded, keep the duplicate flag set,
					// but remove any item from the cleaned array.
					if ($negHit)
					{
						unset($clean[$module->id]);
					}
					continue;
				}

				$dupes[$module->id] = true;

				// Only accept modules without explicit exclusions.
				if (!$negHit)
				{
					// Determine if this is a 1.0 style custom module (no mod_ prefix)
					// This should be eliminated when the class is refactored.
					// $module->user is deprecated.
					$file = $module->module;
					$custom = substr($file, 0, 4) == 'mod_' ?  0 : 1;
					$module->user = $custom;
					// 1.0 style custom module name is given by the title field, otherwise strip off "mod_"
					$module->name = $custom ? $module->module : substr($file, 4);
					$module->style = null;
					$module->position = strtolower($module->position);
					$clean[$module->id] = $module;
				}
			}

			unset($dupes);

			// Do 3rd party stuff to manipulate module array.
			// Any plugins using this architecture may make alterations to the referenced $modules array.
			// To remove items you can do unset($modules[n]) or $modules[n]->published = false.

			// "onPrepareModuleList" may alter or add $modules, and does not need to return anything.
			// This should be used for module addition/deletion that the user would expect to happen at an
			// early stage.
			$app->triggerEvent( 'onPrepareModuleList', array( &$clean ) );

			// "onAlterModuleList" may alter or add $modules, and does not need to return anything.
			$app->triggerEvent( 'onAlterModuleList', array( &$clean ) );

			// "onPostProcessModuleList" allows a plugin to perform actions like parameter changes
			// on the completed list of modules and is guaranteed to occur *after*
			// the earlier plugins.
			$app->triggerEvent( 'onPostProcessModuleList', array( &$clean ) );

			// Remove any that were marked as disabled during the preceding steps
			foreach ( $clean as $id => $module )
			{
				if ( !isset( $module->published ) || $module->published == 0 )
				{
					unset( $clean[$id] );
				}
			}


			// Return to simple indexing that matches the query order.
			$clean = array_values($clean);

			/*
			$cache->store($clean, $cacheid);
		}
		*/

		return $clean;
	}

	/**
	 * Module cache helper
	 *
	 * Caching modes:
	 * To be set in XML:
	 * 'static'      One cache file for all pages with the same module parameters
	 * 'oldstatic'   1.5 definition of module caching, one cache file for all pages
	 * with the same module id and user aid,
	 * 'itemid'      Changes on itemid change, to be called from inside the module:
	 * 'safeuri'     Id created from $cacheparams->modeparams array,
	 * 'id'          Module sets own cache id's
	 *
	 * @param   object  $module        Module object
	 * @param   object  $moduleparams  Module parameters
	 * @param   object  $cacheparams   Module cache parameters - id or url parameters, depending on the module cache mode
	 *
	 * @return  string
	 *
	 * @since   11.1
	 *
	 * @link JFilterInput::clean()
	 */
	public static function moduleCache($module, $moduleparams, $cacheparams)
	{
		if (!isset($cacheparams->modeparams))
		{
			$cacheparams->modeparams = null;
		}

		if (!isset($cacheparams->cachegroup))
		{
			$cacheparams->cachegroup = $module->module;
		}

		$user = JFactory::getUser();
		$cache = JFactory::getCache($cacheparams->cachegroup, 'callback');
		$conf = JFactory::getConfig();

		// Turn cache off for internal callers if parameters are set to off and for all logged in users
		if ($moduleparams->get('owncache', null) === '0' || $conf->get('caching') == 0 || $user->get('id'))
		{
			$cache->setCaching(false);
		}

		// module cache is set in seconds, global cache in minutes, setLifeTime works in minutes
		$cache->setLifeTime($moduleparams->get('cache_time', $conf->get('cachetime') * 60) / 60);

		$wrkaroundoptions = array('nopathway' => 1, 'nohead' => 0, 'nomodules' => 1, 'modulemode' => 1, 'mergehead' => 1);

		$wrkarounds = true;
		$view_levels = md5(serialize($user->getAuthorisedViewLevels()));

		switch ($cacheparams->cachemode)
		{
			case 'id':
				$ret = $cache->get(
					array($cacheparams->class, $cacheparams->method),
					$cacheparams->methodparams,
					$cacheparams->modeparams,
					$wrkarounds,
					$wrkaroundoptions
				);
				break;

			case 'safeuri':
				$secureid = null;
				if (is_array($cacheparams->modeparams))
				{
					$uri = JRequest::get();
					$safeuri = new stdClass;
					foreach ($cacheparams->modeparams as $key => $value)
					{
						// Use int filter for id/catid to clean out spamy slugs
						if (isset($uri[$key]))
						{
							$safeuri->$key = JRequest::_cleanVar($uri[$key], 0, $value);
						}
					}
				}
				$secureid = md5(serialize(array($safeuri, $cacheparams->method, $moduleparams)));
				$ret = $cache->get(
					array($cacheparams->class, $cacheparams->method),
					$cacheparams->methodparams,
					$module->id . $view_levels . $secureid,
					$wrkarounds,
					$wrkaroundoptions
				);
				break;

			case 'static':
				$ret = $cache->get(
					array($cacheparams->class,
						$cacheparams->method),
					$cacheparams->methodparams,
					$module->module . md5(serialize($cacheparams->methodparams)),
					$wrkarounds,
					$wrkaroundoptions
				);
				break;

			case 'oldstatic': // provided for backward compatibility, not really usefull
				$ret = $cache->get(
					array($cacheparams->class, $cacheparams->method),
					$cacheparams->methodparams,
					$module->id . $view_levels,
					$wrkarounds,
					$wrkaroundoptions
				);
				break;

			case 'itemid':
			default:
				$ret = $cache->get(
					array($cacheparams->class, $cacheparams->method),
					$cacheparams->methodparams,
					$module->id . $view_levels . JRequest::getVar('Itemid', null, 'default', 'INT'),
					$wrkarounds,
					$wrkaroundoptions
				);
				break;
		}

		return $ret;
	}
}