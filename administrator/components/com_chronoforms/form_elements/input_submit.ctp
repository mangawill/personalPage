<div class="dragable" id="input_submit">Submit Button</div>
<div class="element_code" id="input_submit_element">
	<input type="button" name="submit_{n}_input_name" id="submit_{n}_input_id" value="<?php echo $element_params['input_value']; ?>" />
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_input_id]', array('type' => 'hidden', 'id' => 'input_submit_{n}_input_id', 'value' => $element_params['input_id'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_input_name]', array('type' => 'hidden', 'id' => 'input_submit_{n}_input_name', 'value' => $element_params['input_name'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_input_value]', array('type' => 'hidden', 'id' => 'input_submit_{n}_input_value', 'value' => $element_params['input_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_input_class]', array('type' => 'hidden', 'id' => 'input_submit_{n}_input_class', 'value' => $element_params['input_class'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_back_button]', array('type' => 'hidden', 'id' => 'input_submit_{n}_back_button', 'value' => $element_params['back_button'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_reset_button]', array('type' => 'hidden', 'id' => 'input_submit_{n}_reset_button', 'value' => $element_params['reset_button'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_back_button_value]', array('type' => 'hidden', 'id' => 'input_submit_{n}_back_button_value', 'value' => $element_params['back_button_value'])); ?>
	<?php echo $HtmlHelper->input('chronofield[{n}][input_submit_{n}_reset_button_value]', array('type' => 'hidden', 'id' => 'input_submit_{n}_reset_button_value', 'value' => $element_params['reset_button_value'])); ?>
	
	<input type="hidden" id="chronofield_id_{n}" name="chronofield_id" value="{n}" />
    <input type="hidden" name="chronofield[{n}][tag]" value="input" />
    <input type="hidden" name="chronofield[{n}][type]" value="submit" />
</div>
<div class="element_config" id="input_submit_element_config">
	<?php echo $HtmlHelper->input('input_submit_{n}_input_name_config', array('type' => 'text', 'label' => 'Name', 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_input_id_config', array('type' => 'text', 'label' => 'ID', 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_input_value_config', array('type' => 'text', 'label' => 'Text', 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_input_class_config', array('type' => 'text', 'label' => 'Class', 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_back_button_config', array('type' => 'checkbox', 'label' => 'Add Back Button', 'class' => 'small_input', 'value' => '1', 'rule' => "bool")); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_back_button_value_config', array('type' => 'text', 'label' => 'Back Button Text', 'class' => 'small_input', 'value' => '')); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_reset_button_config', array('type' => 'checkbox', 'label' => 'Add Reset Button', 'class' => 'small_input', 'value' => '1', 'rule' => "bool")); ?>
	<?php echo $HtmlHelper->input('input_submit_{n}_reset_button_value_config', array('type' => 'text', 'label' => 'Reset Button Text', 'class' => 'small_input', 'value' => '')); ?>
	
</div>