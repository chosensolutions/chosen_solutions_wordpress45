<?php

/**
 * Handles ajax stuff
 */
class MAB_Ajax extends MAB_Base{

    protected static $messages = array();

    public function processOptin(){
        $resultArray = array();

        // TODO: only do this if debugging
        $this->log('AJAX request payload: ' . print_r($_POST,true), 'debug');

        /**
         * NOTES: 'api' is basically the object we want to use (like a controller)
         */
        if(!$_POST || !isset($_POST['optin-provider']) ){
            $resultArray = array('result'=>false);
        }else{
            $data = stripslashes_deep($_POST);
            $provider = sanitize_text_field($_POST['optin-provider']);
            $result = apply_filters("mab_process_{$provider}_optin_submit", false, $data);
            $resultArray['result'] = apply_filters('mab_process_optin_submit', $result, $provider, $data);
        }

        $resultArray['optin-provider'] = $provider;
        // TODO: Get Messages
        $resultArray['msgs'] = $this->getMessages();
        
        //this header will allow ajax request from the home domain, this can be a lifesaver when domain mapping is on
        if(function_exists('home_url')) header('Access-Control-Allow-Origin: '.home_url());

        header('Content-type: application/json');
        $jsonData = json_encode($resultArray);

        print $jsonData;
        
        die();
    }

	/**
	 * Main entry point for all ajax stuff
     * 
	 * @return  json
	 */
	public function process(){
		$resultArray = array();

		// TODO: only do this if debugging
		$this->log('AJAX request payload: ' . print_r($_POST,true), 'debug');

		/**
		 * NOTES: 'api' is basically the object we want to use (like a controller)
		 */
        if(!$_POST || !isset($_POST['task']) || !isset($_POST['api'])){
            $resultArray = array('result'=>false);
        }else{

            $api = $this->MAB($_POST['api']);

            if(is_object($api) && method_exists($api, $_POST['task'])){
            	$resultArray['result'] = $api->$_POST['task']();
            	$this->log("API {$_POST['api']} and Task {$_POST['task']} exists", 'debug');
            } else {
            	// TODO: Set error message
            	// //$this->error('Method "'.$_POST['task'].'" doesn\'t exist for controller : "'.$_POST['api']);
            	$this->log("Method '{$_POST['task']}' does not exist in API '{$_POST['api']}'", 'debug');
            }
        }

        // TODO: Get Messages
       	$resultArray['msgs'] = $this->getMessages();
       	
        //this header will allow ajax request from the home domain, this can be a lifesaver when domain mapping is on
        if(function_exists('home_url')) header('Access-Control-Allow-Origin: '.home_url());

        header('Content-type: application/json');
        $jsonData = json_encode($resultArray);

        print $jsonData;
        
        die();
	}

	/**
	 * Use to dynamically load action boxes via ajax
	 * @return array['result'] the action box HTML
	 *         array['msgs'] Any messages
	 *         array['css'] array of css objects
	 *         array['js'] array of js objects
	 */
	public function getActionBox(){
		$resultArray = array(
			'html' => '',
			'error' => false,
			'css' => array(),
			'js' => array()
		);

		$this->log('AJAX request payload: ' . print_r($_GET,true), 'debug');

		if( empty($_GET['id'])){

			self::addMessage(__('ID is invalid.', 'mab'));
			$resultArray['error'] = true;
			$resultArray['msgs'] = $this->getMessages();
			self::response($resultArray);

		}

		$result = array();
		$id = $_GET['id'];
		$actionBox = MAB_ActionBox::get($id);

		// action box does not exist
		if(is_null($actionBox)){
			$resultArray['error'] = true;
			self::addMessage('Action box does not exist with ID ' . $id);
			$resultArray['msgs'] = $this->getMessages();
			self::response($resultArray);
		}

		$html = $actionBox->getActionBox();

		// action box is empty? respond but do not set error
		if(empty($html)){
			self::response($resultArray);
		}

		$resultArray['html'] = $html;

		/**
		 * The following is possible because we are doing ajax.
		 * No other script/styles is enqueued
		 */
		global $wp_styles, $wp_scripts;

		$actionBox->loadAssets(); // this will fill $wp_styles and $wp_scripts

		$wp_styles->all_deps($wp_styles->queue);
		$wp_scripts->all_deps($wp_scripts->queue);

		$styles = array();
		$scripts = array();

		$jsToIgnore = array( 'jquery', 'jquery-migrate', 'jquery-core' );
		$cssToIgnore = array();

		$wp_styles->do_concat = true;
		foreach($wp_styles->to_do as $style){
			if(in_array($style, $cssToIgnore)) continue;

			$cssObj = $wp_styles->registered[$style];
			$wp_styles->print_html = '';
			$wp_styles->do_item($style);
			$cssObj->html = trim($wp_styles->print_html);

			$styles[] = $cssObj;
		}

		$wp_scripts->do_concat = true;
		foreach($wp_scripts->to_do as $script){
			if(in_array($script, $jsToIgnore)) continue;

			$jsObj = $wp_scripts->registered[$script];
			$wp_scripts->print_html = '';
			$wp_scripts->do_item($script);
			$jsObj->html = trim($wp_scripts->print_html);

			$scripts[] = $jsObj;
		}

		$resultArray['css'] = $styles;
		$resultArray['js'] = $scripts;

		self::response($resultArray);
	}

	/**
	 * Send json response and stop script if parameter $die is true
	 */
	public static function response($result, $die = true){
		//this header will allow ajax request from the home domain, this can be a lifesaver when domain mapping is on
		if(function_exists('home_url')) header('Access-Control-Allow-Origin: '.home_url());

		header('Content-type: application/json');
		$jsonData = json_encode($result);

		print $jsonData;

		if($die) die();
	}

    /**
     * For use with wp_localize_script()
     * @return array
     */
    public static function getAjaxData(){
        return array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'action' => 'mab-process-optin',
            'wpspinner' => admin_url('images/wpspin_light.gif'),
	        'wpspinner2x' => admin_url('images/wpspin_light-2x.gif'),
            'spinner' => admin_url('images/spinner.gif'),
            'spinner2x' => admin_url('images/spinner-2x.gif'),
	        'baseStylesUrl' => MAB_STYLES_URL
            );
    }


    /**
     * Setup ajax
     */
    public static function setup(){
        $ajax = MAB('ajax');
        // note: wp ajax is always run in admin context
        add_action( 'wp_ajax_nopriv_mab-process-optin', array($ajax, 'processOptin') );
        add_action( 'wp_ajax_mab-process-optin', array($ajax, 'processOptin'));
		add_action( 'wp_ajax_get-action-box', array($ajax, 'getActionBox'));
    }


	/**
	 * Return ajax messages
	 * @return array
	 */
	public static function getMessages(){
		return self::$messages;
	}


    /**
     * Add to ajax messages
     */
    public static function addMessage($msg){
        self::$messages[] = $msg;
    }
}