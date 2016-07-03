<?php

class MAB_ActionBox extends MAB_Base{
	private $_is_configured = false;
	private $_id = null;
	private $_type = null;
	private $_meta = array();
	private $_html_UniqueId = '_mab_html_unique_id';

	protected $track = true; // enable or disable tracking
	protected $_template_obj = null;
	
	/**
	 * Get Action Box
	 *
	 * @filters get_action_box-$type
	 * @uses apply_filters( "get_action_box-$type" );
	 *
	 * @return HTML the actual action box in HTML code
	 */
	function getActionBox( $id = null, $loadAssets = true ){
	
		if( is_null( $id ) || '' === $id ){
			//expect $id to already have been passed when the object was instantiated
			if( !$this->isConfigured() ) return '';
		} else {
			if( !$this->init( $id ) ) return '';
		}
		
		$box = $this->getTemplate();
		
		if( $loadAssets ){ //TODO: load assets only if $box is not empty?
			$this->loadAssets();
		}
		
		return $box;
	}

	/**
	 * Returns an action box object
	 *
	 * @param $id ID of the action box to get
	 * @return MAB_ActionBox|null null if action box does not exist.
	 */
	public static function get($id){
		$mab = new MAB_ActionBox($id);

		if(!$mab->isConfigured())
			return null;
		else
			return $mab;
	}

	/**
	 * Get all action boxes
	 *
	 * @param array $options
	 * @return array of $post objects
	 */
	public static function getAll($options = array()){

		$defaults = array();

		$opt = wp_parse_args($options, $defaults);

		$actionBoxesList = array();

		$actionBoxesObj = get_posts( array( 'numberposts' => -1, 'orderby' => 'title date', 'order' => 'ASC', 'post_type' => MAB::POST_TYPE ) );

		foreach($actionBoxesObj as $ab){
			// do not include our actionbox type
			//$abType = $MabBase->get_action_box_type($ab->ID);
			//if( in_array($abType, $exclude)) continue;

			$actionBoxesList[$ab->ID] = $ab;
		}

		return $actionBoxesList;
	}
	
	function getTemplateObj(){
		return $this->_template_obj;
	}
	
	function getTemplate(){
		return $this->_template_obj->getTemplate();
	}
	
	function loadAssets(){
		if( !$this->isConfigured() ) return;
		return $this->_template_obj->loadAssets();
	}
	
	/**
	 * Get HTML Unique ID for each action box
	 */
	function getHtmlId(){
		//this to have unique ID attribute of the main containing div in case there is more 
		//than 1 of the same action box. Cache key is composed of $_htmlUniqueId prefix and 
		//ID of the action box.
		$actionBoxId = $this->getId();
		
		$htmlUniqueId = wp_cache_get( $this->_html_UniqueId . $actionBoxId );
		if( false === $htmlUniqueId ){
			//this is the first
			$htmlUniqueId = 1;
			wp_cache_set( $this->_html_UniqueId . $actionBoxId, $htmlUniqueId );
		} else {
			//another box is already displayed
			$htmlUniqueId++;
			wp_cache_replace( $this->_html_UniqueId . $actionBoxId, $htmlUniqueId );
		}
		
		return $actionBoxId.$htmlUniqueId;
	}
	
	/**
	 * @return TRUE if the action box was configured, FALSE otherwise
	 */
	function init( $id = null ){
		$MabBase = MAB();
		//stop early if $id is empty
		if( $id === '' || is_null( $id ) ) return false;
		
		//make sure action box exists
		$actionbox = get_post( $id );
		
		if( empty( $actionbox ) ){
			return false;
		}

		// make sure the $actionbox post object is not trashed
		if($actionbox->post_status == 'trash'){
			return false;
		}
		
		//make sure action box type is registered
		$type = $MabBase->get_mab_meta( $id, 'type' );
		if( !$MabBase->get_registered_action_box_type( $type ) ){
			//error_log($type . ' not registered');
			return false;
		}
		$this->_type = $type;
		
		$this->_id = $id;
		$this->_meta = $MabBase->get_mab_meta( $id );
		
		//set $_is_configured to TRUE indicating that this action box
		//is configured correctly
		$this->_is_configured = true;
		
		$this->_template_obj = new MAB_Template( $this );
		
		// set html data
		$this->setHtmlData('mabid', $id);
		$this->setHtmlData('trackid', $id);
		$this->setHtmlData('type', $this->getActionBoxType());

		// set tracking/analytics
		$this->track(true);

		return true;
	}
	
	function getStyleKey(){
		if( !$this->isConfigured() || empty( $this->_meta['style'] ) ) return '';
		
		return $this->_meta['style'];
	}
	
	function getActionBoxType(){
		return $this->_type;
	}
	
	function getId(){
		return $this->_id;
	}
	
	function getMeta(){
		return $this->_meta;
	}

	/**
	 * See MAB_Template::addClass() method for description
	 */
	function addClass($class){
		if(!$this->isConfigured()) return false;

		return $this->getTemplateObj()->addClass($class);
	}

	/**
	 * @see  MAB_Template::removeClass
	 */
	function removeClass($class){
		if(!$this->isConfigured()) return false;

		return $this->getTemplateObj()->removeClass($class);
	}

	/**
	 * See MAB_Template::setHtmlData() method for description
	 */
	function setHtmlData($name, $value){
		if(!$this->isConfigured()) return false;

		return $this->getTemplateObj()->setHtmlData($name, $value);		
	}

	/**
	 * See MAB_Template::getHtmlData() method for description
	 */
	function getHtmlData($name = ''){
		if(!$this->isConfigured()) return false;

		return $this->getTemplateObj()->getHtmlData($name);	
	}

	function htmlData(){
		if(!$this->isConfigured()) return false;
		return $this->getTemplateObj()->htmlData();
	}


	/**
	 * See MAB_Template::setInlineStyle() method for description
	 */
	function setInlineStyle($name, $value){
		if(!$this->isConfigured()) return false;

		return $this->getTemplateObj()->setInlineStyle($name, $value);		
	}

	/**
	 * See MAB_Template::getInlineStyle() method for description
	 */
	function getInlineStyle($name = ''){
		if(!$this->isConfigured()) return false;

		return $this->getTemplateObj()->getInlineStyle($name);	
	}

	function inlineStyles(){
		if(!$this->isConfigured()) return false;
		return $this->getTemplateObj()->inlineStyles();
	}


	function track($track = true){
		if($track){
			$this->track = true;
			$this->setHtmlData('track', true);
		}
		else{
			$this->track = false;
			$this->setHtmlData('track', false);
		}
	}

	function isTracked(){
		return $this->track;
	}
	
	/**
	 * @return bool
	 */
	function isConfigured(){
		if( !$this->_is_configured )
			return false;
		else
			return true;
	}
	
	function __construct( $id = null ){
		if( !is_null( $id ) ){
			$this->init( $id );
		}
	}
}