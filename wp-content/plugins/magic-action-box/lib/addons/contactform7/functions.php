<?php

/**
 * Register Contact Form 7 action box type
 * @return none
 */
function mab_cf7_register_action_box_type( $disabled = false ){

	$status = $disabled ? 'disabled' : 'enabled';
	$description = $disabled ? 'This plugin requires the <a href="http://wordpress.org/extend/plugins/contact-form-7/" target="_blank">Contact Form 7 plugin</a> to be installed and activated.<br />Make it easy for visitors to contact you right away. Integrates with the awesome Contact Form 7 plugin.' : 'Make it easy for visitors to contact you right away. Integrates with the awesome Contact Form 7 plugin.';
	$title = 'Contact Form 7';

	$boxType = array(
		'type' => MAB_CF7_TYPE,
		'name' => $title,
		'description' => $description,
		'status' => $status
	);
	mab_register_action_box( $boxType );
}

/**
 * Add our own meta box
 * 
 * @param  obj $meta_boxes_obj the passed MAB_MetaBoxes object
 * @return none
 */
function mab_cf7_add_meta_boxes( $meta_boxes_obj ){
	$MabBase = MAB();
	$post_type = $MabBase->get_post_type();

	add_meta_box( 'mab-cf7-settings', __('Action Box: Contact Form 7 Options', 'mab' ), 'mab_cf7_meta_box', $post_type, 'normal', 'high' );
	add_meta_box( 'mab-actionbox-content', __('Action Box: Copy', 'mab' ), array( $meta_boxes_obj, 'actionBoxContent' ), $post_type, 'normal', 'high' );
	add_meta_box( 'mab-actionbox-aside', __('Action Box: Side Item', 'mab' ), array( $meta_boxes_obj, 'actionBoxAside' ), $post_type, 'normal', 'high' );
}

/**
 * Outputs the CF7 options metabox in action box edit screen
 * @param  object $post the current post
 * @return html
 */
function mab_cf7_meta_box( $post ){
	$MabBase = MAB();
	$MabButton = MAB('button');
	$data['meta'] = $MabBase->get_mab_meta( $post->ID );
	$type = $MabBase->get_action_box_type( $post->ID );

	//Get contact form 7 stuff
	$args = array(
		'orderby' => 'title',
		'order' => 'ASC'
		);
	$cf7_list = WPCF7_ContactForm::find( $args );
	$data['cf7-list'] = is_array($cf7_list) ? $cf7_list : array();

	$data['buttons'] = $MabButton->getConfiguredButtons();

	$filename = 'metabox/cf7-settings.php';
	$box = mab_cf7_get_view( $filename, $data );
	echo $box;
}

/**
 * Set template path callback functions
 */

function mab_cf7_get_default_template_dir( $dir, $type ){
	if( MAB_CF7_TYPE == $type ){
		return MAB_CF7_VIEWS . 'actionbox/';
	} else {
		return $dir;
	}
}

function mab_cf7_get_default_template_url( $dir, $type ){
	if( MAB_CF7_TYPE == $type ){
		return MAB_CF7_VIEWS_URL . 'actionbox/';
	} else {
		return $dir;
	}
}

/**
 * Display the output of the CF7 action box
 */
function mab_cf7_the_content( $content, $action_box_obj ){

	$type = $action_box_obj->getActionBoxType();

	//process only our action box type
	if( MAB_CF7_TYPE != $type ) return $content;

	$meta = $action_box_obj->getMeta();

	$form_id = !empty( $meta['cf7']['selected-form-id'] ) ? $meta['cf7']['selected-form-id'] : '';

	if( empty( $form_id ) ) return '';

	$form = do_shortcode( '[contact-form-7 id="' . absint($form_id) . '"]' );
	return $form;
}

/**
 * Add our own styles and scripts when our action box type is used
 */
function mab_cf7_enqueue_assets( $type, $template_obj ){
	if( MAB_CF7_TYPE != $type ) return;

	wp_enqueue_style( 'mab-cf7-css', MAB_CF7_ASSETS_URL . 'style.css' );
}

/**
 * UTILITY FUNCTIONS
 */

/**
 * Wrapper function to MAB_Utils::getView()
 * 
 * @param  string $filename path to file relative to the views directory
 * @param  array $data      
 * @return html should be html
 */
function mab_cf7_get_view( $filename, $data = null ){
	$parent = MAB_CF7_VIEWS;
	return MAB_Utils::getView( $filename, $data, $parent );
}