<?php
/**
 * Meta boxes for the Action Box post type
 **/
class MAB_MetaBoxes{
	private $_post = null;
	
	function __construct( $post ){
		$this->_post = $post;

		/* Action hooks */
		add_action('mab_add_meta_boxes', array( $this, 'loadActionBoxGeneralMetaboxes'));
		add_action('mab_add_meta_boxes', array( $this, 'loadActionBoxSpecificMetaboxes'));
		add_action('mab_add_meta_boxes_semi', array( $this, 'loadCustomCssSettingsBox' ));
		add_action('mab_add_meta_boxes_semi', array($this, 'loadDebugBox'));

		do_action('mab_init_meta_boxes', $this, $post);
	}

	function initMetaboxes(){
		$MabBase = MAB();
		$post = $this->_post;

		//get post type name
		$post_type = $MabBase->get_post_type();
		
		//remove unneeded metaboxes
		remove_meta_box( 'commentstatusdiv' , $MabBase->get_post_type() , 'normal' ); //removes comments status
		remove_meta_box( 'commentsdiv' , $MabBase->get_post_type() , 'normal' ); //removes comments
		
		//remove Publish metabox as we will be replacing this with out own
		remove_meta_box('submitdiv', null, 'side');
		add_meta_box('mab-publish', __('Save Action Box', MAB_DOMAIN), array($this,'saveBox'), $MabBase->get_post_type(), 'side', 'high' );
		
		add_meta_box('mab-duplicate', __('Duplicate Action Box', MAB_DOMAIN), array( $this, 'duplicateBox' ), $MabBase->get_post_type(), 'side', 'high' );
		
		//general design settings
		//add_meta_box( 'mab-general-design-settings', __('Design Setting: General', 'mab' ), array( &$this, 'generalDesignSettings' ), $post_type, 'advanced', 'high' );
		
		//heading design settings
		//add_meta_box( 'mab-heading-design-settings', __('Design Setting: Headings', 'mab' ), array(&$this, 'headingDesignSettings' ), $post_type, 'advanced', 'high' );
		
		//show metaboxes specific to action box type
		$type = $MabBase->get_actionbox_type( $post->ID );

		$withDesign = array('optin', 'sales-box', 'share-box', 'cf7', 'gforms');

		if(in_array($type, $withDesign)){
			//add_meta_box('mab-design-panel', __('Design Panel', 'mab'), array( $this, 'designPanel'), MAB::POST_TYPE, 'side', 'high');
		}
		
		//load metaboxes specific to the action box type
		do_action( 'mab_add_meta_boxes', $type, $this );
		do_action( 'mab_add_meta_boxes-' . $type, $this );

		do_action( 'mab_add_meta_boxes_semi', $type, $this );
		do_action( 'mab_add_meta_boxes_advanced', $type, $this );
	}

	/**
	 * Load metabox for all action boxes
	 * 
	 * @param  string $type type of action box
	 * @return none
	 */
	function loadActionBoxGeneralMetaboxes( $type ){
		$MabBase = MAB();
		$post_type = $MabBase->get_post_type();
		add_meta_box( 'mab-actionbox-settings', __('Action Box: General Settings', 'mab' ), array( $this, 'actionBoxSettings' ), $post_type, 'normal', 'high' );
	}
	
	/**
	 * Load metaboxes specific to an action box type
	 * @param  string $type type of action box
	 * @return none
	 */
	function loadActionBoxSpecificMetaboxes( $type ){
		$MabBase = MAB();

		//get post type name
		$post_type = $MabBase->get_post_type();
		
		switch( $type ){
			case 'optin':
				//optin metaboxes
				add_meta_box( 'mab-optin-settings', __('Opt In Form Settings','mab' ), array( &$this, 'optInSettings' ), $post_type, 'normal', 'high' );
				add_meta_box( 'mab-optin', __( 'Opt In Copy', 'mab' ), array( &$this, 'optIn' ), $post_type, 'normal', 'high' );
				add_meta_box( 'mab-actionbox-aside', __('Action Box: Side Content', 'mab' ), array( &$this, 'actionBoxAside' ), $post_type, 'normal', 'high' );
				break; ##BREAK
			default:
				break;
		}

	}

	/**
	 * Default Option Boxes
	 *
	 * This function is intended to be used "inside" other metabox templates.
	 *
	 * Example:
	 * 
	 * $meta = $MabBase->get_mab_meta($postId);
	 * MAB_MetaBoxes::optionBox('field-labels', $meta);
	 * 
	 * @param  $name the filename of the option box file template
	 * @param  $data data array for the option box template.
	 * @return  html
	 */
	public static function optionBox($name = '', $data = array()){

		$name = sanitize_file_name($name);
		
		if(empty($name)) return '';

		$filename = "metaboxes/option-boxes/{$name}.php";
		return MAB_Utils::getView($filename, $data);
	}

	/**
	 * Loads Custom CSS Metabox
	 * 
	 * @return none
	 */
	function loadCustomCssSettingsBox(){
		$MabBase = MAB();

		//get post type name
		$post_type = $MabBase->get_post_type();

		add_meta_box( 'mab-custom-css-settings', __('Design Settings: Custom CSS', 'mab' ), array( $this, 'customCssBox' ), $post_type, 'advanced', 'default' );
	}

	/**
	 * Load debug box
	 */
	function loadDebugBox(){
		$post_type = MAB_POST_TYPE;
		add_meta_box( 'mab-debug', __('Debug', 'mab' ), array( $this, 'debugBox' ), $post_type, 'advanced', 'low' );
	}
	
