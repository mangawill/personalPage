<?php
/**
 * @version		$Id: blog_item.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished"></div>
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
<article class="blogClanek">
	<header>
	<h2>
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
<span class="avtorBlog">
 <dl class="clearfix">
 <dt class="skrij"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>


<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<dd class="createdby" itemscope itemtype="http://data-vocabulary.org/Person"> 
		<?php $author =  $this->item->author; ?>
		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

			<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
				<span itemprop="name">
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
				 JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>
				</span>
			<?php else :?>
				<span itemprop="name"><?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?></span>
			<?php endif; ?>
	</dd>
<?php endif; ?>


<?php if ($params->get('show_create_date')) : ?>
		<dd class="create">
		<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC1'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
		<dd class="modified">
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC1'))); ?>
		</dd>
<?php endif; ?>


<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published">
		<time datetime="<?php echo ($this->item->publish_up) ?>" pubdate="pubdate">
		<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date' , $this->item->publish_up, JText::_('DATE_FORMAT_LC1'))); ?></time>
		</dd>	
<?php endif; ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) :?>
 	</dl>
 	</span><!-- avtorBlog -->
<?php endif; ?>
</header>
<span class="frontSpan">
<?php echo $this->item->introtext; ?>
</span><!-- frontSpan -->
<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
		<p class="readmore">
				<a href="<?php echo $link; ?>" class="button">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<footer class="footerBlog">

	<dl class="clearfix">
	<dd class="category-name">
	<?php $title = '<img src="templates/jure/images/tag.png" />' . $this->escape($this->item->category_title); 
$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '" rel="tag">' . $title . '</a>'; ?>
<?php echo ($url); ?>
				</dd>

	
<?php if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo ('<img src="templates/jure/images/hits.png" />' . $this->item->hits), JText::sprintf('COM_CONTENT_ARTICLE_HITS', $url); ?>
		</dd>
<?php endif; ?>
</dl>

<?php echo $this->item->event->afterDisplayContent; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>
</footer>
<span class="clearfix"></span>

</article>
<div class="item-separator"></div>