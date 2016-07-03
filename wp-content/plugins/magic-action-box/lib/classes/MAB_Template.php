<?php

class MAB_Template extends MAB_Base{
	private $_actionbox_obj = null;
	private $_template_dir = '';
	private $_template_url = '';
	private $_template_file = '';
	private $_template_style_dir = '';
	private $_template_style_url = '';
	private $_is_default = true;
	
	private static $_current_template_dir = '';
	private static $_current_template_url = '';
	private static $_current_template_file = '';
	private static $_current_template_style_dir = '';
	private static $_current_template_style_url = '';
	private static $_current_actionbox_obj = null;

	protected $classes = array(); // css class
	protected $htmlData = array(); // html data i.e. data-color="red"
	protected $inlineStyles = array(); // inline styles
	
	public function getTemplate(){
		
		$actionBoxObj = $this->_actionbox_obj;
		
		if( !$actionBoxObj->isConfigured() ) return '';

		/**
		 * NOTES:
		 * self::setCurrentTemplateVars() isn't currently used anywhere.
		 * Not really sure why I created this though :P
		 */
		self::setCurrentTemplateVars( $actionBoxObj );
		
		$type = $actionBoxObj->getActionBoxType();
		$template = apply_filters('mab_get_template', '', $type, $actionBoxObj );
		$output = apply_filters('mab_get_template-' . $type, $template, $actionBoxObj );
		
		if( empty( $output ) ){
			$output = self::getActionBoxDefaultCallback( $actionBoxObj );
		}

		self::resetCurrentTemplateVars();
		
		return apply_filters('mab_template_output', $output, $actionBoxObj);
	}

	/**
	 * Load Assets
	 */
	function loadAssets(){
		$actionBoxObj = $this->_actionbox_obj;
		
		if( !$actionBoxObj->isConfigured() ) return;
		
		$style = $actionBoxObj->getstyleKey();
		
		if( $style === '' ) return;
		
		$actionBoxType = $actionBoxObj->getActionBoxType();

		do_action( 'mab_pre_enqueue_assets', $actionBoxType, $this );
		do_action( 'mab_enqueue_stylesheet', $style, $this ); 
		do_action( 'mab_enqueue_assets', $actionBoxType, $this );
		
	}

	static function loadStylesheets( $style, $templateObj ){

		$actionBoxObj = $templateObj->_actionbox_obj;
		$meta = $actionBoxObj->getMeta();

		switch( $style ){
			case 'user':
				//get user style key
				$userStyleKey = $meta['userstyle'];
				
				//use style set by user
				$mabStylesheet = mab_get_settings_stylesheet_path( $userStyleKey );
				
				//create stylesheet file if its not created yet
				if( !file_exists( $mabStylesheet ) || trim( mab_get_settings_stylesheet_contents( $userStyleKey ) ) == '' ){
					mab_create_stylesheet( $userStyleKey );
				}
				
				if( file_exists( $mabStylesheet ) ){
					//actionbox specific stylesheet
					wp_enqueue_style( 'mab-user-style-'.$userStyleKey, mab_get_settings_stylesheet_url($userStyleKey), array( 'mab-base-style' ), filemtime( $mabStylesheet ) );
				}
				break; 
				// ===================
			
			case 'none':
				break;
				
			default:
				/** LOAD PRECONFIGURED STYLESHEET **/
				//$other_style_location = MAB_ASSETS_URL . 'css/style-';
				
				/* TODO: be able to load type specific stylesheets style-{TYPE}.css */
				
				//use one of the preconfigured styles
				//$preconfigured_style = $other_style_location . $style . '.css';
				$preconfigured_style = $templateObj->getTemplateStyleUrl() . "style.css";
				
				//if( file_exists( $preconfigured_style  ) ){ this is a url.. tsk.
					wp_enqueue_style( "mab-preconfigured-style-{$style}", $preconfigured_style , array('mab-base-style'), MAB_VERSION );
				//} else {
					//wp_enqueue_style( "mab-style-default", MAB_ASSETS_URL . 'css/style-default.css', array(), "1.0" );
				//}
				
				//wp_redirect( "{$preconfigured_style}" );
				

				break;
				// ==========================
		}//endswitch

	}

