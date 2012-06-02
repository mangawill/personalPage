<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
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
  </header>
<?php endif; ?>

<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
  <ul class="actions">
    <?php if ($params->get('show_print_icon')) : ?>
    <li class="print-icon">
      <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
    </li>
    <?php endif; ?>
    <?php if ($params->get('show_email_icon')) : ?>
    <li class="email-icon">
      <?php echo JHtml::_('icon.email', $this->item, $params); ?>
    </li>
    <?php endif; ?>
    <?php if ($canEdit) : ?>
    <li class="edit-icon">
      <?php echo JHtml::_('icon.edit', $this->item, $params); ?>
    </li>
    <?php endif; ?>
  </ul>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
  <?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
  <div class="avtorBlog clearfix">
    <div class="postData clearfix">
<?php endif; ?>

<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
  <div class="createdby clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
    <?php $author =  $this->item->author; ?>
    <?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

      <?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
       <span itemprop="name">
        <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
         JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid), $author)); ?>
        </span>
      <?php else :?>
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

<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
  <div class="parent-category-name">
    <?php $title = $this->escape($this->item->parent_title);
    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
    <?php if ($params->get('link_parent_category')) : ?>
      <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
      <?php else : ?>
      <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php if ($params->get('show_category')) : ?>
    <div class="category-name">
      <?php $title = $this->escape($this->item->category_title);
          $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
      <?php if ($params->get('link_category')) : ?>
        <i class="icon-tags"></i><?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
        <?php else : ?>
        <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
      <?php endif; ?>
    </div>
<?php endif; ?>

<?php if ($params->get('show_hits')) : ?>
    <div class="hits">
    <i class="icon-eye-open"></i><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
    </div>
<?php endif; ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) :?>
     </div><!-- postData -->
<?php endif; ?>

<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
  <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
  <div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
  <img
    <?php if ($images->image_intro_caption):
      echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
    endif; ?>
    src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
  </div>
<?php endif; ?>

<div class="introText clearfix">
<?php echo $this->item->introtext; ?>
</div>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
  if ($params->get('access-view')) :
    $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
  else :
    $menu = JFactory::getApplication()->getMenu();
    $active = $menu->getActive();
    $itemId = $active->id;
    $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
    $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
    $link = new JURI($link1);
    $link->setVar('return', base64_encode($returnURL));
  endif;
?>
    <p class="btn btn-inverse readmore">
        <a href="<?php echo $link; ?>">
          <?php if (!$params->get('access-view')) :
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

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
  </div><!-- avtorBlog -->
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<footer class="footerBlog">
  <dl class="clearfix">
  <dd class="category-name">

<?php echo $this->item->event->afterDisplayContent; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>
</footer>
<div class="item-separator"></div>

</article>
<div class="item-separator"></div>
