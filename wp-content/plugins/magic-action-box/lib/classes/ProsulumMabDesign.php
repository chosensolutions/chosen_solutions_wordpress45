<?php

class ProsulumMabDesign{
	
	var $_option_StyleSettings = '_mab_style_settings';
	
	function __construct(){
	}
	
	function getDefaultSettings(){
		$defaults = array(
		
		'title' => 'My Style',
		
		###### General Design
		'main_background_color' => '#F5F5F5',
		'main_background_color_select' => 'hex',
		'main_background_image' => '',
		'main_background_repeat' => 'no-repeat',
		'main_background_align' => 'center',
		'main_border' => '3',
		'main_border_color' => '#CCCCCC',
		'main_border_style' => 'solid',
		'main_margin_bottom' => '20',
		'main_margin_top' => '20',
		'main_padding' => '15',
		'main_corner_radius' => '0',
		'main_width' => '',
		'main_font_color' => '#282828',
		'main_font_family' => "Arial, Helvetica, sans-serif",
		'main_font_size' => '14',
		'main_line_height' => '18',
		## Links
		'main_link_background_select' => 'transparent',
		'main_link_background' => '#FFFFFF',
		'main_link_color' => '#92031a',
		'main_link_decoration' => 'underline',
		'main_link_hover_background_select' => 'transparent',
		'main_link_hover_background' => '#FFFFFF',
		'main_link_hover' => '#ce0021',
		'main_link_hover_decoration' => 'none',
		
		##### HEADING
		'heading_margin_top' => '0',
		'heading_margin_bottom' => '7',
		'heading_align' => 'left',
		'heading_font_color' => '#282828',
		'heading_font_family' => 'inherit',
		'heading_font_size' => '22',
		'heading_font_style' => 'normal',
		'heading_font_weight' => 'bold',
		'heading_text_transform' => 'none',
		
		### SUBHEADING
		'subheading_margin_top' => '0',
		'subheading_margin_bottom' => '10',
		'subheading_align' => 'left',
		'subheading_font_color' => '#555555',
		'subheading_font_family' => 'inherit',
		'subheading_font_size' => '17',
		'subheading_font_style' => 'normal',
		'subheading_font_weight' => 'bold',
		'subheading_text_transform' => 'none',
		
		### ASIDE
		'aside_background_color' => '#FFFFFF',
		'aside_background_color_select' => 'transparent',
		'aside_border' => '1',
		'aside_border_color' => '#CCCCCC',
		'aside_border_style' => 'none',
		'aside_background_shadow' => '',
		'aside_margin_top' => '',
		'aside_margin_bottom' => '',
		'aside_margin_right' => '',
		'aside_margin_left' => '',
		'aside_padding' => '',
		'aside_corner_radius' => '',
		
		### OPTIN FORM
		//general styles for fields
		'field_margin_right' => '10',
		
		//labels
		'input_label_font_color' => '#000000',
		'input_label_font_size' => '14',
		'input_label_font_family' => 'Arial, Helvetica, sans-serif',
		'input_label_font_style' => 'normal',
		'input_label_font_weight' => 'bold',
		'input_label_margin_bottom' => '',
		
		//Input
		'input_background_color' => '#FFFFFF',
		'input_background_color_select' => 'hex',
		'input_border' => '1',
		'input_border_color' => '#999999',
		'input_border_style' => 'solid',
		'input_font_color' => '#555555',
		'input_font_family' => 'Arial, Helvetica, sans-serif',
		'input_font_size' => '14',
		'input_font_style' => 'normal',
		'input_padding_top' => '3',
		'input_padding_bottom' => '3',
		'input_padding_right' => '6',
		'input_padding_left' => '6',
		'input_width' => '150',
		
		//submit button
		'button_background_color' => '#333333',
		'button_background_color_select' => 'hex',
		'button_background_hover_color' => '#555555',
		'button_background_hover_color_select' => 'hex',
		'button_border' => '1',
		'button_border_color' => '#222222',
		'button_border_style' => 'solid',
		'button_border_hover_color' => '#333333',
		'button_font_color' => '#FFFFFF',
		'button_font_hover_color' => '#FFFFFF',
		'button_text_shadow' => '', //-1px -1px 0 #111111
		'button_text_shadow_hover' => '', //-1px -1px 0 #272727
		'button_font_family' => 'Arial, Helvetica, sans-serif',
		'button_font_size' => '14',
		'button_margin_top' => '15',
		'button_margin_bottom' => '',
		'button_margin_left' => '',
		'button_margin_right' => '',
		'button_padding_top' => '3',
		'button_padding_bottom' => '3',
		'button_padding_right' => '3',
		'button_padding_left' => '3',
		'button_border_radius' => '3',
		'button_text_transform' => 'none',
		
		);
		
		return apply_filters( 'mab_style_defaults', $defaults );
	}
	
