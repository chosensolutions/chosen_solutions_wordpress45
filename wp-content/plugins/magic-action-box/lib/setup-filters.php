<?php

/**
 * Register and enqueue CSS and JS assets
 */
add_action( 'init', array('MAB_Assets', 'register'), 1 );
add_action( 'wp_enqueue_scripts', array('MAB_Assets', 'enqueue'));

/**
 * AJAX
 */
if(defined('DOING_AJAX')){
	MAB_Ajax::setup();
}

/**
 * Process ajax submission to optin forms
 */
add_filter('mab_process_postmatic_optin_submit', 'mab_process_postmatic_optin_submit', 10, 2);
add_filter('mab_process_constantcontact_optin_submit', 'mab_process_constantcontact_optin_submit', 10, 2);
add_filter('mab_process_wysija_optin_submit', 'mab_process_wysija_optin_submit', 10, 2);

/**
 * Setup Widgets
 */
add_action( 'widgets_init', array( 'ProsulumMabBase', 'register_widgets' ) );

/**
 * Default optin settings html
 */
foreach(MAB_OptinProviders::getDefault() as $k => $v){
	add_filter("mab_get_{$k}_settings_html", array('MAB_MetaBoxes', 'getDefaultOptinSettingsHtml'), 10, 3);

	// @see MAB_Template::getOptinForm() for reference
	add_filter("mab_{$k}_optin_form_output", "mab_{$k}_form_html", 10, 2);
}


/**
 * Version to Footer
 */
add_action('wp_footer', array('ProsulumMabBase', 'version_to_footer'), 100);