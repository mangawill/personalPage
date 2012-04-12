<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

// $mmpro_jversion = new JVersion();
// $mmpro_jminor_version = $mmpro_jversion->getShortVersion(); // e.g. 1.5.7
// we might want to change the module helper based on the version above

// don't load it for the administrator panel...
$mmpro_app		=& JFactory::getApplication();
if ( $mmpro_app->isSite() ) {
	$c = JLoader::register('JModuleHelper', dirname(__FILE__).'/overloaded/modulehelper.php');
	// we have to load immediately, otherwise the jimport() implementation in joomla
	// will revert back to the normal modulehelper path whenever it receives a
	// jimport("joomla.application.modules.helper") call.
	$c = JLoader::load('JModuleHelper');
}


function plgSystemMetamodProAlterModuleList( &$modules ) {

	// close up the array, just in case
	$modules = array_values( $modules );

	$total = count( $modules );
	for($i = 0; $i < $total; $i++) {
		if ( $modules[$i]->module == 'mod_metamod' and ( !isset($modules[$i]->published) or $modules[$i]->published )) {
			$new = plgSystemMetamodPro::expandMetaMod( $modules[$i] );
			array_splice( $modules, $i, 1, $new );
			$total = count( $modules );
			$i += count( $new ) - 1; // -1 because we removed the MM itself
		}
	}
}

function plgSystemMetamodProPostProcessModuleList( &$modules ) {

	// need to now go through the ChangeCache and make all required changes to the list
	// of modules. We could have done this on a per-metamod basis, pruning and editing
	// the modules as they come straight out of ::expandMetaMod. However, we want the
	// ChangeCache to be able to act on ALL modules on the page, not just the ones directly
	// returned by the MetaMod. So we keep track of all the ChangeCaches for all MetaMods
	// on the page, collate them, then apply them all here.
	// What happens when 2 different MetaMods specify different attributes for the same
	// module? In that case unfortunately we have to accept that all instances of that module
	// on the page are going to get the same extra parameters.
	// Hmmmm...... how about, if expandMetaMod comes back with a list of modules, and the
	// ChangeCache applies to some of them, then these changes get applied directly and immediately.
	// Any other changes would get remembered until afterwards (now), and get applied to the WHOLE
	// list of modules on the page.

	// plgSystemMetamodPro already knows about the changeCache - we don't need to pass it through.
	
	// close up the array, just in case
	$modules = array_values( $modules );
	plgSystemMetamodPro::applyParamChanges( $modules );	
}

class plgSystemMetamodPro extends JPlugin
{
	
	function onAfterInitialise()
	{
		$app		=& JFactory::getApplication();
		if ( ! $app->isSite() ) {
			return;
		}

		$app->registerEvent('onAlterModuleList', 'plgSystemMetamodProAlterModuleList');
		$app->registerEvent('onPostProcessModuleList', 'plgSystemMetamodProPostProcessModuleList');		
	}
	
	
	/*
	here's what happens
	- in _load(), we need to be able to return a list of modules where any MetaMods are REPLACED
	  by the modules that they contained.
	- any MetaMods that contain HTML in and of themselves will become a new module in their own right, followed
	  by the full modules that they contained. Therefore the "contained" modules will FOLLOW the MetaMod rather
	  than being contained by it.
	- in _load() we loop through all modules that are statically assigned to the page...
	  - if we find a MM we expand it to get a list of module IDs
	  - we need to repeat the DB call for these module IDs, to get full info from each of them
	*/

