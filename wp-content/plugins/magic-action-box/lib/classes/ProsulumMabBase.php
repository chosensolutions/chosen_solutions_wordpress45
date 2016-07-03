<?php

		
class ProsulumMabBase extends MAB_Base{
	
	var $_post_type = 'action-box';
	var $_metakey_ActionBoxType = '_mab_action_box_type';
	var $_metakey_Duplicated = '_mab_action_box_duplicated';
	var $_metakey_Settings = '_mab_settings';
	var $_metakey_PostMeta = '_mab_post_meta';
	var $_metakey_DesignSettings = '_mab_design_settings';
	var $_option_CurrentVersion = '_mab_current_version';
	var $_option_NagNotice = '_mab_nag_notice';
	
	var $_optin_MailChimp_Lists = array();
	var $_optin_MailChimpMergeVars = array();
	var $_optin_AweberLists = array();

	private $_registered_action_box_types = array();
	
	function __construct(){
		
		$this->MAB('MAB', $this, true);
		$this->MAB('design', new ProsulumMabDesign, true);
		$this->MAB('button', new ProsulumMabButton, true);
		$this->MAB('settings', new MAB_Settings, true);
		$this->MAB('ajax', new MAB_Ajax, true);
		// experimental
		$this->MAB('api', new MAB_API, true);

		$this->loadFiles();

		// plugin addons
		$this->loadAddOns();

		//register post type
		add_action( 'setup_theme', array( $this, 'register_post_type' ) );
		add_filter('post_updated_messages', array( $this, 'actionbox_updated_messages') );
		
		//initialize
		add_action( 'plugins_loaded', array( __CLASS__, 'setupHooks' ));
		add_action( 'init', array( $this, 'init' ) );
	
		
		//Notices
		add_action('admin_notices',array( $this, 'updated_plugin_notice') );
		add_action('admin_init', array( $this, 'updated_plugin_notice_hide' ) );
	}
	
	
	function register_post_type(){
		$labels = array(
			'name' => __('Action Boxes', 'mab' ),
			'menu_name' => __('Action Boxes', 'mab' ),
			'all_items' => __('Action Boxes', 'mab' ),
			'singular_name' => __('Action Box', 'mab' ),
			'add_new' => __('Add New', 'mab' ),
			'add_new_item' => __('Add New Action Box', 'mab' ),
			'edit_item' => __('Edit Action Box', 'mab' ),
			'new_item' => __('New Action Box', 'mab' ),
			'view_item' => __('View Action Box', 'mab' ),
			'search_items' => __('Search Action Boxes', 'mab' ),
			'not_found' => __('No action boxes found', 'mab' ),
			'not_found_in_trash' => __('No action boxes found in Trash', 'mab' ),
			'parent_item_colon' => null
		);
		$args = array(
			'labels' => $labels,
			'description' => __('Action Boxes are designed to increase conversions for your product. Create them quickly and easily.', 'mab' ),
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_menu' => false,
			'hierarchichal' => false,
			'menu_position' => 777,
			'capability_type' => 'post',
			'rewrite' => false,
			'menu_icon' => MAB_ASSETS_URL . 'images/cube.png',
			'query_var' => true,
			'capability_type' => 'post',
			//added support for comments due to a hacky part. Read about it in ProsuluMabAdmin::addActions()
			'supports' => array( 'title','comments' ),
			'register_meta_box_cb' => array( $this, 'register_meta_box_cb' )
		);
		register_post_type( $this->_post_type, $args );
	}
	
