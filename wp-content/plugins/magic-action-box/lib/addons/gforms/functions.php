<?php

/**
 * Register Gravity Forms action box type
 * @return none
 */
function mab_gforms_register_action_box_type( $disabled = false ){

	$status = $disabled ? 'disabled' : 'enabled';
	$description = $disabled ? 'This action box type requires the <a href="http://www.gravityforms.com/" target="_blank">Gravity Forms plugin</a> to be installed and activated.<br />Build complex, powerful contact forms in just minutes. Gravity Forms + Magic Action Box = Awesomeness' : 'Build complex, powerful contact forms in just minutes. Gravity Forms + Magic Action Box = Awesomeness';
	$title = 'Gravity Forms';

	$boxType = array(
		'type' => MAB_GFORMS_TYPE,
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
function mab_gforms_add_meta_boxes( $meta_boxes_obj ){
	$MabBase = MAB();
	$post_type = $MabBase->get_post_type();

	add_meta_box( 'mab-gforms-settings', __('Action Box: Gravity Forms Options', MAB_DOMAIN ), 'mab_gforms_meta_box', $post_type, 'normal', 'high' );
	add_meta_box( 'mab-actionbox-content', __('Action Box: Copy', 'mab' ), array( $meta_boxes_obj, 'actionBoxContent' ), $post_type, 'normal', 'high' );
	add_meta_box( 'mab-actionbox-aside', __('Action Box: Side Item', 'mab' ), array( $meta_boxes_obj, 'actionBoxAside' ), $post_type, 'normal', 'high' );
}

/**
 * Outputs the GFORMS options metabox in action box edit screen
 * @param  object $post the current post
 * @return html
 */
function mab_gforms_meta_box( $post ){
	$MabBase = MAB();

	$data['meta'] = $MabBase->get_mab_meta( $post->ID );
	$type = $MabBase->get_action_box_type( $post->ID );

	//Get gravity forms stuff
	$forms = RGFormsModel::get_forms(null, 'title');
	
	$data['forms'] = is_array($forms) ? $forms : array();
	//error_log();
	$filename = 'metabox/metabox.php';

	$box = mab_gforms_get_view( $filename, $data );
	echo $box;
}

/**
 * Set template path callback functions
 */

function mab_gforms_get_default_template_dir( $dir, $type ){
	if( MAB_GFORMS_TYPE == $type ){
		return MAB_GFORMS_VIEWS . 'actionbox/';
	} else {
		return $dir;
	}
}

function mab_gforms_get_default_template_url( $dir, $type ){
	if( MAB_GFORMS_TYPE == $type ){
		return MAB_GFORMS_VIEWS_URL . 'actionbox/';
	} else {
		return $dir;
	}
}

/**
 * Display the output of the Gforms action box
 */
function mab_gforms_the_content( $content, $action_box_obj ){

	$type = $action_box_obj->getActionBoxType();

	//process only our action box type
	if( MAB_GFORMS_TYPE != $type ) return $content;

	$meta = $action_box_obj->getMeta();
	$meta = $meta['gforms'];

	/* TODO: add option for tab index **/
	$tab_index = 1;

	$form_id = !empty( $meta['form-id'] ) ? $meta['form-id'] : 0;
	$show_title = !empty($meta['show-title']) ? true : false;
	$show_desc = !empty($meta['show-desc']) ? true : false;
	$do_ajax = !empty($meta['ajax']) ? true : false;

	//credits: from gforms code
	$field_values = !empty($meta['field-values']) ? htmlspecialchars_decode($meta['field-values']) : '';
	$field_values = str_replace("&#038;", "&", $field_values);
    parse_str($field_values, $field_value_array); //parsing query string like string for field values and placing them into an associative array
    $field_value_array = stripslashes_deep($field_value_array);

	//if( empty( $form_id ) ) return '';

	$form = RGForms::get_form($form_id, $show_title, $show_desc, false, $field_value_array, $do_ajax, $tab_index);

	return $form;
}

/**
 * Add our own styles and scripts when our action box type is used
 */
function mab_gforms_enqueue_assets( $type, $template_obj ){
	if( MAB_GFORMS_TYPE != $type ) return;

	wp_enqueue_style( 'mab-gforms-css', MAB_GFORMS_ASSETS_URL . 'style.css' );
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
function mab_gforms_get_view( $filename, $data = null ){
	$parent = MAB_GFORMS_VIEWS;
	return MAB_Utils::getView( $filename, $data, $parent );
}