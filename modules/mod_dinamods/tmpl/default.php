<?php
/**
 * @version		$Id: default.php 2011 vargas $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require( JModuleHelper::getLayoutPath('mod_dinamods', 'tabs/' . $params->get('tabs_pos', 'top') ) );

$speed = 0;

if ( $params->get('slider', 1) == 1 ) : $speed = $params->get('speed', 3000 ); endif;

$doc = &JFactory::getDocument();

if (!defined('_MOD_VARGAS_ONLOAD')) {
    define ('_MOD_VARGAS_ONLOAD',1);
    $doc->addScriptDeclaration("function addLoadEvent(func) { if (typeof window.onload != 'function') { window.onload = func; } else { var oldonload = window.onload; window.onload = function() { if (oldonload) { oldonload(); } func(); } } }");
}

$doc->addScriptDeclaration("addLoadEvent(function(){
var Dinamods=new dinamods('dm_tabs_".$dinamods_id."');
Dinamods.setpersist(true);
Dinamods.setselectedClassTarget('link');
Dinamods.init(".$speed.",".$params->get('change', 0).");});");
