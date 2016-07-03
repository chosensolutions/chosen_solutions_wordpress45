<?php

class ProsulumMab extends MAB_Base{
	
	private $_defaultActionBoxId = '';
	private $_defaultActionBoxPlacement = 'bottom';
	private $_defaultActionBoxObj = null;
	private $_the_content_filter_priority = 10;
	
	function __construct(){
	//	$this->setUpDefaults();
		$this->add_actions();
		$this->add_filters();
	}
	
	function add_actions(){
		if( !is_admin() ){
			$hook = apply_filters('mab_setup_main_action_box_hook','wp');
			//load only on frontend
			add_action( $hook, array( &$this, 'setupContentTypeActionBox' ) );
			add_action( 'wp_enqueue_scripts', array( &$this, 'alwaysLoadAssets' ) );
		}
	}
	
	function add_filters(){
		//add_filter( 'mab_optinform_output', array( &$this, 'outputOptInFormHTML' ), 10, 3 );
		//add_filter('the_content', array( &$this, 'showActionBox' ) );
		
		$MabBase = MAB();
		$settings = MAB('settings')->getAll();
		
		add_filter( 'mab_get_template', array( 'ProsulumMab', 'defaultGetTemplateFilter' ), 10, 3 );
		
		if( !empty( $settings['others']['minify-output'] ) && (int)$settings['others']['minify-output'] === 1 ){
			add_filter( 'mab_template_output', array( 'MAB_Utils', 'minifyHtml' ) );
		}
	}
	
	function setUpDefaults(){
		global $wp_query;
		$MabBase = MAB();
		$post = $wp_query->get_queried_object();
		
		if( $MabBase->is_allowed_content_type( $post->post_type ) ){
			$context = $this->getContext();
			//$this->_defaultActionBoxId 
			$defaults = $this->getActionBoxDefaultsFromContext( $context );
			$this->_defaultActionBoxId = $defaults['id'];
			$this->_defaultActionBoxPlacement = $defaults['placement'];
			$actionBoxObj = new MAB_ActionBox( $defaults['id'] );
			$this->_defaultActionBoxObj = $actionBoxObj;
		}

	}
	
	function getQueriedActionBoxObj(){
		return $this->_defaultActionBoxObj;
	}
	
	function getDefaultActionBoxId(){
		return $this->_defaultActionBoxId;
	}
	
	function getDefaultActionBoxPlacement(){
		return $this->_defaultActionBoxPlacement;
	}
	
	function setupContentTypeActionBox(){
		global $wp_query;
		$MabBase = MAB();
		$is_paged = is_paged();

		if($is_paged){
			/** 
			 * Get query var "page" as some page templates may use this on custom queries and calling
			 * get_queried_object() method seems to override this i.e. optimize press on Blog Template
			 **/
			$paged = get_query_var('paged');

			/**
			 * If on static front page, need to check 'page'
			 * @source https://codex.wordpress.org/Pagination#static_front_page
			 */
			if( empty($paged) )
				$paged = get_query_var('page');

		}

		$post = $wp_query->get_queried_object();
		
		//stop if the content type is not supposed to show action box
		if( (!is_object( $post ) || !isset($post->post_type) || !$MabBase->is_allowed_content_type( $post->post_type ) ) && !( is_home() && $wp_query->post_count == 1) )
			return;
		
		//Show Action box only on singular pages or when it is on blog index but set only to show
		//one blog post.
		if( is_singular() && is_main_query() || ( is_home() && $wp_query->post_count == 1 ) ){
			
			$mab_priority = $this->_the_content_filter_priority; //default 10.
			
			//TODO: have option to disable removal of filter
			// Disable WordPress native formatters
			$settings = $this->MAB('settings')->getAll();
			
			if( !empty( $settings['others']['reorder-content-filters'] ) ){
				remove_filter( 'the_content', 'wpautop' );
				remove_filter( 'the_content', 'wptexturize' );
				add_filter('the_content', 'wpautop', 8 );
				add_filter('the_content', 'wptexturize', 8 );
				$mab_priority = 9;
			}
			
			$this->setUpDefaults();

			$queried_mab_obj = $this->getQueriedActionBoxObj();

			if( is_object($queried_mab_obj) && !empty($queried_mab_obj)){
				
				//TODO: check if page has action box
				//add_action( 'wp_print_styles', array( &$this, 'printStylesScripts' ) );
				add_action( 'wp_enqueue_scripts', array( &$this, 'printStylesScripts' ) );
				add_filter( "the_content", array( &$this, 'showActionBox'), $mab_priority);

			}
		}

		if($is_paged){
			/**
			 * Set the 'paged' parameter as it may have been overwritten by call to
			 * get_queried_object() above
			 */
			set_query_var('paged',$paged);
		}
	}
	
