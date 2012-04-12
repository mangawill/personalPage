<div class="dragable" id="cfaction_check_security_question">Check Security Question</div>
<!--start_element_code-->
<div class="element_code" id="cfaction_check_security_question_element">
	<label class="action_label">Check Security Question</label>
	<div id="cfactionevent_check_security_question_{n}_success" class="form_event good_event">
		<label class="form_event_label">OnSuccess</label>
	</div>
	<div id="cfactionevent_check_security_question_{n}_fail" class="form_event bad_event">
		<label class="form_event_label">OnFail</label>
	</div>
	<input type="hidden" name="chronoaction[{n}][action_check_security_question_{n}_error]" id="action_check_security_question_{n}_error" value="<?php echo $action_params['error']; ?>" />
	
	<input type="hidden" id="chronoaction_id_{n}" name="chronoaction_id[{n}]" value="{n}" />
	<input type="hidden" name="chronoaction[{n}][type]" value="check_security_question" />
</div>
<!--end_element_code-->
<div class="element_config" id="cfaction_check_security_question_element_config">
	<?php echo $HtmlHelper->input('action_check_security_question_{n}_error_config', array('type' => 'text', 'label' => 'Error Message', 'class' => 'medium_input', 'value' => '')); ?>
</div>