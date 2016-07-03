<?php

class MAB_Assets extends MAB_Base{

	public static function enqueue(){
		wp_enqueue_script( 'mab-ajax-form' );
		wp_localize_script('mab-ajax-form', 'MabAjax', MAB_Ajax::getAjaxData() );
	}

	/**
	 * Register all our JS and CSS files
	 * @return none
	 */
	public static function register(){

		/** Scripts **/		
		wp_register_script( 'mab-wpautop-fix', MAB_ASSETS_URL . 'js/wpautopfix.js', array( 'jquery' ), MAB_VERSION );
		wp_register_script( 'mab-actionbox-helper', MAB_ASSETS_URL . 'js/actionbox-helper.js', array('jquery'), MAB_VERSION );
		wp_register_script( 'mab-responsive-videos', MAB_ASSETS_URL . 'js/responsive-videos.js', array('jquery'), MAB_VERSION, true);
		wp_register_script( 'mab-placeholder', MAB_ASSETS_URL . 'js/placeholder.js', array('jquery'), MAB_VERSION, true);
		wp_register_script( 'mab-ajax-form', MAB_ASSETS_URL . 'js/ajax-form.js', array( 'jquery' ), MAB_VERSION, true );
		wp_register_script( 'mab-postmatic', MAB_ASSETS_URL . 'js/postmatic.js', array( 'mab-ajax-form'), MAB_VERSION, true);
		
		/** ADMIN Scripts **/
		wp_register_script( 'mab-youtube-helpers', MAB_ASSETS_URL . 'js/youtube-helpers.js', array( 'jquery' ), MAB_VERSION );
		wp_register_script( 'mab-admin-script', MAB_ASSETS_URL . 'js/magic-action-box-admin.js', array('jquery', 'mab-youtube-helpers'), MAB_VERSION );
		wp_register_script( 'mab-design-script', MAB_ASSETS_URL . 'js/magic-action-box-design.js', array('farbtastic', 'thickbox' ), MAB_VERSION );
		wp_register_script( 'mab-style-settings-js', MAB_ASSETS_URL . 'js/style-settings.js', array('jquery'), MAB_VERSION, true);
		wp_register_script( 'mab-slide-reveal', MAB_ASSETS_URL . 'js/slidereveal.js', array('jquery'), MAB_VERSION, true);
		wp_register_script( 'mab-design-panel', MAB_ASSETS_URL . 'js/design-panel.js', array('jquery', 'mab-slide-reveal', 'jquery-ui-accordion'), MAB_VERSION, true );

		
		/** Styles **/
		wp_register_style( 'mab-font-awesome', MAB_ASSETS_URL . 'css/font-awesome.css', array(), MAB_VERSION);
		wp_register_style( 'mab-base-style', MAB_ASSETS_URL . 'css/magic-action-box-styles.css', array(), MAB_VERSION );
		
		/** ADMIN styles **/
		wp_register_style( 'mab-admin-style', MAB_ASSETS_URL . 'css/magic-action-box-admin.css', array(), MAB_VERSION );
		wp_register_style( 'mab-design-panel', MAB_ASSETS_URL . 'css/design-panel.css', array('mab-font-awesome'), MAB_VERSION);

		/** Languages **/
		load_plugin_textdomain( 'mab', false,  dirname(MAB_BASENAME) . '/languages/' );

	}

	public function __construct(){

	}
}