	/**
	 * The Meta Boxes
	 * ========================== */
	
	/* Save Action Box */
	function saveBox( $post ){
		$filename = 'metaboxes/save-box.php';
		$data = $post;
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}
	
	/* Duplicate Action Box */
	function duplicateBox( $post ){
		$data = array('post_id' => $post->ID );
		$filename = 'metaboxes/duplicate.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}

	/* Design Panel */
	public function designPanel($post){
		$filename = 'metaboxes/design-panel.php';
		echo MAB_Utils::getView($filename);
	}
	
	/*  Custom CSS Settings */
	function customCssBox( $post ){
		$MabBase = MAB();
		$meta = $MabBase->get_mab_meta( $post->ID, 'design' );
		$data['custom_css'] = isset( $meta['mab_custom_css'] ) ? $meta['mab_custom_css'] : '';
		$filename = 'metaboxes/metabox-customcss.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}
	
	/** ALL ACTION BOXES **/
	/* General Settings */
	function actionBoxSettings( $post ){
		$MabAdmin = MAB('admin');
		$MabBase = MAB();

		$data['meta'] = $MabBase->get_mab_meta( $post->ID );
		$data['assets-url'] = MAB_ASSETS_URL;
		
		//get available action box styles
		$data['styles'] = ProsulumMabDesign::baseStyles();
		
		$filename = 'metaboxes/type/actionbox-settings.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}

	/* Debug */
	function debugBox($post){
		$actionBox = MAB_ActionBox::get($post->ID);

		if(is_null($actionBox)){
			$data['meta'] = array();
		} else {
			$data['meta'] = $actionBox->getMeta();
		}

		$filename = 'metaboxes/debug.php';
		echo MAB_Utils::getView($filename, $data);
	}
	
	/* Content */
	function actionBoxContent( $post ){
		$MabAdmin = MAB('admin');
		$MabBase = MAB();
		$data['meta'] = $MabBase->get_mab_meta( $post->ID );
		$data['assets-url'] = MAB_ASSETS_URL;
		$filename = 'metaboxes/type/actionbox-content.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}
	
	/* Aside */
	function actionBoxAside( $post ){
		$MabAdmin = MAB('admin');
		$MabBase = MAB();
		$data['meta'] = $MabBase->get_mab_meta( $post->ID );
		$data['assets-url'] = MAB_ASSETS_URL;		
		$filename = 'metaboxes/type/actionbox-aside.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}
	
	/** OPT IN SPECIFIC **/
	function optIn( $post ){
		$MabAdmin = MAB('admin');
		$MabBase = MAB();
		$data['meta'] = $MabBase->get_mab_meta( $post->ID );
		$data['assets-url'] = MAB_ASSETS_URL;
		$filename = 'metaboxes/type/optin.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}
	
	function optInSettings( $post ){
		$MabAdmin = MAB('admin');
		$MabBase = MAB();
		$MabButton = MAB('button');
		$data['meta'] = $MabBase->get_mab_meta( $post->ID );

		$data['assets-url'] = MAB_ASSETS_URL;
		
		//get allowed optin providers
		$data['optin-providers'] = MAB_OptinProviders::getAllAllowed();
		
		if(!empty($data['meta']['optin-provider'])){
			$data['optin-provider-html'] = MAB_MetaBoxes::getOptinSettingsHtml($data['meta']['optin-provider'], $post->ID); 
		} else {
			$data['optin-provider-html'] = MAB_MetaBoxes::getOptinSettingsHtml('manual', $post->ID); 
		}

		//get available action box styles
		$data['styles'] = MAB_Utils::getStyles();

		//get buttons
		$data['buttons'] = $MabButton->getConfiguredButtons();
		
		$filename = 'metaboxes/type/optin-settings.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}

	public static function getOptinSettingsHtml($provider, $postId =null){

		$html = apply_filters("mab_get_{$provider}_settings_html", '', $provider, $postId );
		return apply_filters('mab_get_optin_settings_html', $html, $provider, $postId );
	}

	public static function getDefaultOptinSettingsHtml($html, $provider, $postId){
		$MabAdmin = MAB('admin');
		$MabBase = MAB();
		$MabButton = MAB('button');
		
		if(!empty($postId))
			$data['meta'] = $MabBase->get_mab_meta( $postId );
		else
			$data['meta'] = array();

		//get buttons
		$data['buttons'] = $MabButton->getConfiguredButtons();

		$settings = MAB('settings')->getAll();

		if($provider == 'mailchimp' && !empty($data['meta']['optin']['mailchimp']) && !empty($settings['optin']['allowed']['mailchimp'])){
			$listId = !empty($data['meta']['optin']['mailchimp']['list']) ? $data['meta']['optin']['mailchimp']['list'] : '';

			$data['mcGroups'] = $MabAdmin->getMailChimpGroups($listId);
		}
		
		$filename = "metaboxes/optin-providers/{$provider}.php";
		$box = MAB_Utils::getView( $filename, $data );
		return $box;
	}
	
	function optinFormDesignSettings( $post ){
		mab_form_design_settings( $post );
	}
	
	/** OTHER CUSTOM POST TYPES METABOX **/
	//put metabox in selected content types
	static function postActionBox( $post ){
		$MabBase = MAB();
		
		$data['meta'] = $MabBase->get_mab_meta( $post->ID, 'post' );
		$data['assets-url'] = MAB_ASSETS_URL;
		$filename = 'metaboxes/post-select-actionbox.php';
		$box = MAB_Utils::getView( $filename, $data );
		echo $box;
	}
	

}
