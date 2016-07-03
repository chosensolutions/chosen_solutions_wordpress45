<?php
/** Definitions **/
define( 'MAB_CF7_TYPE', 'cf7' );
define( 'MAB_CF7_DIR', MAB_ADDONS_DIR . 'contactform7/' );
define( 'MAB_CF7_URL', MAB_ADDONS_URL . 'contactform7/' );
define( 'MAB_CF7_VIEWS', MAB_CF7_DIR . 'views/' );
define( 'MAB_CF7_VIEWS_URL', MAB_CF7_URL . 'views/' );
define( 'MAB_CF7_ASSETS_URL', MAB_CF7_URL . 'assets/' );

/** Load required files **/
require_once dirname(__FILE__) . "/functions.php";

/** Initialize our addon **/
add_action( 'mab_init', 'mab_cf7_init' );

function mab_cf7_init(){

	/** 
	 * Register CF7 action box type
	 *
	 * but make sure Contact Form 7 plugin is activated
	 * by checking for the existence of the WPCF7_ContactForm class
	 **/
	$disabled = class_exists('WPCF7_ContactForm') ? false : true;

	mab_cf7_register_action_box_type( $disabled );

	/** Stop if WPCF7_ContactForm does not exists **/
	if( $disabled ) return;

	/** Add meta boxes **/
	add_action('mab_add_meta_boxes-' . MAB_CF7_TYPE, 'mab_cf7_add_meta_boxes' );

	/** Set template paths **/
	//add_filter( 'mab_get_default_template_dir', 'mab_cf7_get_default_template_dir', 10, 2 );
	//add_filter( 'mab_get_default_template_url', 'mab_cf7_get_default_template_url', 10, 2 );

	/** Enqueue our css/js **/
	add_action( 'mab_enqueue_assets', 'mab_cf7_enqueue_assets', 10, 2 );

	/** Display the output of our action box **/
	add_filter( 'mab_default_action_box_content', 'mab_cf7_the_content', 10, 2 );
}