	function showActionBox( $content ){
		global $post;
		$MabBase = MAB();
		if( !$MabBase->is_allowed_content_type( $post->post_type ) ){
			return $content;
		}
		
		//if( !is_singular() )
		//	return $content;
		
		$defaultActionBoxId = $this->getDefaultActionBoxId();
		$placement = $this->getDefaultActionBoxPlacement();
		
		//get postmeta. NOTE: This is not postmeta from Action Box but
		//from a regular post/CPT where Action Box is to be shown
		$postmeta = $MabBase->get_mab_meta( $post->ID, 'post' );
		
		//return $content if action box is disabled or placement is set to 'manual'
		/*
		if( !isset( $postmeta['post-action-box'] ) || $postmeta['post-action-box'] === '' || $postmeta['post-action-box-placement'] == 'manual' ){
			return $content;
		}
		*/

		if( $defaultActionBoxId === '' || $placement == 'manual' ){
			return $content;
		}

		$actionBox = $this->getActionBox();
		//$actionBox = $this->getActionBox( $postmeta['post-action-box'] );
		
		//$content = wptexturize( wpautop( $content ) );
		
		//check placement of action box
		$placement = isset( $placement ) ? $placement : 'bottom';

		/**
		 * If defined, remove the filter after use
		 */
		if( defined('MAB_SINGLE_USE_FILTER') && MAB_SINGLE_USE_FILTER ){
			if( is_main_query() ){
				$mab_priority = $this->_the_content_filter_priority;
				remove_filter( "the_content", array( $this, 'showActionBox'), $mab_priority);
			}
		}
		

		if( $placement === 'top' ){
			return $actionBox . "\n" . $content;
		} elseif( $placement === 'bottom' ){
			return $content . "\n" . $actionBox;
		}
		
		//return $content;
	}
	
	/**
	 * Returns current context
	 * @return string 
	 */
	function getContext(){
		if( is_front_page() ){
		//FRONT PAGE
			$context = 'front_page';
		} elseif( is_home() ){
		//BLOG PAGE
			$context = 'blog';
		} elseif ( is_single() ){
		//SINGLE BLOG POST
			$context = 'single';
		} elseif ( is_page() ){
		//SINGLE PAGE
			$context = 'page';
		} elseif( is_category() ){
		//CATEGORY PAGE
			$context = 'category';
		} elseif ( is_tag() ){
		//TAG PAGE
			$context = 'tag';
		} elseif( is_archive() ){
		//ANY DATE-BASED PAGE i.e. category, tags, date
			$context = 'archive';
		} else {
		//DEFAULT
			$context = 'default';
		}
		
		return $context;
	}
	
	/**
	 * @param string $context - single | page | default
	 * @return int|bool Post ID of Action Box or FALSE if actionbox is not specified for a context
	 */
	function getActionBoxDefaultsFromContext( $context = 'default' ){
		$MabBase = MAB();
		
		$settings = $this->getSettings();
		$globalMab = isset($settings['global-mab']) ? $settings['global-mab'] : array();
		
		$actionBoxId = '';
		
		$default = ( isset( $globalMab['default']['actionbox'] ) && $globalMab['default']['actionbox'] != 'none' ) ? $globalMab['default']['actionbox'] : '';
		
		$defaultPlacement = $placement = isset( $globalMab['default']['placement'] ) ? $globalMab['default']['placement'] : 'bottom';

		switch( $context ){
			case 'single':
				global $post;
				if( !is_object( $post ) ){
					//something's wrong
					$actionBoxId = '';
					break;
				}
				
				/** Single Post Setting **/
				$postmeta = $MabBase->get_mab_meta( $post->ID, 'post' );
				$singleActionBoxId = isset($postmeta['post-action-box']) ? $postmeta['post-action-box'] : '';
				
				//if $pageActionBoxId is empty string, then action box is not yet set
				if( '' !== $singleActionBoxId && 'default' != $singleActionBoxId ){
					//specific action box set for Post
					$actionBoxId = $singleActionBoxId;
					$placement = isset( $postmeta['post-action-box-placement'] ) ? $postmeta['post-action-box-placement'] : $defaultPlacement;
					
				} else {
					//use global settings
					
					/** Global Single Post Setting **/
					$actionBoxId = isset( $globalMab['post']['actionbox'] ) ? $globalMab['post']['actionbox'] : 'default';
					$placement = isset( $globalMab['post']['placement'] ) ? $globalMab['post']['placement'] : $defaultPlacement;
					
					/** Global Category Setting - will override Global Single Post Setting **/
					$terms = get_the_terms( $post->ID, 'category' );
					if( $terms && !is_wp_error( $terms ) ){
						foreach( $terms as $term ){
							//catch the first category set
							if( isset( $globalMab['category'][$term->term_id]['actionbox'] ) AND $globalMab['category'][$term->term_id]['actionbox'] != 'default' ){
								$actionBoxId = $globalMab['category'][$term->term_id]['actionbox'];
								$placement = $globalMab['category'][$term->term_id]['placement'];
								break; //break out of foreach loop
							}//endif
						}//endforeach
					}//endif
					
				}//endif
				
				break;
			
			case 'page':
				global $post;
				if( !is_object( $post ) ){
					//something's wrong
					$actionBoxId = '';
				}
				
				$postmeta = $MabBase->get_mab_meta( $post->ID, 'post' );
				$pageActionBoxId = isset($postmeta['post-action-box']) ? $postmeta['post-action-box'] : '';
				
				//if $pageActionBoxId is empty string, then action box is not yet set
				if( '' !== $pageActionBoxId && 'default' != $pageActionBoxId ){
					//specific action box set for Page
					$actionBoxId = $pageActionBoxId;
					$placement = isset( $postmeta['post-action-box-placement'] ) ? $postmeta['post-action-box-placement'] : $defaultPlacement;
					
				} else {
					//use global setting
					$actionBoxId = isset( $globalMab['page']['actionbox'] ) ? $globalMab['page']['actionbox'] : 'default';
					$placement = isset( $globalMab['page']['placement'] ) ? $globalMab['page']['placement'] : $defaultPlacement;
					
				}
				
				break;
			case 'front_page':
				global $wp_query;
				
				//make sure that the front page is set to display a static page
				if( !is_page() ){
					break;
				}
				
				$post = $wp_query->get_queried_object();
				if( !is_object( $post ) ){
					//something's wrong
					$actionBoxId = '';
				}
				
				$postmeta = $MabBase->get_mab_meta( $post->ID, 'post' );
				$pageActionBoxId = isset($postmeta['post-action-box']) ? $postmeta['post-action-box'] : '';
				
				//if $pageActionBoxId is empty string, then action box is not yet set
				if( '' !== $pageActionBoxId && 'default' != $pageActionBoxId ){
					//specific action box set for Page
					$actionBoxId = $pageActionBoxId;
					$placement = isset( $postmeta['post-action-box-placement'] ) ? $postmeta['post-action-box-placement'] : $defaultPlacement;
					
				} else {
					//use global setting
					$actionBoxId = isset( $globalMab['page']['actionbox'] ) ? $globalMab['page']['actionbox'] : 'default';
					$placement = isset( $globalMab['page']['placement'] ) ? $globalMab['page']['placement'] : $defaultPlacement;
					
				}
				
				break;
			case 'tag':
			case 'archive':
			case 'blog':
			case 'category':
			default: 
				$actionBoxId = '';
				break;
		}//endswitch
		
		if( $actionBoxId == 'default' ){
			$actionBoxId = $default;
		} elseif( $actionBoxId == 'none' ){
			$actionBoxId = '';
		}
		
		return array( 'id' => $actionBoxId, 'placement' => $placement );
		//return $actionBoxId;
	}
	