	/**
	 * Get style settings attached to action_box custom post type. 
	 * Data is from POSTMETA table.
	 * TODO: Convert this for use with Settings-type options?
	 */
	function getSettings( $postId = '' ){
		global $post;
		$MabBase = MAB();
		$is_settings_type = false;
		
		if( !is_object( $post ) ){
			$is_settings_type = true;
		}
		
		if( $is_settings_type ){
		//style settings is stored as option
			$settings = false; //TODO: set as false for now.
		} else {
		//style settings is stored as postmeta
		
			if( empty( $postId ) ){
				$postId = $post->ID;
			}
			//get style settings stored in post metadata
			$settings = $MabBase->get_mab_meta( $postId, 'design' );
		
		}

		if( !is_array( $settings ) ){
			$settings = $this->getDefaultSettings();
		}

		return $settings;
	}
	
	/**
	 * Saves design settings for action_box custom post type. This is saved in the POSTMETA table.
	 */
	function updateSettings( $postId, $meta, $metaKey = '' ){
		$MabBase = MAB();
		$MabBase->update_mab_meta( $postId, $meta, 'design' );
	}
	
	/**
	 * Gets style settings data from OPTIONS table
	 * @return array saved style settings or a default setting
	 */
	function getStyleSettings(){
		$MabBase = MAB();
		
		//TODO: get from cache?
		$settings = get_option( $this->_option_StyleSettings );
		
		if( !is_array( $settings ) ){
			//create default style settings array
			$settings = $this->getDefaultSettings();
			$settings['timesaved'] = current_time( 'timestamp' );
			$settings['title'] = __('Default','mab');
			$settings = array( 0 => $settings );
			update_option( $this->_option_StyleSettings, $settings );
		}

		return $settings;
	}
	
	/**
	 * Saves global design settings. This is saved in the OPTIONS table
	 */
	function updateStyleSettings($settings, $key = 'all' ){
		//TODO: save to cache too?
		
		if( !is_array( $settings ) ){
			return $key;
		}
		
		if( $key == 'all' ){
			update_option( $this->_option_StyleSettings, $settings );
			return '';
		}
		
		$existing = $this->getStyleSettings();
		$settings['timesaved'] = current_time( 'timestamp' );
		
		//make sure we have a title
		if( !empty( $settings['title'] ) ){
			$settings['title'] = strip_tags( $settings['title'] );
		} else {
			$settings['title'] = 'My Style';
		}
		
		if( isset( $existing[$key] ) ){
			$existing[$key] = $settings;
		} elseif ( isset( $settings['id'] ) ){
			//key is saved along in the $settings array
			$key = $settings['id'];
			$existing[$key] = $settings;
		} else {
			$existing[] = $settings;
			//pop the key value of the last saved settings
			$key = array_pop( array_keys( $existing ) );
		}
		
		update_option( $this->_option_StyleSettings, $existing );
		return $key;
	}
	
	/**
	 * Returns a configured style
	 * @param int $key array index of the style
	 * @param bool $defaultIfMissing returns default style setting if TRUE and key is not found.
	 * @return array | bool if $key is not found and $defaultIfMissing is true then return
	 *		default settings. Otherwise, return FALSE.
	 */
	function getConfiguredStyle( $key = null, $defaultIfMissing = true ){
		global $mabStyleKey;
		
		$settings = $this->getStyleSettings();
		
		//TODO: need to get $key across to mab_fresh_design_option() @ design-utilities.php
		
		if( null === $key ){
			$key = $mabStyleKey;
		}
		
		if( !$defaultIfMissing ){
			if( $key === null || !isset( $settings[$key] ) ){
				return false;
			} else {
				return $settings[$key];
			}
		} else {
			if( $key === null || !isset( $settings[$key] ) ){
				return $this->getDefaultSettings();
			} else {
				return $settings[$key];
			}
		}
		
		return $this->getDefaultSettings();
	}
	
	function deleteConfiguredStyle( $key = '' ){
		$style = $this->getStyleSettings();
		if( empty( $style ) || !isset( $style[$key] ) ){
			return false;
		} else {
			unset( $style[$key] );
			$this->updateStyleSettings( $style );
		}
		return $key;
	}

	public static function baseStyles(){
		$styles = array(
			'default' => array( 'id' => 'default', 'name' => 'Default', 'description' => 'Starter style for your action box.' ),
			'dark' => array( 'id' => 'dark', 'name' => 'Dark', 'description' => '' ),
			'pink' => array( 'id' => 'pink', 'name' => 'Pink', 'description' => ''),
			'royalty' => array( 'id' => 'royalty', 'name' => 'Royalty', 'description' => '')
		);

		return $styles;
	}
	
}
