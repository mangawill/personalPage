<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionCheckSecurityQuestion{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_security', 'title' => 'Security');
	var $events = array('success' => 0, 'fail' => 0);
	var $details = array('title' => 'Check Security Question', 'tooltip' => 'Check the Security Question Answer.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		if(isset($_POST['chrono_security_answer'])){
			if(isset($_POST['_cf_session_prefix_'])){
				$mainframe =& JFactory::getApplication();
				$session =& JFactory::getSession();
				if((bool)$params->get('session_prefix', 1) === true){
					$session_prefix = $form->data['_cf_session_prefix_'];
					$sessionvar = $session->get("chrono_security_answers_".$session_prefix, array(), md5('chrono'));
				}else{
					$sessionvar = $session->get("chrono_security_answers", array(), md5('chrono'));
				}
				$chrono_security_answer = trim($form->data['chrono_security_answer']);
				if(!in_array($chrono_security_answer, $sessionvar)){
					$this->events['fail'] = 1;
					$form->validation_errors['chrono_security_answer'] = $params->get('error', "You have entered a wrong security question's answer.");
					if((bool)$params->get('session_prefix', 1) === true){
						$session->clear("chrono_security_answers_".$session_prefix, md5('chrono'));
					}else{
						$session->clear("chrono_security_answers", md5('chrono'));
					}
					unset($form->data['_cf_session_prefix_']);
					$form->data['chrono_security_answer'] = '';
					$form->debug['Core Captcha'][] = "Failed the answer check!";
				}else{
					$this->events['success'] = 1;					
					if((bool)$params->get('session_prefix', 1) === true){
						$session->clear("chrono_security_answers_".$session_prefix, md5('chrono'));
					}else{
						$session->clear("chrono_security_answers", md5('chrono'));
					}
					unset($form->data['_cf_session_prefix_']);
					$form->data['chrono_security_answer'] = '';
					$form->debug['Core Captcha'][] = "Passed the answer check!";
				}
			}else{
				$this->events['fail'] = 1;
				$form->validation_errors['chrono_security_answer'] = $params->get('error', "You have entered a wrong security question's answer.");
				$form->debug['Core Captcha'][] = "Couldn't find the security prefix token field value in the \$_POST array!";
			}
		}else{
			$this->events['fail'] = 1;
			$form->validation_errors['chrono_security_answer'] = $params->get('error', "You have entered a wrong security question's answer.");
			$form->debug['Core Captcha'][] = "Couldn't find the answer field value in the \$_POST array!";
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'enabled' => 1,
				'error' => "You have entered a wrong security question's answer."
			);
		}
		return array('action_params' => $action_params);
	}
}
?>