	static function loadCustomCss( $style, $templateObj ){
		
		$actionBoxObj = $templateObj->_actionbox_obj;
		$actionBoxId = $actionBoxObj->getId();

		/** LOAD CUSTOM CSS **/
		//get stylesheet which should contain only CSS in Custom CSS box under Design Setting: Custom CSS
		$custom_css_stylesheet = mab_get_actionbox_stylesheet_path( $actionBoxId );
		
		//create stylesheet file if its not created yet
		if( !file_exists( $custom_css_stylesheet ) || trim( mab_get_actionbox_stylesheet_contents( $actionBoxId ) ) == '' ){
			mab_create_actionbox_stylesheet( $actionBoxId );
		}
		
		if( file_exists( $custom_css_stylesheet ) ){
			//actionbox specific stylesheet
			wp_enqueue_style( "mab-actionbox-style-{$actionBoxId}", mab_get_actionbox_stylesheet_url($actionBoxId), array( ), filemtime( $custom_css_stylesheet ) );
		}
		
		/** LOAD BUTTONS CSS **/
		/* create custom buttons stylesheet if its not there */
		if( !file_exists( mab_get_custom_buttons_stylesheet_path() ) ){
			$MabButton = MAB('button');
			$MabButton->writeConfiguredButtonsStylesheet( $MabButton->getConfiguredButtons(), '' );
		}
		
		// load buttons stylesheet.		
		// we do this way to ensure that mab-custom-buttons-css stylesheet will always be the last
		// to load. this is especially important when two action boxes use custom buttons.
		if(wp_style_is('mab-custom-buttons-css', 'queue')){ 
			//dequeue the style so we can enqueue it to footer 
			wp_dequeue_style('mab-custom-buttons-css'); 
		} 

		$buttons_stylesheet = mab_get_custom_buttons_stylesheet_path();
		if( file_exists($buttons_stylesheet)){
			wp_enqueue_style( 'mab-custom-buttons-css', mab_get_custom_buttons_stylesheet_url(), array(), filemtime($buttons_stylesheet) );
		}

		/** LOAD MISC **/
	}
	
	/**
	 * Get Class Array
	 * @return array classes in array
	 */
	function getClassArray(){
		$actionBoxType = $this->_actionbox_obj->getActionBoxType();
		
		// remove duplicates. @see http://stackoverflow.com/a/5036538
		$classes = array_keys(array_flip($this->classes));

		return apply_filters( 'mab_actionbox_class', $classes, $actionBoxType, $this->_actionbox_obj );
	}
	
	function getClass(){
		// Separates classes with a single space, collates classes for .magic-action-box
		return 'class="' . implode( ' ', $this->getClassArray() ) . '"';
	}

	/**
	 * Adds css classes to $this->classes
	 * @param  string|array $class css class as space separated string or array
	 */
	function addClass($class){
		
		if(empty($class)) return false;

		// convert $class to an array if it's not yet one
		if(!is_array($class))
			$class = preg_split('#\s+#', $class);

		$class = array_map('esc_attr', $class);

		$this->classes = array_merge($this->classes, $class);

		return true;
	}

	/**
	 * Remove a value (css class) from $this->classes
	 * If no parameter is passed then $this->classes will be cleared
	 * @param string|array $toremove css can pass in multiple classes as space
	 *                               separated string or array
	 * @return  array returns the contents of $this->classes
	 */
	function removeClass($toremove=null){
		// make empty array
		if(is_null($toremove)){
			$this->classes = array();
			return true;
		}

		if(!is_array($toremove)){
			$toremove = preg_split('#\s+#', $toremove);
		}

		$this->classes = array_diff($this->classes, $toremove);

		return true;
	}

