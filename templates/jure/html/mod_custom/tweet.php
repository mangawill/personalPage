<?php
/**
 * @version		$Id: default.php 21520 2011-06-10 22:08:29Z chdemko $
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>


<div class="customtweet" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
<img src="templates/jure/images/followTwitter.png" />
	<?php echo $module->content;?>
</div>