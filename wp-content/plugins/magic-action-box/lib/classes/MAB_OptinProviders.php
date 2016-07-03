<?php

class MAB_OptinProviders extends MAB_Base{
	protected static $providers = array();

	public static function init(){
		$_optin_Keys = self::getDefault();

		foreach($_optin_Keys as $k => $v){
			self::add($v['id'], $v['name'], $v['auto_allow']);
		}

		do_action( 'mab_init_optin_providers' );
	}


	/**
	 * Default opt-in providers
	 */
	public static function getDefault(){
		$_optin_Keys = array(
			'aweber' => array(
				'id' => 'aweber', 
				'name' => 'Aweber', 
				'auto_allow' => false
			),
			'mailchimp' => array(
				'id' => 'mailchimp', 
				'name' => 'MailChimp', 
				'auto_allow' => false
			),
			'constantcontact' => array(
				'id' => 'constantcontact',
				'name' => 'Constant Contact',
				'auto_allow' => false
			)
		);

		if(class_exists('WYSIJA_object')){
			$_optin_Keys['wysija'] = array( 
					'id' => 'wysija',
					'name' => 'MailPoet (Wysija)',
					'auto_allow' => true
				);
		}

		if(class_exists('Prompt_Core')){
			$_optin_Keys['postmatic'] = array(
				'id' => 'postmatic',
				'name' => 'Postmatic',
				'auto_allow' => true
				);
		}

		$_optin_Keys['sendreach'] = array(
					'id' => 'sendreach',
					'name' => 'SendReach',
					'auto_allow' => false
				);
		$_optin_Keys['manual'] = array(
					'id' => 'manual', 
					'name' => 'Other (Copy & Paste)',
					'auto_allow' => true
				);

		return $_optin_Keys;
	}

	/**
	 * Add an optin provider
	 * @param  string $id  unique name
	 * @param  string $name human friendly name
	 * @param  bool   $auto_allow if FALSE, this provider will only be
	 *                            shown if it is allowed in settings
	 * @return bool FALSE if $id exists or missing $id parameter, 
	 *              otherwise returns TRUE
	 */
	public static function add($id, $name ='', $auto_allow = false){
		if(empty($id)) return false;

		// check if $id already exists
		foreach(self::$providers as $k => $prov){
			if($prov['id'] == $id) return false;
		}

		if(empty($name))
			$name = $id;

		self::$providers[$id] = array(
			'id' => $id,
			'name' => $name,
			'auto_allow' => $auto_allow
			);

		return true;
	}

	/**
	 * Returns all optin providers. Some providers may not be set up yet 
	 * i.e. no mailchimp keys
	 * 
	 * @return array
	 */
	public static function getAll(){
		return self::$providers;
	}

	/**
	 * Returns list of allowed optin providers in an array
	 * @return array 
	 */
	public static function getAllAllowed(){
		/** TODO: add a registerOptinProviders() function **/
		
		$settings = MAB('settings')->getAll();
		$allowed = array();
		
		foreach( self::getAll() as $k => $provider ){
			if($provider['auto_allow']){

				$allowed[$k] = array('id' => $provider['id'], 'name' => $provider['name'] );

			} else {

				//add optin providers where value is not 0 or empty or null
				if( !empty( $settings['optin']['allowed'][$provider['id']] ) ){
					$allowed[$k] = array('id' => $provider['id'], 'name' => $provider['name'] );
				}

			}
		}

		return $allowed;
		
	}
}