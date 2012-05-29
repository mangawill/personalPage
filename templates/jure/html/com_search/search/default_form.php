<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>

<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post" class="form-inline"> 
	<fieldset class="word">
		<div class="control-group"> 
			<label for="search-searchword" class="control-label">
				<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>
			</label>
			<div class="controls">
				<div class="input-append">
					<input type="text" name="searchword" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="span3" /><button name="Search" onclick="this.form.submit()" class="btn btn-inverse" type="button"><?php echo JText::_('COM_SEARCH_SEARCH');?></button>
					<input type="hidden" name="task" value="search" />
				</div>
			</div>
		</div>
	</fieldset>

	<?php if (!empty($this->searchword)):?>
		<div class="alert alert-success <?php echo $this->params->get('pageclass_sfx'); ?>">
			<a class="close" data-dismiss="alert" href="#">×</a>
			<?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', $this->total);?>
		</div>
	<?php endif;?>

	<fieldset class="phrases">
		<div class="control-group">
			<label class="control-label">
				<?php echo JText::_('COM_SEARCH_FOR');?>
			</label>
			<div class="controls">
				<?php echo $this->lists['searchphrase']; ?>
			</div>
		</div>
		
		<div class="control-group">
			<label for="ordering" class="control-label">
				<?php echo JText::_('COM_SEARCH_ORDERING');?>
			</label>
			<div class="controls">
				<?php echo $this->lists['ordering'];?>
			</div>
		</div>
	</fieldset>

	<?php if ($this->params->get('search_areas', 1)) : ?>
		<fieldset class="only">
			<div class="control-group">
				<label class="control-label"><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></label>
					<div class="controls">
						<?php foreach ($this->searchareas['search'] as $val => $txt) :
							$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
						?>
						<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> />
							<label for="area-<?php echo $val;?>" class="control-label">
								<?php echo JText::_($txt); ?>
							</label>
						<?php endforeach; ?>
				</div>
			</div>
		</fieldset>
	<?php endif; ?>

<?php if ($this->total > 0) : ?>

	<div class="form-limit">
		<label for="limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>

<?php endif; ?>
</form>