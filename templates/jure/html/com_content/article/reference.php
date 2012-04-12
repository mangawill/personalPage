<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
?>
<?php if ($params->get('show_title')|| $params->get('access-edit')) : ?>
<article class="referenceClanek">
	<header>
	<h1>
				<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
				<a href="<?php echo $this->item->readmore_link; ?>">
						<?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
						<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
		</h1>
<?php endif; ?>

	<?php  if (!$params->get('show_intro')) :
		echo $this->item->event->afterDisplayTitle;
	endif; ?>

<?php  if ($params->get('show_vote')) :
		echo '<span class="oceniClanek">' . $this->item->event->beforeDisplayContent . '</span>'; 
	endif; ?>
	<?php if (isset ($this->item->toc)) : ?>
		<?php echo $this->item->toc; ?>
	<?php endif; ?>
</header>
	<?php echo $this->item->text; ?>
	<?php echo $this->item->event->afterDisplayContent; ?>
	</article>