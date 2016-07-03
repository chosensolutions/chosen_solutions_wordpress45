<?php

/**
 * This adds an api endpoint at /mabapi/$id
 * @ref http://coderrr.com/create-an-api-endpoint-in-wordpress/
 */
class MAB_API extends MAB_Base{
	public function __construct(){
		add_filter('query_vars', array($this, 'addQueryVars'), 0);
		add_action('parse_request', array($this, 'sniffRequests'), 0);
		add_action('init', array($this, 'addEndpoint'), 0);
	}

	/**
	 * Add public query vars so that WP will recognize it
	 * @param array $vars List of current public query vars
	 * @return  array $vars
	 */
	public function addQueryVars($vars){
		$vars[] = '__mabapi';
		$vars[] = 'mabid';
		$vars[] = 'mabaction';
		$vars[] = 'maboutputtype';

		return $vars;
	}

	/** 
	 * Add API Endpoint
	 * This is where the magic happens
	 * @return void
	 */
	public function addEndpoint(){
		add_rewrite_rule('^mabapi/get/([0-9]+)/?(html|json|iframe)?','index.php?__mabapi=1&mabaction=get&mabid=$matches[1]&maboutputtype=$matches[2]','top');
	}

	/**	
	 * Sniff Requests
	 *	This is where we hijack all API requests
	 * 	If $_GET['__mabapi'] is set, we kill WP and handle it ourselves
	 *	@return die if API request
	 */
	public function sniffRequests(){
		global $wp;
		if(isset($wp->query_vars['__mabapi'])){
			$action = $wp->query_vars['mabaction'];
			if(method_exists($this,$action)){
				$this->{$action}();
			}
			exit;
		}
	}

	/** Response Handler
	 *	This sends a JSON response to the browser
	 */
	protected function sendResponse($result = null, $msg = ''){
		$response['message'] = $msg;
		if($result)
			$response['result'] = $result;
		header('content-type: application/json; charset=utf-8');
	    echo json_encode($response);
	    exit;
	}

	/**
	 * Available methods
	 * *************************/

	/**
	 * Get
	 * @return [type] [description]
	 */
	public function get(){
		global $wp, $wp_scripts;

		$mabid = $wp->query_vars['mabid'];
		$type = !empty($wp->query_vars['maboutputtype']) ? $wp->query_vars['maboutputtype'] : 'html';

		if(empty($mabid)){
			die('Invalid MAB ID.');
		}

		$actionBox = mab_get_actionbox($mabid);

		switch($type){
			case 'json':
				$this->sendResponse($actionBox);
			break;

			case 'html':
			case 'iframe':
			default:
				echo $actionBox;
			break;
		}

		exit;
	}
}