	// give it: a full MetaMod module
	// returns: an array of full modules expanded in that MetaMod. The MM itself may still exist if it returned HTML.
	function expandMetaMod( $metamod ) {

		static $new_version = null;
		if ( $new_version == null ) {
			$new_version = plgSystemMetamodPro::metaModVersionCompare( '3.0', '>=' );
		}
		
		// look up the given MM and find out what modules it contains.
		list( $ids, $content, $changeObject ) = plgSystemMetamodPro::metaModIncludes( $metamod );
		
		// cache the changeCache...
		plgSystemMetamodPro::changeCache( 'add', $changeObject );
		
		// if none, return none.
		if ( count($ids) == 0 && $content == '' ) return array(); // nothing
		
		$all_mod_array = array();

		// What do we do with content that was created inside the MetaMod itself, rather than in
		// one of the modules that it dynamically added?
		// We can return an extra module object that has the following parameters:
		// id, title, module, position, content, showtitle, control, params
		// This mirrors what would be loaded from the database for a basic module.
		// So we make a mod_custom with content in it directly.

		if ( $content != '' ) {
			$metamod->content = $content;
			// force type to "mod_custom" so that the system does not try to re-render the metamod later!
			$metamod->module = 'mod_custom';
			// all other parameters (id, title, module, position, showtitle, control and params should remain the same)
			$all_mod_array[] = $metamod;
		}

		
		if ( count($ids) == 0 ) return $all_mod_array; // no extra modules, only any output from the MetaMod (if any)
		
		$app	=& JFactory::getApplication();
		$db 	=& JFactory::getDBO();
		$user 	=& JFactory::getUser();
		// $aid	= $user->get('aid', 0);
		$groups		= implode(',', $user->getAuthorisedViewLevels());

		// now look up all the module IDs that were returned, to make full module objects out of them.
		// If we find that any are MetaMods themselves, then we must recurse to get *their* contents.
		$quoted_mod_identifiers = "'". implode( "','", array_map( array( $db, 'getEscaped'), $ids ) ) . "'";

		// there are various parameters that we want to get from the MetaMod module, in order to process things
		// properly here.
		// e.g. autopublish (id, position, all)
		// we're just going to get these direct from the params string, for speed.

		$matched = preg_match( '#"autoenable":"([a-z]+)"#', $metamod->params, $matches);
		$autopublish = ( $matched && count( $matches ) > 1 ) ? $matches[1] : 'none';


		$query = $db->getQuery(true); 

		$query->select('id, title, module, position, content, showtitle, params, published, ordering'
			. ", m.id in ( $quoted_mod_identifiers ) as in_id"
			. ", m.position in ( $quoted_mod_identifiers ) as in_position"
			);
	
		$query->from('#__modules AS m');
		if ( !$changeObject->modules && $autopublish == 'none') {
			$query->where('m.published = 1');
		}
		$query->where('m.access IN ('.$groups.')');
		$query->where( "( m.id in ( $quoted_mod_identifiers ) OR m.position in ( $quoted_mod_identifiers ) )" );
		$query->order( "( field( "
			. "\n  case when m.position in ( $quoted_mod_identifiers ) then m.position else m.id end,"
			. "\n  $quoted_mod_identifiers )), ordering"
			);
		$db->setQuery($query);


		if (!($modules = $db->loadObjectList())) {
			JError::raiseWarning( 'SOME_ERROR_CODE', "Error loading Modules: " . $db->getErrorMsg());
			return array(); // FIXME - what to do here? Ignore?
		}
		
		$total = count($modules);
		for($i = 0; $i < $total; $i++) {
			
			// autopublishing, according to our parameters
			if ( $autopublish == 'all'
				|| ( $autopublish == 'id' && $modules[$i]->in_id == 1)
				|| ( $autopublish == 'position' && $modules[$i]->in_position == 1 ) )  {
				$modules[$i]->published = 1;
			}
			// propagate the parent position to all contained modules, including other metamods (recursion)
			$modules[$i]->position	= strtolower( $metamod->position );
			
			// some other things that might be necessary...
			$file				= $modules[$i]->module;
			$custom 			= substr( $file, 0, 4 ) == 'mod_' ?  0 : 1;
			$modules[$i]->user  = $custom;
			$modules[$i]->name	= $custom ? $modules[$i]->title : substr( $file, 4 );
			$modules[$i]->style	= null;
			
			if ( $modules[$i]->published ) {
				if ( $file == 'mod_metamod') { // recurse
					$all_mod_array		= array_merge( $all_mod_array, plgSystemMetamodPro::expandMetaMod( $modules[$i] ) );
				} else {
					$all_mod_array[]	= &$modules[$i];
				}
			}
		}

		return $all_mod_array;
	}
	
	function metaModVersion( $which = 'both') {
		static $major = '3';
		static $minor = '4';
		static $all = '3.4';
		
		if ( !is_callable( array( 'modMetaModHelper', 'version') ) ) {
			$path = JPATH_BASE.DS.'modules'.DS."mod_metamod".DS.'helper.php';
			if ( file_exists( $path ) ) {
				include_once($path);
			}
		}
		if ( is_callable( array( 'modMetaModHelper', 'version') ) ) {
				$major = modMetaModHelper::versionMajor();
				$minor = modMetaModHelper::versionMinor();
				$all = modMetaModHelper::version();
		}
		switch ($which) {
			case 'all':
			default: return $all;
			case 'major':return $major;
			case 'minor':return $minor;
		}
	}
	
	/* is the MetaMod module installed on this machine greater than a specific version? */
	
