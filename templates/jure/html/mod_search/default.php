<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">
	<div class="control-group">
		<div class="controls<?php echo $moduleclass_sfx ?>">
			<?php
				$output = '<div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span><input name="searchword" id="inputIcon" class="span3" type="text" placeholder="'.$text.'" /></div>';

				if ($button) :
					if ($imagebutton) :
						$button = '<input type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$img.'" onclick="this.form.searchword.focus();"/>';
					else :
						$button = '<input type="submit" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/>';
					endif;
				endif;

				switch ($button_pos) :
					case 'top' :
						$button = $button.'<br />';
						$output = $button.$output;
						break;

					case 'bottom' :
						$button = '<br />'.$button;
						$output = $output.$button;
						break;

					case 'right' :
						$output = $output.$button;
						break;

					case 'left' :
					default :
						$output = $button.$output;
						break;
				endswitch;

				echo $output;
			?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
		</div>
	</div>
</form>
