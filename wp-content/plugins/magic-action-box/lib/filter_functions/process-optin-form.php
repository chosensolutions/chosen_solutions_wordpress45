<?php
/**
 * These are callback functions triggered by the filter:
 * 'mab_process_{$provider}_optin_submit' via ajax submit.
 *
 * This filter is located at MAB_Ajax::processOptin()
 *
 * To return a message i.e. success or error, use MAB_Ajax::addMessage()
 */

/**
 * Process Postmatic submit
 * @param $result
 * @param $data
 *
 * @return bool
 */
function mab_process_postmatic_optin_submit($result, $data){
	if(!class_exists('Prompt_Api') || empty($data['postmatic-action'])){
		// postmatic plugin not installed or activated
		MAB_Ajax::addMessage('Something went wrong. Please contact the website owner.');
		return false;
	}

	$user = array('user_email' => $data['email']);

	if(!empty($data['fname']))
		$user['first_name'] = $data['fname'];

	if(!empty($data['lname']))
		$user['last_name'] = $data['lname'];

	if($data['postmatic-action'] == 'unsubscribe'){
		$status = Prompt_Api::unsubscribe($data['email']);

		switch ( $status ) {
			case Prompt_Api::NEVER_SUBSCRIBED:
				$result = false;
				MAB_Ajax::addMessage("Is that address correct? It wasn't ever subscribed.");
				break;
			case Prompt_Api::ALREADY_UNSUBSCRIBED:
				$result = true;
				MAB_Ajax::addMessage("You've already unsubscribed.");
				break;
			case Prompt_Api::CONFIRMATION_SENT:
				$result = true;
				MAB_Ajax::addMessage("You're now unsubscribed, and you'll get one last email confirming this.");
				break;
		}
	} else {
		$status = Prompt_Api::subscribe( $user );

		switch ( $status ) {
			case Prompt_Api::INVALID_EMAIL:
				MAB_Ajax::addMessage('Email address is invalid.');
				$result = false;
				break;
			case Prompt_Api::ALREADY_SUBSCRIBED:
				MAB_Ajax::addMessage("You are already subscribed, but we're glad you wanted to make sure.");
				$result = true;
				break;
			case Prompt_Api::CONFIRMATION_SENT:
				MAB_Ajax::addMessage("You're subscribed. Now check your email for confirmation.");
				$result = true;
				break;
			case Prompt_Api::OPT_IN_SENT:
				MAB_Ajax::addMessage("Great! Now check your email for the final step.");
				$result = true;
				break;
		}
	}

	return $result;
}


/**
 * Process Constant Contact form submit
 * @param $result
 * @param $data - form post data
 */
function mab_process_constantcontact_optin_submit($result, $data){

	if(empty($data['email']) || !is_email($data['email'])){
		MAB_Ajax::addMessage(__('Invalid email address.', 'mab'));
		return false;
	}

	if(empty($data['list'])){
		MAB_Ajax::addMessage(__('Email list is not set.', 'mab'));
		return false;
	}

	$email = $data['email'];
	$list = $data['list'];
	$vars = array();
	if(!empty($data['fname']))
		$vars['firstname'] = $data['fname'];

	if(!empty($data['lname']))
		$vars['lastname'] = $data['lname'];

	$result = MAB('admin')->signupConstantContact($list, $email, $vars);

	if(is_array($result)){
		foreach($result as $error){
			MAB_Ajax::addMessage(print_r($error,true));
		}
		return false;
	}

	$actionBox = MAB_ActionBox::get($data['mabid']);
	if(!$actionBox){
		MAB_Ajax::addMessage(__('Action box does not exist.', 'mab'));
		return false;
	}

	$meta = $actionBox->getMeta();
	if(!empty($meta['optin']['success-message'])){
		MAB_Ajax::addMessage(wp_kses_post($meta['optin']['success-message']));
	}

	if(!empty($meta['optin']['redirect'])){
		return array('redirect' => esc_url($meta['optin']['redirect']));
	}

	return true;
}


function mab_process_wysija_optin_submit($result, $data){

	if(!class_exists('WYSIJA_object')){
		MAB_Ajax::addMessage(__('MailPoet is not set up properly: WYSIJA_object does not exist.', 'mab'));
		return false;
	}

	if(empty($data['email']) || !is_email($data['email'])){
		MAB_Ajax::addMessage(__('Invalid email address.', 'mab'));
		return false;
	}

	if(empty($data['lists'])){
		MAB_Ajax::addMessage(__('Email list is not set.', 'mab'));
		return false;
	}

	$list['list_ids'] = explode(',', $data['lists']);

	$user = array();

	$user['email'] = $data['email'];

	if(!empty($data['fname']))
		$user['firstname'] = $data['fname'];

	if(!empty($data['lname']))
		$user['lastname'] = $data['lname'];

	$subscriber = array(
		'user' => $user,
		'user_list' => $list
	);

	if(!empty($data['mabid'])){
		$actionBox = MAB_ActionBox::get($data['mabid']);
		if(!$actionBox){
			MAB_Ajax::addMessage('Action box does not exist.');
			return false;
		}
	}

	$result = WYSIJA::get( 'user', 'helper' )->addSubscriber( $subscriber );

	if(false === $result){
		MAB_Ajax::addMessage(__('Email signup failed.', 'mab'));
		return false;
	}

	$meta = $actionBox->getMeta();
	if(!empty($meta['optin']['wysija']['success-message'])){
		MAB_Ajax::addMessage(wp_kses_post($meta['optin']['wysija']['success-message']));
	}

	if(!empty($meta['optin']['redirect'])){
		return array('redirect' => esc_url($meta['optin']['redirect']));
	}

	return true;
}