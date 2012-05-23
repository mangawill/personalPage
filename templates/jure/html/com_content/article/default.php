<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();

?>
<article class="clanek<?php echo $this->pageclass_sfx;?>">
  <header>
    <?php
      if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
      {
        echo $this->item->pagination;
      }
    ?>

    <?php if ($params->get('show_title')) : ?>
    	<h1>
    	<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
    		<a href="<?php echo $this->item->readmore_link; ?>">
    		<?php echo $this->escape($this->item->title); ?></a>
    	<?php else : ?>
    		<?php echo $this->escape($this->item->title); ?>
    	<?php endif; ?>
    	</h1>
    <?php endif; ?>
    </header>
    
    <?php $useDefList = (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_parent_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_hits'))); ?>
    
    <?php if ($useDefList) : ?>
      <div class="avtorBlog clearfix">
        <div class="postData">
    <?php endif; ?>
      
    <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
  	<div class="createdby clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
  	<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
  	
  	<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
  	<span itemprop="name">
  	<?php
  		$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
  		$item = JSite::getMenu()->getItems('link', $needle, true);
  		$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
  	?>
  	</span>
  		<span itemprop="name"><?php echo JText::sprintf(JHtml::_('link', JRoute::_($cntlink), $author)); ?></span>
  	<?php else: ?>
  		<div class="ikona"><i class="icon-pencil"></i></div><div itemprop="name"><?php echo JText::sprintf($author); ?></div>
  	<?php endif; ?>
  	</div>
   <?php endif; ?>
    
    <?php if ($params->get('show_create_date')) : ?>
    	<div class="create">
    	<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
    	</div>
    <?php endif; ?>
    <?php if ($params->get('show_modify_date')) : ?>
    	<div class="modified">
    	<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
    	</div>
    <?php endif; ?>
    <?php if ($params->get('show_publish_date')) : ?>
    	<div class="published">
    	<i class="icon-time"></i><?php echo JText::sprintf(JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
    	</div>
    <?php endif; ?>
    
    <?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
      	<div class="parent-category-name">
      	<?php	$title = $this->escape($this->item->parent_title);
      	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
      	<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
      		<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
      	<?php else : ?>
      		<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
      	<?php endif; ?>
      	</div>
      <?php endif; ?>
      <?php if ($params->get('show_category')) : ?>
      	<div class="category-name">
      	<?php 	$title = $this->escape($this->item->category_title);
      	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
      	<?php if ($params->get('link_category') and $this->item->catslug) : ?>
      		<i class="icon-tags"></i><?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
      	<?php else : ?>
      		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
      	<?php endif; ?>
      	</div>
    <?php endif; ?>
    
    <?php if ($params->get('show_hits')) : ?>
    	<div class="hitsClanek">
    	<i class="icon-eye-open"></i><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
    	</div>
    
    
    <div class="comments">
    	<i class="icon-comment"></i><a href="#disqus_thread">Comment</a>
    	</div>
    
    <div class="share">
      <a class="addthis_button_twitter"></a>
      <a class="addthis_button_reddit"></a>
      <a class="addthis_button_stumbleupon"></a>
      <a class="addthis_button_google_plusone_share"></a>
      <a class="addthis_button_compact"></a>
      <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e5bd2ec4d28157e"></script>
    </div><!-- share -->
    
    <?php endif; ?>
    
    <?php if ($useDefList) : ?>
 	   </div><!-- postData -->
    <?php endif; ?>
  
  <?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
		OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>

<?php if ($params->get('access-view')):?>
<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
<div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
<img
	<?php if ($images->image_fulltext_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
	endif; ?>
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
</div>
<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
	echo $this->item->pagination;
 endif;
?>

<?php  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>


  <?php echo $this->item->text; ?>


<?php echo $this->item->event->afterDisplayContent; ?>

<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
	 echo $this->item->pagination;?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true and  $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
			    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?></a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
	 echo $this->item->pagination;?>
<?php endif; ?>

<?php if ($useDefList) : ?>
  </div><!-- avtorBlog -->
<?php endif; ?>

</article>