	/**
	 * Initialize css classes
	 * @return [type] [description]
	 */
	protected function initCssClass(){
		$actionBoxObj = $this->_actionbox_obj;

		// set up initial css classes
		$classes = array();
		
		$classes[] = 'magic-action-box';

		//action box type
		$actionBoxType = $actionBoxObj->getActionBoxType();
		$classes[] = 'mab-type-' . $actionBoxType;
		
		//action box id
		$classes[] = 'mab-id-'.$actionBoxObj->getId();

		$meta = $actionBoxObj->getMeta();
		
		//$meta['style'] will either be 'user' or 'id' of pre-designed style
		$selectedStyle = isset($meta['style']) ? 'mabstyle-'.$meta['style'] : '';//'mab-default';
		$classes[] = $selectedStyle;
		
		//custom user style/design
		if( $selectedStyle == 'mabstyle-user' ){
			$classes[] = 'userstyle-' . $meta['userstyle'];
		}

		//button style
		$buttonStyle = isset($meta['button-key']) ? $meta['button-key'] : 'default';
		$classes[] = 'use-mab-button-' . $buttonStyle;
		
		//fields layout
		if( isset( $meta['optin']['fields-layout'] ) ){
			$classes[] = 'mab-fields-layout-' . $meta['optin']['fields-layout'];
		} else {
			$classes[] = 'mab-fields-layout-default';
		}

		// label position
		if( isset($meta['optin']['label-position'])){
			$classes[] = 'mab-label-position-' . $meta['optin']['label-position'];
		}

		// width: auto; on submit button
		if( !empty($meta['optin']['auto-width-submit'])){
			$classes[] = 'mab-auto-width-submit';
		}

		//centered fields?
		if( !empty($meta['optin']['center-fields'])){
			$classes[] = 'mab-center-fields';
		}

		// responsive?
		if( !empty($meta['responsive'])){
			$classes[] = 'mab-responsive';
		}

		// horizontal?
		if( !empty($meta['layout'])){
			$classes[] = 'mab-layout-' . $meta['layout'];
		}

		// centered content
		if( !empty($meta['center-content'])){
			$classes[] = 'mab-center-content';
		}
		
		//TODO: aside placement class
		
		$this->classes = array_map( 'esc_attr', $classes );
	}

	/**
	 * For adding HTML data attribute
	 */
	function setHtmlData($name ,$value){
		if(empty($name)) return false;
		
		// lower case string
		$name = strtolower($name);

		// make alphanumeric
		$name = preg_replace("/[^a-z0-9_\s-]/", "", $name);

		// convert white space to dash
		$name = preg_replace("/[\s]/", "-", $name);

		$this->htmlData[$name] = esc_attr($value);

		return true;
	}

	/**
	 * Get HTML data attribute value
	 */
	function getHtmlData($name = ''){

		// assume we want everthing
		if(empty($name)) return $this->htmlData;

		if(!isset($this->htmlData[$name])) return '';
		
		return $this->htmlData[$name];
	}


	/**
	 * For use in html data
	 */
	public function htmlData(){
		$data = $this->getHtmlData();
		$out = '';

		if(empty($data)) return $out;

		foreach($data as $name => $value){
			$val = esc_attr($value);
			$out .= sprintf('data-%1$s="%2$s" ', $name, $val);
		}

		return $out;
	}


	public function getInlineStyle($name = ''){

		// assume we want everthing
		if(empty($name)) return $this->inlineStyles;

		if(!isset($this->inlineStyles[$name])) return '';
		
		return $this->inlineStyles[$name];
	}


	public function setInlineStyle($name, $value){
		if(empty($name)) return false;
		// lower case string
		$name = strtolower($name);

		// make alphanumeric
		$name = preg_replace("/[^a-z0-9\s-]/", "", $name);

		// convert white space to dash
		$name = preg_replace("/[\s]/", "-", $name);

		$this->inlineStyles[$name] = esc_attr($value);

		return true;
	}

	/**
	 * For adding style="xxx;" to .magic-action-box div
	 */
	public function inlineStyles(){
		$inline = $this->getInlineStyle();
		$out = '';
		$style = '';

		if(empty($inline)) return $out;

		foreach($inline as $name => $value){
			$style .= sprintf('%1$s: %2$s; ', $name, $value);
		}

		if(empty($style)) return $out;

		$out = sprintf('style="%1$s"', $style);
		return $out;
	}


	protected function initInlineStyles(){
		$actionBoxObj = $this->_actionbox_obj;

		$meta = $actionBoxObj->getMeta();

		$styles = array();

		if(!empty($meta['width'])){
			$styles['width'] = esc_attr($meta['width']);
		}

		$this->inlineStyles = $styles;
		return;
	}
	
	
	function getTemplateFile(){
		return $this->_template_file;
	}
	
	function getTemplateDir(){
		return $this->_template_dir;
	}
	
	function getTemplateUrl(){
		return $this->_template_url;
	}
	
	function getTemplateStyleDir(){
		return $this->_template_style_dir;
	}
	
	function getTemplateStyleUrl(){
		return $this->_template_style_url;
	}
	
	/**
	 * Get Default Action Box Template File
	 * @return string absolute path to template file
	 */
	function getDefaultTemplateFile( $type = '' ){
		$MabBase = MAB();

		$filename = '';
		$viewDir = $this->getDefaultTemplateDir( $type );
		$ext = '.php';
		$actionBoxObj = $this->_actionbox_obj;
		
		if( $MabBase->get_registered_action_box_type( $type ) ){
			$filename = $viewDir . 'actionbox-' . $type . $ext;
		}

		if( !file_exists( $filename ) ){
			$filename = MAB_VIEWS_DIR . 'action-box/actionbox-default.php';
		}
		
		return apply_filters('mab_get_default_template_file', $filename, $type );
	}

