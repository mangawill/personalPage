<?php
/**
 * @version		$Id: bottom.php 2011 vargas $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die; 
?>

<div id="dm_container_<?php echo $dinamods_id; ?>">
  <?php
$k=1;
foreach ( $dinamods as $dinamod ) { ?>
  <div id="dm_tab_<?php echo $dinamods_id; ?>_<?php echo $k; ?>" class="dm_tabcontent">
    <?php echo JModuleHelper::renderModule($dinamod, array('style' => $params->get('chrome', '')) ); ?>
  </div>
  <?php
$k++;
}
?>
</div>
<div id="dm_tabs_<?php echo $dinamods_id; ?>">
  <ul class="dm_menu_<?php echo $dinamods_id; ?>">
    <?php
$k=1;
foreach ( $dinamods as $dinamod ) {
	if ($params->get('tracker', 0)) {
		$href = '/' . $dinamod->id . ':' . JFilterOutput::stringURLSafe( $dinamod->title );
	} else {
		$href = '#';
	}
?>
    <li class="dm_menu_item_<?php echo $dinamods_id; ?> kom<?php echo $k; ?>"><a href="<?php echo $href; ?>" rel="dm_tab_<?php echo $dinamods_id; ?>_<?php echo $k; ?>"<?php echo $k == 1 ? ' class="dm_selected"' : ''; ?>><?php echo $dinamod->title; ?></a></li>
    <?php
$k++; 
} ?>
<span class="clearfix"></span>
  </ul>
</div>
<br style="clear:left;" />