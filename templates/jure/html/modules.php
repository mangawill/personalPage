<?php
/**
 * @version		$Id: modules.php 14401 2010-01-26 14:10:00Z louis $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/*
 * xhtml5
 */
function modChrome_jure($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php if ($module->showtitle != 0) : ?>
			<h1><?php echo $module->title; ?></h1>
		<?php endif; ?>
			<?php echo $module->content; ?>
		</div>
	<?php endif;
}


/*
 * xhtml5 - reklama
 */

function modChrome_reference($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<section class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		  <div class="ozadje clearfix">
    		<?php if ($module->showtitle != 0) : ?>
    			<h1><?php echo $module->title; ?></h1>
    		<?php endif; ?>
    			<?php echo $module->content; ?>
      </div>
		</section>
	<?php endif;
}

/*
 * xhtml5 - reklama
 */

function modChrome_noga($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php if ($module->showtitle != 0) : ?>
			<h5><?php echo $module->title; ?></h5>
		<?php endif; ?>
			<?php echo $module->content; ?>
		</div>
	<?php endif;
}


/*
 * xhtml5 - desno
 */

function modChrome_desno($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<section class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php if ($module->showtitle != 0) : ?>
			<h4><?php echo $module->title; ?></h4>
		<?php endif; ?>
			<?php echo $module->content; ?>
		</section>
	<?php endif;
}

function modChrome_heading3($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<section class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php if ($module->showtitle != 0) : ?>
			<h3><?php echo $module->title; ?></h3>
		<?php endif; ?>
			<?php echo $module->content; ?>
		</section>
	<?php endif;
}

/*
 * brez naslova
 */
function modChrome_navadno($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php if ($module->showtitle != 0) : ?>
			<p class="naslov"><?php echo $module->title; ?></p>
		<?php endif; ?>
			<?php echo $module->content; ?>
		</div>
	<?php endif;
}


/* aside slogani */
function modChrome_slogan($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
		<span class="sloganZgoraj"></span>
		<?php if ($module->showtitle != 0) : ?>
			<h2><?php echo $module->title; ?></h2>
		<?php endif; ?>
			<?php echo $module->content; ?>
			<span class="sloganSpodaj"></span>
		</div>	
	<?php endif; 
}

?>