	function getPreDesignedTemplateDir( $type = '' ){
		return apply_filters( 'mab_get_pre_designed_template_dir', MAB_STYLES_DIR, $type );
	}
	
	function getPreDesignedTemplateUrl( $type = '' ){
		return apply_filters( 'mab_get_pre_designed_template_url', MAB_STYLES_URL, $type );
	}
	
	function getDefaultTemplateDir( $type = '' ){
		return apply_filters( 'mab_get_default_template_dir', MAB_VIEWS_DIR . 'action-box/', $type );
	}
	
	function getDefaultTemplateUrl( $type = '' ){
		return apply_filters( 'mab_get_default_template_url', MAB_VIEWS_URL . 'action-box/', $type );
	}
	
	/**
	 * Sets template paths for the object
	 */
	function setTemplatePaths(){
		$actionBoxObj = $this->_actionbox_obj;
		
		$styleKey = $actionBoxObj->getStyleKey();
		$type = $actionBoxObj->getActionBoxType();

		if( $styleKey == 'user' || $styleKey == 'none' ){
			//default template paths
			$this->_template_dir = $this->getDefaultTemplateDir( $type );
			$this->_template_url = $this->getDefaultTemplateUrl( $type );
			$this->_template_file = $this->getDefaultTemplateFile( $type );
		} else {
			//predesigned template paths
			
			$tempDir = $this->getPreDesignedTemplateDir() . "{$styleKey}/";
			$tempFile = $tempDir . "actionbox-{$type}.php";
			
			if( file_exists( $tempFile ) ){
				//template file exists within the predesigned template directory
				$this->_template_dir = $tempDir;
				$this->_template_url = $this->getPreDesignedTemplateUrl() . "{$styleKey}/";
				$this->_template_file = $tempFile;
				
				$this->_is_default = false;
			} else {
				//fallback to default templates
				$this->_template_dir = $this->getDefaultTemplateDir( $type );
				$this->_template_url = $this->getDefaultTemplateUrl( $type );
				$this->_template_file = $this->getDefaultTemplateFile( $type );
			}
			
			//path to styles and path to templates MAY be different
			$this->_template_style_dir = $tempDir;
			$this->_template_style_url = $this->getPreDesignedTemplateUrl() . "{$styleKey}/";
		}

		do_action('mab_set_template_paths', $type, $styleKey, $this );
	}
	
	static function setCurrentTemplateVars($actionBoxObj){
		$templateObj = $actionBoxObj->getTemplateObj();
		self::$_current_template_dir = $templateObj->getTemplateDir();
		self::$_current_template_url = $templateObj->getTemplateUrl();
		self::$_current_template_file = $templateObj->getTemplateFile();
		self::$_current_actionbox_obj = $actionBoxObj;
		self::$_current_template_style_dir = $templateObj->getTemplateStyleDir();
		self::$_current_template_style_url = $templateObj->getTemplateStyleUrl();
	}
	
	static function resetCurrentTemplateVars(){
		self::$_current_template_dir = '';
		self::$_current_template_url = '';
		self::$_current_template_file = '';
		self::$_current_actionbox_obj = null;
		self::$_current_template_style_dir = '';
		self::$_current_template_style_url = '';
	}
	
	static function getCurrentTemplateDir(){
		return self::$_current_template_dir;
	}
	
	static function getCurrentTemplateUrl(){
		return self::$_current_template_url;
	}
	
	static function getCurrentTemplateFile(){
		return self::$_current_template_file;
	}

	static function getCurrentTemplateStyleUrl(){
		return self::$_current_template_style_url;
	}
	
	static function getCurrentTemplateStyleDir(){
		return self::$_current_template_style_dir;
	}
	
	static function getCurrentActionBoxObj(){
		return self::$_current_actionbox_obj;
	}
	
	/**
	 * Use to check if we are using default template or not
	 * Non-default templates are templates found in predesigned style directory
	 */
	function isDefault(){
		if( !$this->_is_default )
			return false;
		else
			return true;
	}
	