	function getActionBoxStyle( $actionBoxId ){
		$MabBase = MAB();
		return $MabBase->get_selected_style( $actionBoxId );
	}
	
	/**
	 * @param int $postId ID of post where Action Box is enabled
	 * @return int|string ID of action box used OR "default" OR "none" OR empty string if not yet set
	 */
	function getIdOfActionBoxUsed( $postId = '' ){
		global $post;
		$MabBase = MAB();
		if( $postId == '' ){
			$postId = $post->ID;
		}
		$postmeta = $MabBase->get_mab_meta( $postId, 'post' );
		return isset($postmeta['post-action-box']) ? $postmeta['post-action-box'] : '';
	}
	
	/**
	 * @param $honey should be null. this is for other plugins that still call this function [which they should no longer be doing]
	 * @return string - Action Box HTML on success, Empty string otherwise.
	 */
	function getActionBox( $honey = null ){
		
		if( !is_null( $honey ) ){
			//just return empty string.
			return '';
		}
		
		$mabObj = $this->getQueriedActionBoxObj();
		
		return $mabObj->getActionBox( null, false); //don't load assets
	}
	
	/**
	 * ASSETS, CSS, JAVASCRIPT
	 * ============================= */
	
	/**
	 * styles and scripts that need to be loaded/enqueued always
	 */
	function alwaysLoadAssets(){
		/** Scripts **/
		/* Load wpautopfix.js to fix empty <p> tags generated by wordpress */
		//wp_enqueue_script( 'mab-wpautop-fix' );
		wp_enqueue_script('mab-actionbox-helper');
		wp_enqueue_script('mab-responsive-videos');
		//wp_enqueue_script('mab-placeholder'); // seems to have an issue with jquery validator in mailpoet. it shows the error boxes in the fields during page load
		/** Styles **/
	}

	/**
	 * load assets for main action box on page
	 */
	function printStylesScripts(){
		$mainActionBox = $this->getQueriedActionBoxObj();

		if( !is_object($mainActionBox) )
			return;
		
		$mainActionBox->loadAssets();
	}
	
	function getSettings(){
		return $this->MAB('settings')->getAll();
	}
	
	/**
	 * printActionBoxAssets
	 * @deprecated 2.9
	 */
	function printActionBoxAssets( $actionBoxId ){
		//nothing here. deprecated get it?
	}


	/**
	 * ACTION BOXES
	 * =======================* /

	/**
	 * @filters get_action_box
	 */
	static function defaultGetTemplateFilter( $actionBox, $type, $actionBoxObj){
		//error_log( print_r($type, true) );
		
		switch( $type ){
			case 'optin':
				$actionBox = MAB_Template::getActionBoxOptin( $actionBoxObj );
				break;
			default:
				break;
		}
		return $actionBox;
	}
}
