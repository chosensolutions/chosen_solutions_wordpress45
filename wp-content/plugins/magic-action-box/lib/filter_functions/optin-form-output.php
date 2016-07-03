<?php

function mab_aweber_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();

	//break if aweber is not allowed
	if( $settings['optin']['allowed']['aweber'] == 0 )
		return '';
	
	$meta = $actionBoxObj->getMeta();
	$filename = 'optinforms/aweber.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;
}

function mab_mailchimp_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();

	//break if mailchimp is not allowed
	if( $settings['optin']['allowed']['mailchimp'] == 0 )
		return '';
	
	$meta = $actionBoxObj->getMeta();
	$filename = 'optinforms/mailchimp.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;
}

function mab_sendreach_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();

	//break if sendreach is not allowed
	if( $settings['optin']['allowed']['sendreach'] == 0 )
		return '';
	
	$meta = $actionBoxObj->getMeta();
	$filename = 'optinforms/sendreach.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;
}

function mab_manual_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();
	$meta = $actionBoxObj->getMeta();
	$filename = 'optinforms/manual.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;
}

function mab_wysija_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();

	//make sure Wysija plugin is activated
	if( !class_exists( 'WYSIJA' ) ) return '';

	$actionBoxObj->addClass('mab-ajax');

	$meta = $actionBoxObj->getMeta();

	$meta['mab-html-id'] = $actionBoxObj->getHtmlId();
	$meta['ID'] = $actionBoxObj->getId();

	$filename = 'optinforms/wysija.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;
}

function mab_postmatic_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();
	
	if(!class_exists('Prompt_Api')) return '';
	wp_enqueue_script('mab-postmatic');
	$actionBoxObj->addClass('mab-ajax');

	$meta = $actionBoxObj->getMeta();
	$meta['ID'] = $actionBoxObj->getId();
	$filename = 'optinforms/postmatic.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;
}

function mab_constantcontact_form_html($html, $actionBoxObj){
	$settings = MAB('settings')->getAll();

	if( $settings['optin']['allowed']['constantcontact'] == 0 )
		return '';

	$actionBoxObj->addClass('mab-ajax');

	$meta = $actionBoxObj->getMeta();
	$meta['ID'] = $actionBoxObj->getId();
	$filename = 'optinforms/constant-contact.php';
	$form = MAB_Utils::getView( $filename, $meta );

	return $form;

}