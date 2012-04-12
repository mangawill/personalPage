<?php
/**
 * @version		$Id: mod_dinamods.php 2011 vargas $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$dinamods = JModuleHelper::getModules( trim( $params->get('position', 'dinamod') ) );

if ( !$dinamods ) :  return; endif;

global $dinamods_id;

if ( !$dinamods_id ) : $dinamods_id = 1; endif;

$doc =& JFactory::getDocument();
$doc->addStyleDeclaration(modDinamodsHelper::buildCSS( $params, $dinamods_id ));

JHTML::script('dinamods.js','modules/mod_dinamods/js/',false );

require( JModuleHelper::getLayoutPath('mod_dinamods') );

$dinamods_id++;