	function metaModVersionCompare( $version, $comp ) {
		list( $major, $minor ) = explode( '.', $version, 2);
		
		$mm_major = plgSystemMetamodPro::metaModVersion('major');
		$mm_minor = plgSystemMetamodPro::metaModVersion('minor');
		
		switch ($comp) {
		 	case '>=':
				return ( $mm_major >= $major or ($mm_major == $major and $mm_minor >= $minor ));
		 	case '>':
				return ( $mm_major > $major or ($mm_major == $major and $mm_minor > $minor ));
		 	case '=':
				return ( $mm_major == $major and $mm_minor == $minor );
		 	case '<=':
				return ( $mm_major <= $major or ($mm_major == $major and $mm_minor <= $minor ));
		 	case '<':
				return ( $mm_major < $major or ($mm_major == $major and $mm_minor < $minor ));
		}
		return false;
	}
	
	/**
	 * Find out which modules are contained in a MetaMod. It's
	 * pretty similar to rendering a module (renderModule),
	 * except is only done for MetaMods, and only needs
	 * to call one method, not do the full rendering (with chrome etc).
	 *
	 * @param	string	$module	The MetaMod module
	 * @return	array1,array2
	 *		array1: The array of module ids included by this MetaMod,
	 *		array2: any content output by the MetaMod
	 */
	
	function metaModIncludes( $module )
	{
		static $chrome;

		$option = JRequest::getCmd('option');
		$app	= JFactory::getApplication();

		// Record the scope.
		$scope	= $app->scope;

		// Set scope to component name
		$app->scope = $module->module;

		// Get module parameters
		$params = new JRegistry;
		$params->loadJSON($module->params);

		// Get module path
		$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);
		$path = JPATH_BASE.'/modules/'.$module->module.'/'.$module->module.'.php';

		$moduleIds = array();
		$content = '';
		
		// Load the MetaMod helper, to get the code that returns the list of module ids.
		if ( file_exists( $path ) )
		{
			$lang = JFactory::getLanguage();
			// 1.5 or Core then
			// 1.6 3PD
				$lang->load($module->module, JPATH_BASE, null, false, false)
			||	$lang->load($module->module, dirname($path), null, false, false)
			||	$lang->load($module->module, JPATH_BASE, $lang->getDefault(), false, false)
			||	$lang->load($module->module, dirname($path), $lang->getDefault(), false, false);

			// do I need to include this here? The problem seems to be that it renders the metamod in full... but perhaps all I wanted was for
			// it to ensure that the file is loaded so that I can call functions. Hmmm.
			// I hope we can assume it's already loaded.
			// require_once($path);

			// what version of the MetaMod module have we loaded?
			$new_version = plgSystemMetamodPro::metaModVersionCompare('2.0', '>=');

			ob_start();
			
			// this only gets the direct output from the module, e.g. debug output.
			list( $moduleIds, $changeObject ) = modMetaModHelper::moduleIdsAndChanges( $params, $module );

			$content = ob_get_contents();
			ob_end_clean();

		}

		$app->scope = $scope; //revert the scope
		return array( $moduleIds, trim( $content ), &$changeObject );
	}
	
	/* either get the changecache, or add some more changes to the existing one */
	function &changeCache( $function = 'get', $changeObject = null ) {
		static $cache = null;
		if ($cache == null) {
			$cache = new stdclass();
			$cache->modules = array();
			$cache->disabled_positions = array();
		}
		if ( $function == 'get' ) return $cache;
		if ( $changeObject == null
				|| !count( $changeObject )
				|| ( !isset( $changeObject->modules ) && !isset( $changeObject->disabled_positions )
		) ) {
			$n = null;
			return $n; // return null var by reference
		}
		/* a changecache is an array with index 'modX', each value is an object of type MMIndividualChangeCache */
		if ( isset( $changeObject->modules ) ) {
			$cache->modules				= array_merge( $cache->modules, $changeObject->modules );
		}
		if ( isset( $changeObject->disabled_positions ) ) {
			$cache->disabled_positions	= array_merge( $cache->disabled_positions, $changeObject->disabled_positions );
		}
		return $cache; // just for convenience, and because we have to return something by reference.
	}
	
	function applyParamChanges( &$modules ) {
		if (! class_exists("modMetaModHelper") ) {
			return; // no MetaMod?
		}
		//$new_version = plgSystemMetamodPro::metaModVersionCompare( '2.0', '>=' );
		//if ( !$new_version ) return;
		modMetaModHelper::applyParamChanges( $modules, plgSystemMetamodPro::changeCache() );
	}

}