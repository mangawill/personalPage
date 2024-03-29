<?php
/**
 * @version		$Id: blog.php 20960 2011-03-12 14:14:00Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>
<section class="blog<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
  <h1 class="skrij">
    <?php echo $this->escape($this->params->get('page_heading')); ?>
  </h1>
  <?php endif; ?>
<div id="reference">
  <?php if ($this->params->get('show_category_title', 1) OR $this->params->get('page_subheading')) : ?>
  <h2>
    <?php echo $this->escape($this->params->get('page_subheading')); ?>
    <?php if ($this->params->get('show_category_title')) : ?>
      <span class="subheading-category"><?php echo $this->category->title;?></span>
    <?php endif; ?>
  </h2>
  <?php endif; ?>




<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
  <div class="category-desc">
  <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    <img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
  <?php endif; ?>
  <?php if ($this->params->get('show_description') && $this->category->description) : ?>
    <?php echo JHtml::_('content.prepare', $this->category->description); ?>
  <?php endif; ?>
  <div class="clr"></div>
  </div>
<?php endif; ?>



<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="items-leading">
  <?php foreach ($this->lead_items as &$item) : ?>
    <div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
      <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
      ?>
    </div>
    <?php
      $leadingcount++;
    ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>
<?php
  $introcount=(count($this->intro_items));
  $counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>

  <?php foreach ($this->intro_items as $key => &$item) : ?>
  <?php
    $key= ($key-$leadingcount)+1;
    $rowcount=( ((int)$key-1) % (int) $this->columns) +1;
    $row = $counter / $this->columns ;

    if ($rowcount==1) : ?>
  <article class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
  <?php endif; ?>
    <?php
      $this->item = &$item;
      echo $this->loadTemplate('item');
    ?>
  <?php $counter++; ?>
  <?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
        <span class="clear"></span>
        </article>
      <?php endif; ?>
  <?php endforeach; ?>


<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>

  <?php echo $this->loadTemplate('links'); ?>

<?php endif; ?>
</div><!-- reference -->

<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
    <div class="pagination">
            <?php  if ($this->params->def('show_pagination_results', 1)) : ?>
            <p class="counter">
                <?php echo $this->pagination->getPagesCounter(); ?>
            </p>

        <?php endif; ?>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php  endif; ?>

</section>
