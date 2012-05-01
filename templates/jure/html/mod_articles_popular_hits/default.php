<?php
/**
 * @module		mod_articles_popular_hits
 * @copyright	Copyright (C) 2005 - 2012 Joomdev Corporation. All rights reserved.
 * @Website		http://www.jm-experts.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<ul class="mostread">
<?php foreach ($list as $item) : ?>
	<li class="clearfix">
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?></a>
			<span><i class="icon-eye-open"></i><?php echo $item->counts;?></span>
	</li>
<?php endforeach; ?>
</ul>
