<?php

add_shortcode( 'magicactionbox', 'mab_get_actionbox_shortcode_wrap' );
add_shortcode( 'mab_button', 'mab_button_shortcode');
add_shortcode( 'mab_load_assets', 'mab_load_assets_shortcode');

function mab_get_actionbox_shortcode_wrap( $atts = array(), $content = '', $code = '' ){

	$default = array(
		'id' => null,
		'force_show' => false
	);
	extract( shortcode_atts( $default, $atts ) );

	return mab_get_actionbox( $id, true, $force_show);
}


/**
 * MAB Button Shortcode
 */
function mab_button_shortcode($atts = array(), $content = '', $code = ''){
	$default = array(
		'id' => null,
		'url' => '',
		'class' => 'help',
		'target' => '',
		'title' => '',
		'name' => '',
		'new_window' => false
	);

	$atts = shortcode_atts( $default, $atts );

	$atts['text'] = trim($content);

	return mab_button( $atts );
}

function mab_load_assets_shortcode($atts = array(), $content = '', $code = ''){
	$default = array(
		'id' => null
	);
	extract( shortcode_atts($default, $atts) );

	mab_load_actionbox_assets($id);
}