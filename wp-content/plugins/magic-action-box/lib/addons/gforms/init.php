<?php
/** Definitions **/
define( 'MAB_GFORMS_TYPE', 'gforms' );
define( 'MAB_GFORMS_DIR', MAB_ADDONS_DIR . 'gforms/' );
define( 'MAB_GFORMS_URL', MAB_ADDONS_URL . 'gforms/' );
define( 'MAB_GFORMS_VIEWS', MAB_GFORMS_DIR . 'views/' );
define( 'MAB_GFORMS_VIEWS_URL', MAB_GFORMS_URL . 'views/' );
define( 'MAB_GFORMS_ASSETS_URL', MAB_GFORMS_URL . 'assets/' );

/** Load required files **/
require_once dirname(__FILE__) . "/functions.php";

/** Initialize our addon **/
add_action( 'mab_init', 'mab_gforms_init' );

function mab_gforms_init(){

	/** 
	 * Register GFORM action box type
	 *
	 * but make sure Gravity Forms plugin is activated
	 * by checking for the existence of the RGForms class
	 **/
	$disabled = class_exists('RGForms') ? false : true;

	mab_gforms_register_action_box_type( $disabled );

	/** Stop if RGForms does not exists **/
	if( $disabled ) return;

	/** Add meta boxes **/
	add_action('mab_add_meta_boxes-' . MAB_GFORMS_TYPE, 'mab_gforms_add_meta_boxes' );

	/** Set template paths **/
	//add_filter( 'mab_get_default_template_dir', 'mab_gforms_get_default_template_dir', 10, 2 );
	//add_filter( 'mab_get_default_template_url', 'mab_gforms_get_default_template_url', 10, 2 );

	/** Enqueue our css/js **/
	add_action( 'mab_enqueue_assets', 'mab_gforms_enqueue_assets', 10, 2 );

	/** Display the output of our action box **/
	add_filter( 'mab_default_action_box_content', 'mab_gforms_the_content', 10, 2 );
}