	function init($actionBoxObj){
		$this->_actionbox_obj = $actionBoxObj;

		//set up hooks
		add_action( 'mab_enqueue_stylesheet', array( 'MAB_Template', 'loadStylesheets' ), 5, 2 );
		add_action( 'mab_enqueue_assets', array( 'MAB_Template', 'loadCustomCss' ), 20, 2 );

		//set up template paths
		$this->setTemplatePaths();

		// set up css classes
		$this->initCssClass();

		// set up inline style
		$this->initInlineStyles();

		return;
	}
	
	function __construct( $actionBoxObj = null ){
		$this->init( $actionBoxObj );
	}

	
	public static function getActionBoxDefaultCallback( $actionBoxObj ){
		$MabBase = MAB();
		$data = array();

		$meta = $actionBoxObj->getMeta();
		$meta['ID'] = $actionBoxObj->getId();

		$data['meta'] = $meta;
		$data['mab-html-id'] = $actionBoxObj->getHtmlId();
		$data['class'] = $actionBoxObj->getTemplateObj()->getClass();
		$data['html-data'] = $actionBoxObj->getTemplateObj()->htmlData();
		$data['inline-style'] = $actionBoxObj->getTemplateObj()->inlineStyles();
		$actionBoxType = $actionBoxObj->getActionBoxType();
		$data['action-box-type'] = $actionBoxType;
		$data['action-box-obj'] = $actionBoxObj;

		$data['the_content'] = apply_filters('mab_default_action_box_content', '', $actionBoxObj );

		$template = $actionBoxObj->getTemplateObj()->getTemplateFile();
		return MAB_Utils::getView( $template, $data, '' );
	}

	/**
	 * SHARE BOX
	 * @param object $actionBoxObj - MAB_ActionBox object
	 * @return string HTML
	 */
	public static function getActionBoxShareBox( $actionBoxObj ){
		$MabBase = MAB();
		$data = array();
		
		$meta = $actionBoxObj->getMeta();
		$meta['ID'] = $actionBoxObj->getId();
		
		//get Share Box
		$shareBox = self::getShareBox( $meta );

		//get Opt In Form
		$optInForm = self::getOptInForm( $actionBoxObj );
		
		$data['meta'] = $meta;
		$data['sharebox'] = $shareBox;
		$data['form'] = $optInForm;

		$data['action-box-type'] = $actionBoxObj->getActionBoxType();
		$data['mab-html-id'] = $actionBoxObj->getHtmlId();
		
		$data['class'] = $actionBoxObj->getTemplateObj()->getClass();
		$data['html-data'] = $actionBoxObj->getTemplateObj()->htmlData();
		$data['inline-style'] = $actionBoxObj->getTemplateObj()->inlineStyles();

		$mainTemplate = $actionBoxObj->getTemplateObj()->getTemplateFile();
		$actionBox = ProsulumMabCommon::getView( $mainTemplate, $data, '' );
		return $actionBox;
	}
	
	public static function getShareBox( $meta ){
		$viewDir = 'sharebox/';
		$ext = '.php';
		$shareBoxType = isset( $meta['sharebox']['type'] ) ? $meta['sharebox']['type'] : 'large';
		$shareBox = '';
		$data = array();
		
		$data['twitter']['share-text'] = isset( $meta['sharebox']['twitter']['share-text'] ) ? $meta['sharebox']['twitter']['share-text'] : 'Check out this post';
		$data['twitter']['via'] = isset( $meta['sharebox']['twitter']['via'] ) ? $meta['sharebox']['twitter']['via'] : '';
		
		$fileName = $viewDir . $shareBoxType . $ext;
		$shareBox = ProsulumMabCommon::getView( $fileName, $data );
		return $shareBox;
	}
	
	/**
	 * SALES BOX
	 * @param object $actionBoxObj - MAB_ActionBox object
	 * @return string HTML
	 */
	public static function getActionBoxSalesBox( $actionBoxObj ){
		$MabBase = MAB();
		
		$data = array();
		
		$meta = $actionBoxObj->getMeta();
		$meta['ID'] = $actionBoxObj->getId();
		
		$data['meta'] = $meta;
		$data['action-box-type'] = $actionBoxObj->getActionBoxType();
		$data['mab-html-id'] = $actionBoxObj->getHtmlId();
		$data['class'] = $actionBoxObj->getTemplateObj()->getClass();
		$data['html-data'] = $actionBoxObj->getTemplateObj()->htmlData();
		$data['inline-style'] = $actionBoxObj->getTemplateObj()->inlineStyles();

		$mainTemplate = $actionBoxObj->getTemplateObj()->getTemplateFile();
		$actionBox = ProsulumMabCommon::getView( $mainTemplate, $data, '' );

		return $actionBox;
	}

