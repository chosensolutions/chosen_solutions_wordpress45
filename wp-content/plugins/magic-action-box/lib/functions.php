<?php

/**
 * Return a MAB API variable, or NULL if it doesn't exist
 *
 * Like the fuel() function, except that ommitting $name returns the current MabStats instance rather than the fuel.
 * The distinction may not matter in most cases.
 *
 * @param string $name If ommitted, returns a MabStats_Fuel object with references to all the fuel.
 * @return mixed MAB_Fuel value if available, NULL if not. 
 *
 */
function MAB($name = 'MAB') {
	return MAB_Base::getFuel($name); 
}

/**
 * Get an action box
 * @param int $actionBoxId - Post ID of action box
 * @param bool $loadAssets - whether to load action box assets or not
 * @param bool $forceShow - default FALSE. USed only if $actionBoxId is not set. 
                            If TRUE will show the action box even if the post
 * it is being shown in has not set the action box to be shown "Manually"
 * @param bool $fallbackToDefaults set to TRUE to let action box show default action box if any
 * @return string - HTML of action box. Or empty string
 */
function mab_get_actionbox( $actionBoxId = null, $loadAssets = true, $forceShow = false, $fallbackToDefaults = false ){
	global $post, $Mab;
	$MabBase = MAB();
	$actionBox = '';
	
	if( is_null( $actionBoxId ) || $actionBoxId === '' ){
		/** Get action box used for a post - if it is specified **/
		
		//get postmeta. NOTE: This is not postmeta from Action Box but
		//from a regular post/CPT where Action Box is to be shown
		$postmeta = $MabBase->get_mab_meta( $post->ID, 'post' );

		$post_action_box = isset($postmeta['post-action-box']) ? $postmeta['post-action-box'] : '';
		$post_action_box_placement = isset($postmeta['post-action-box-placement']) ? $postmeta['post-action-box-placement'] : '';
		
		//return nothing if action box is disabled or if placement is not set to 'manual'
		if( 'none' == $post_action_box ){
			/** Action box is "Disabled" **/
			return '';

		//if action box is not set or is set to "default"
		} elseif( !isset( $post_action_box ) || $post_action_box === '' || $post_action_box == 'default' ){
			if( $fallbackToDefaults && ($forceShow || $post_action_box_placement == 'manual' ) ){
				//get post type
				$post_type = get_post_type( $post );
				$post_type = ( $post_type == 'page' ) ? 'page' : 'single';
				$post_action_box = mab_get_action_box_id_from_context($post_type);
			} else {
				return '';
			}
		} elseif( !$forceShow && $post_action_box_placement != 'manual' ){
			/** Action box must be set to show "manually" **/
			return '';
		}
		
		$actionBoxId = $post_action_box;
	}
	
	$actionBoxObj = new MAB_ActionBox( $actionBoxId );
	
	$actionBox = $actionBoxObj->getActionBox(null, $loadAssets); //also loads assets
	
	return $actionBox;
}

/**
 * Loads an action box css and js assets. Uses wp_enqueue_* api
 * @param  int $mabid ID of the action box
 * @return void
 */
function mab_load_actionbox_assets($mabid){
	if(empty($mabid)) return;

	$actionBox = new MAB_ActionBox($mabid);
	$actionBox->loadAssets();
}


/**
 * Register action box
 * 
 * Form the array $box like this:
 * $box = array(
 *    'type'        => 'action-box-type', //use letters, numbers, underscore, dash only
 *    'name'        => 'Human readable name',
 *    'description' => 'Short description about the action box type'
 * );
 * 
 * @param  array  $box required
 * @return none
 */
function mab_register_action_box( $box ){
	$MabBase = MAB();
	$MabBase->register_action_box_type( $box );
}

/**
 * @param string $context - single | page | default
 * @return int|bool Post ID of Action Box or FALSE if actionbox is not specified for a context
 */
function mab_get_action_box_id_from_context( $context = 'default' ){
	$MabBase = MAB();
	
	$settings = MAB_Utils::getSettings();
	$globalMab = $settings['global-mab'];
	
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
	
	//return array( 'id' => $actionBoxId, 'placement' => $placement );
	return $actionBoxId;
}


/**
 * Returns the value of an array index from a key-value array. Will check if an array index is set. 
 * By default, will return an empty string if not set.
 *
 * @param array $array array to get value from
 * @param string $index key index
 * @param string $empty_value value to return if array key is not set
 * @return mixed value of array index
 */
function mab_array_index_value($array, $index, $empty_value = ''){
	return isset($array[$index]) ? $array[$index] : $empty_value;
}



/**
 * Return a button
 */
function mab_button($args){
	$defaults = array(
		'id' => '',
		'text' => 'Button Text',
		'url' => '',
		'class' => '',
		'target' => '',
		'title' => '',
		'name' => '',
		'new_window' => false
		);

	$args = wp_parse_args($args, $defaults);

	//stop if we have no id
	if( $args['id'] === '' || is_null($args['id']) )
		return '';

	//add our button key to class
	$args['class'] .= ' mab-button-' . intval($args['id']);

	if(empty($args['target']) && $args['new_window']){
		$args['target'] = '_blank';
	}

	if(empty($args['url'])){
		//we will output a submit button
		$template = '<input type="submit" value="%s" name="%s" class="%s" />';
		$button = sprintf($template, $args['text'], $args['name'], $args['class']);
	} else {
		//we will output an <a> button
		$template = '<a href="%s" class="%s" title="%s" target="%s">%s</a>';
		$button = sprintf($template, $args['url'], $args['class'], $args['title'], $args['target'], $args['text']);
	}

	return $button;
}

/**
 * Wrapper for MAB_MetaBoxes::optionBox()
 */
function mab_option_box($name = '', $data = array()){
	return MAB_MetaBoxes::optionBox($name, $data);
}