	function actionbox_updated_messages( $msg ){
		global $post, $post_ID;
		
		$msg[$this->_post_type] = array(
			0 => '', //unused. Messages start at index 1.
			1 => __('Action Box updated.','mab'),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('Action Box updated.'),
			/* translators: %s: date and time of the revision */
			5 => isset($_GET['revision']) ? sprintf( __('Action Box restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('New Action Box created.'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Action Box saved.'),
			8 => __('Action Box submitted.','mab'),
			9 => sprintf( __('Product Page scheduled for: <strong>%1$s</strong>.','mab'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
			10 => __('Action Box draft updated.','mab' )
		);
		
		return $msg;
	}
	
	function loadFiles(){
		
		//TODO: call class Design_Settings?
		require_once( MAB_LIB_DIR . 'functions.php' );
		require_once( MAB_LIB_DIR . 'update.php' );
		require_once( MAB_LIB_DIR . 'utility.php' );
		require_once( MAB_LIB_DIR . 'design-utilities.php' );
		require_once( MAB_LIB_DIR . 'design-settings.php' );
		require_once( MAB_LIB_DIR . 'stylesheets.php' );

		require_once( MAB_LIB_DIR . 'shortcodes.php' );
		
		//deprecated stuff
		require_once( MAB_CLASSES_DIR . 'deprecated-classes.php' );
	}

	function loadAddOns(){
		/** TODO: load addons automatically **/
		require_once MAB_ADDONS_DIR . 'load-addons.php';
		
		do_action('mab_load_addons');

		do_action('mab_addons_loaded');
	}

	public static function setupHooks(){
		require_once( MAB_LIB_DIR . 'filter_functions/optin-form-output.php' );
		require_once( MAB_LIB_DIR . 'filter_functions/process-optin-form.php' );

		// setup the filters
		require_once( MAB_LIB_DIR . 'setup-filters.php' );
	}
	
	function init(){
		
		$this->_initialize_action_box_types();
		//$this->loadAddOns();
		
		global $Mab;
		$Mab = new ProsulumMab();

		MAB_OptinProviders::init();

		do_action('mab_init');

		if( is_admin() ){
			//global $MabAdmin;
			//$MabAdmin = new ProsulumMabAdmin();
			$this->MAB('admin', new ProsulumMabAdmin);
		}

		do_action('mab_post_init');
	}
	
	function register_meta_box_cb( $post ){

		$MabMetaBoxes = new MAB_MetaBoxes( $post );
		$MabMetaBoxes->initMetaboxes();
	}

	/**
	 * Initialize action box types array
	 * @return none
	 */
	private function _initialize_action_box_types(){
		$boxes = array();

		$upgrade = sprintf(__('<em><small>(Available in <a href="%s" target="_blank">Magic Action Box Pro</a>)</small></em><br />'), 'http://www.magicactionbox.com/features/?pk_campaign=LITE&pk_kwd=addScreen');

		//Optin
		$boxes['optin'] = array( 'type' => 'optin', 'name' => __('Optin Form', 'mab' ), 'description' => __('An opt in form is used to build your email list.','mab'), 'template' => 'optin', 'status' => 'enabled' );
		
		//Sales Box
		$boxes['sales-box'] = array( 'type' => 'sales-box', 'name' => __('Sales Box', 'mab' ), 'description' => $upgrade . __('A simple sales box. Use it to lead visitors to your sales page.','mab'), 'template' => 'sales-box', 'status' => 'false' );
		
		//Social Media
		$boxes['share-box'] = array( 'type' => 'share-box', 'name' => __('Share Box', 'mab' ), 'description' => $upgrade . __('Action box made for sharing your content','mab'), 'template' => 'share-box', 'status' => 'false' );
		
		$this->_registered_action_box_types = apply_filters( 'mab_initialize_action_box_types', $boxes );
	}

	/**
	 * Register action box type
	 *
	 * Adds to array of registered action box types
	 * 
	 * Form the array $box like this:
	 * $box = array(
	 *    'type'        => 'action-box-type', //use letters, numbers, underscore, dash only
	 *    'name'        => 'Human readable name',
	 *    'description' => 'Short description about the action box type',
	 *    'status' => 'enabled'
	 * );
	 *
	 * $box['status'] should be one of the following: enabled, disabled
	 * 
	 * @param  array  $box 
	 * @return bool   true on successful registration, false otherwise
	 */
	function register_action_box_type( $box = array() ){
		/**
		 * TODO: validate array keys and values
		 */
		
		$this->_registered_action_box_types[ $box['type'] ] = $box;
	}

	/**
	 * Get action box type
	 *
	 * Returns information about the action box type as an associative array.
	 * Returns false if the specified type is not registered.
	 * 
	 * @param  string $type type id of the box
	 * @param  string $status 'enabled', 'disabled', 'all', 'any'
	 * @return array|bool
	 */
	function get_registered_action_box_type( $type, $status = 'enabled' ){

		$boxTypes = $this->_registered_action_box_types;

		if( isset( $boxTypes[ $type ] ) ){

			$data = $boxTypes[$type];
			$data_status = !empty($data['status']) ? $data['status'] : '';

			if( $status == 'all' || $status == 'any' || $data_status == $status ){
				return $data;
			}
		}

		return false;
	}

	/**
	 * Get action box types
	 *
	 * @param  string $status 'enabled', 'disabled', 'all', 'any'
	 * 
	 * @return array registered action box types
	 */
	function get_registered_action_box_types( $status = 'enabled' ){

		//set $status to a defined state.
		if( empty($status) ) $status = 'enabled';

		if( $status == 'all' || $status == 'any' ){
			return $this->_registered_action_box_types;
		} else {

			$return = array();

			foreach( $this->_registered_action_box_types as $key => $val ){
				
				$val_status = !empty($val['status']) ? $val['status'] : '';

				if( $val_status == $status )
					$return[$key] = $val;
			}

			return $return;
		}
	}
	
	public static function register_widgets(){
		
		register_widget( 'MAB_Widget' );
	}
	
	function get_post_type(){
		return $this->_post_type;
	}
	
	/**
	 * Synonymous function to get_action_box_type() method
	 */
	function get_actionbox_type( $post_id ){
		return $this->get_action_box_type( $post_id );
	}

	/**
	 * Get the type of the action box post type
	 * @param  int $post_id the post type ID
	 * @return string type of action box
	 */
	function get_action_box_type( $post_id ){
		return $this->get_mab_meta( $post_id, 'type' );
	}
	
	function is_mab_post_type( $type = '' ){
		global $post;
		
		/*
		if( !is_object( $post ) ){
			return false;
		}
		*/
		
		if( empty($type) ){
			//return is_singular( $this->_post_type );
			$type = $post->post_type;
		}
		
		return ( $type == $this->_post_type );
	}
	
	function get_allowed_content_types(){
		//TODO: have allowed content types as an option
		$allowed = apply_filters('mab_allowed_post_types', array( 'post', 'page', 'landing_page' ) );
		
		return $allowed;
	}
	
	function is_allowed_content_type( $type = '' ){
		global $post;
		
		if( !is_object( $post ) ){
			return false;
		}
		
		if( empty( $type ) ){
			$type = $post->post_type;
		}
		
		$allowed = $this->get_allowed_content_types();
		
		if( in_array( $type, $allowed ) )
			return true;
		else
			return false;
	}
	
	function get_mab_meta( $post_id, $meta_key = '' ){
		global $post;

		if( empty( $post_id ) )
			$post_id = $post->ID;
		
		$key = $this->get_meta_key( $meta_key );
		
		$settings = wp_cache_get( $key, $post_id );
		
		if( !$settings || !is_array( $settings ) ){
			$settings = get_post_meta( $post_id, $key, true );
			//wp_cache_set( $key, $settings, $post_id, time() + 24*60*60 );
		}
		return $settings;
	}
	
	function update_mab_meta( $post_id, $meta, $meta_key = '' ){
		global $post;
		
		if( !is_array( $meta ) )
			return;
		
		if( empty( $post_id ) )
			$post_id = $post->ID;
			
		$key = $this->get_meta_key( $meta_key );
		$status = update_post_meta( $post_id, $key, $meta );
		//wp_cache_set( $key, $meta, $post_id, time() + 24*60*60 );
		
		return $status;
	}
	
	function get_meta_key( $meta_key = '' ){
		switch( $meta_key ){
			case 'type':
				$key = $this->_metakey_ActionBoxType;
				break;
			case 'duplicate':
				$key = $this->_metakey_Duplicated;
				break;
			case 'post':
				$key = $this->_metakey_PostMeta;
				break;
			case 'design':
				$key = $this->_metakey_DesignSettings;
				break;
			default:
				$key = $this->_metakey_Settings;
				break;
		}
		
		return $key;
	}
	
	function get_selected_style( $actionBoxId ){
		$postmeta = $this->get_mab_meta( $actionBoxId );
		return $postmeta['style'];
	}
	
	function get_css_directory() {
		$info = wp_upload_dir();
		return trailingslashit($info['basedir']).'magic-action-box/';
	}

	function get_css_url() {
		$info = wp_upload_dir();
		return trailingslashit($info['baseurl']).'magic-action-box/';
	}

	function get_theme_directory() {
		return MAB_THEMES_DIR . 'magic-action-box';
	}
	function create_stylesheet( $key = '', $section = 'all' ) {
		require_once( MAB_LIB_DIR . 'stylesheets.php' );
		mab_create_stylesheet( $key, $section );
	}
	function create_actionbox_stylesheet( $postId = null, $section = 'all' ){
		require_once( MAB_LIB_DIR . 'stylesheets.php' );
		mab_create_actionbox_stylesheet( $postId, $section );
	}
	
	/**
	 * MailChimp
	 */
	function get_mailchimp_merge_vars( $id ) {
		require_once MAB_LIB_DIR . 'integration/mailchimp/Mailchimp.php';

		$settings = MAB('settings')->getAll();
		$mailchimp = new Mailchimp($settings['optin']['mailchimp-api']);

		if( !isset( $this->_optin_MailChimpMergeVars[$id] ) ) {
			$vars = get_transient( 'mailchimp_merge_vars_' . $id );
			if( !is_array( $vars ) ) {
				$vars = $mailchimp->lists->listMergeVars( $id );
				set_transient( 'mailchimp_merge_vars_' . $id, $vars, 1*60*60 );//store for one hour
			}
			$this->_optin_MailChimpMergeVars[$id] = $vars;
		}

		return $this->_optin_MailChimpMergeVars[$id];
	}
	
	function get_mailchimp_account_details( $apikey = '' ){
		require_once MAB_LIB_DIR . 'integration/mailchimp/Mailchimp.php';
		if( empty( $apikey ) ){
			$settings = MAB('settings')->getAll();
			$apikey = $settings['optin']['mailchimp-api'];
		}
		$mailchimp = new Mailchimp($apikey);
		$details = $mailchimp->helper->accountDetails();
		return $details;
	}
	
	function validate_mailchimp_key( $key ) {
		if(empty($key)){
			return array( 'error' => __( 'MailChimp API key is empty.', 'mab' ) );
		}

		require_once MAB_LIB_DIR . 'integration/mailchimp/Mailchimp.php';

		try{
			$mailchimp = new Mailchimp($key);
			$res = $mailchimp->helper->ping();
			if( !$res )
				return array( 'error' => __( 'Invalid MailChimp API key - ' . $res, 'mab' ) );

		} catch(Exception $e){
			return array( 'error' => __( 'Invalid MailChimp API key: ' . $e->getMessage(), 'mab' ) );
		}

		return true;
	}
	
	function signup_user_mailchimp( $vars, $list ){
	}
	
	/** UTILITY FUNCTIONS **/
	function RGB2hex( $color ){
		$color = str_replace( '#', '', $color );
		if( strlen( $color ) != 6 )
	    		return array(0,0,0);
	    	
		$rgb = array();
		for( $x = 0; $x < 3; $x++ )
			$rgb[$x] = hexdec( substr( $color, ( 2 * $x ), 2 ) );

		return implode( ',', $rgb );
	}

	function get_current_version(){
		return get_option( $this->_option_CurrentVersion, '0.1' );
	}

	function updated_plugin_notice(){
		global $current_user;

		/** Welcome Message */
		$is_multisite = is_multisite();
		$is_network_admin = current_user_can('manage_network');

		$check_new_install = false;
		if($is_multisite){
			if($is_network_admin){
				$check_new_install = true;
			}
		} else {
			if(current_user_can('manage_options')){
				$check_new_install = true;
			}
		}

		$is_showing_welcome = false;
		if($check_new_install && !get_option(MAB::KEY_INSTALL_DATE)){
			$is_showing_welcome = true;
			echo '<div class="updated"><p>';
			printf( __('You have installed Magic Action Box %1$s. <a href="%2$s">Close</a>', 'mab'), MAB_VERSION, add_query_arg( array('mab-hide-welcome-notice' => 'true' ) ) );
			echo '</p></div>';
		}

		/** Update Message */
		$nag_version = get_option(MAB::KEY_NOTICE, '0.1');

		if ( !$is_showing_welcome && current_user_can( 'manage_options' ) ){

			//check that this noticed hasn't already been dismissed
			if( version_compare( $nag_version, MAB_VERSION, '<' ) ){
			
				echo '<div class="updated"><p>';
				printf( __('Magic Action Box plugin has been updated to version %s. <a href="%s">Go to the dashboard</a>. | <a href="%s">Close</a>', 'mab'), MAB_VERSION, admin_url('admin.php?page=mab-main'), add_query_arg( array('mab-hide-update-notice' => 'true' ) ) );
				echo '</p></div>';

			}
			
			//check Magic Action Popup
			if( class_exists( 'MagicActionPopupBase' ) ){
				$map_version = MAP_VERSION;

				if( (double) $map_version <= 1.7 && !get_option( 'map-incompatible-version-' . $this->get_current_version() ) ){
					echo '<div class="error"><p>';
					printf( __('Old version of Magic Action Popup detected. This version is not compatible with the latest version of Magic Action Box. Please update Magic Action Popup plugin now. <a href="%1$s">Hide notice</a>', MAB_DOMAIN), add_query_arg( array('mab-hide-map-notice' => 'true' ) ) );
					echo '</p></div>';
				}
			}
		}
	}
	
	function updated_plugin_notice_hide(){
		
		/*if user clicks to ignore the notice, then save that setting to option */
		if( isset( $_GET['mab-hide-update-notice'] ) && 'true' == $_GET['mab-hide-update-notice'] ){
			update_option( MAB::KEY_NOTICE, MAB_VERSION );
		}
		
		if( isset( $_GET['mab-hide-map-notice'] ) && 'true' == $_GET['mab-hide-map-notice'] ){
			$val = 1;
			update_option( 'map-incompatible-version-' . $this->get_current_version(), $val );
		}

		if( isset( $_GET['mab-hide-welcome-notice'] ) && 'true' == $_GET['mab-hide-welcome-notice'] ){
			update_option( MAB::KEY_INSTALL_DATE, time() );
		}
	}
	

	public static function version_to_footer(){
		echo '<!--mabv' . MAB_VERSION . '-->';
	}

}