	/**
	 * OPTIN FORM
	 *
	 * @param object $actionBoxObj - MAB_ActionBox object
	 * @return string HTML
	 */
	public static function getActionBoxOptin( $actionBoxObj ){
		$MabBase = MAB();

		$meta = $actionBoxObj->getMeta();
		$meta['ID'] = $actionBoxObj->getId();
		
		//get unique action box id because some optin form providers need this i.e. wysija
		$data['mab-html-id'] = $actionBoxObj->getHtmlId();
		$meta['mab-html-id'] = $data['mab-html-id'];
		
		//get Opt In Form
		$optInForm = self::getOptInForm( $actionBoxObj );
		
		//if form is empty, then there should be no need to show the action box
		if( empty( $optInForm ) ){
			return '';
		}
		
		//$data['meta'] = $meta;
		//convert old optin settings keys to keys used by other action boxes
		$data['meta'] = self::convertOptinKeys( $meta );
		
		$data['form'] = $optInForm;
		
		$data['action-box-type'] = $actionBoxObj->getActionBoxType();
		
		$data['class'] = $actionBoxObj->getTemplateObj()->getClass();

		$data['html-data'] = $actionBoxObj->getTemplateObj()->htmlData();
		$data['inline-style'] = $actionBoxObj->getTemplateObj()->inlineStyles();

		$mainTemplate = $actionBoxObj->getTemplateObj()->getTemplateFile();
		
		$actionBox = ProsulumMabCommon::getView( $mainTemplate, $data, '' );
		return $actionBox;
	}

	
	/**
	 * @applies WP filter mab_optinform_output
	 * how to add your own filters example: add_filter( 'mab_optinform_output', 'public static function_name', 10, 3 );
	 *
	 * @param array $meta action box post type meta data
	 * @return html
	 */
	public static function getOptInForm( $actionBoxObj = null ){
		$MabBase = MAB();
		
		if( empty( $actionBoxObj ) || !$actionBoxObj->isConfigured() ) return '';
		
		$meta = $actionBoxObj->getMeta();
		
		$viewDir = 'optinforms/';
		$form = '';
		$provider = !empty($meta['optin-provider']) ? $meta['optin-provider'] : '';
		
		$form = apply_filters("mab_{$provider}_optin_form_output", $form, $actionBoxObj);
		return apply_filters('mab_optin_form_output', $form, $provider, $actionBoxObj );
	}
	
	/**
	 * to be deprecated @2.8.7
	 */
	public static function convertOptinKeys( $settings ){
		$MabBase = MAB();
		$settingsChanged = false;
		$new = array();
		$meta = $settings;

		if( !empty( $meta['optin-image-url'] ) && empty( $meta['aside-image-url'] ) ){
			$settingsChanged = true;
			$meta['aside-image-url'] = $meta['optin-image-url'];
		}
		if( !empty( $meta['optin-image-width'] ) && empty( $meta['aside-image-width'] ) ){
			$settingsChanged = true;
			$meta['aside-image-width'] = $meta['optin-image-width'];
		}
		if( !empty( $meta['optin-image-height'] ) && empty( $meta['aside-image-height'] ) ){
			$settingsChanged = true;
			$meta['aside-image-height'] = $meta['optin-image-height'];
		}
		if( !empty( $meta['optin-image-placement'] ) && empty( $meta['aside-image-placement'] ) ){
			$settingsChanged = true;
			$meta['aside-image-placement'] = $meta['optin-image-placement'];
		}
		if( !empty( $meta['optin-heading'] ) && empty( $meta['main-heading'] ) ){
			$settingsChanged = true;
			$meta['main-heading'] = $meta['optin-heading'];
		}
		if( !empty( $meta['optin-subheading'] ) && empty( $meta['subheading'] ) ){
			$settingsChanged = true;
			$meta['subheading'] = $meta['optin-subheading'];
		}
		if( !empty( $meta['optin-main-copy'] ) && empty( $meta['main-copy'] ) ){
			$settingsChanged = true;
			$meta['main-copy'] = $meta['optin-main-copy'];
		}
		
		if( $settingsChanged ){
			//save the new settings and return new settings
			$new = $meta;
			unset( $new['ID'] );
			$MabBase->update_mab_meta( $meta['ID'], $new );
			$new['ID'] = $meta['ID'];
			return $new;
		}
		
		return $meta;
	}
}
