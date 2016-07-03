<?php

class ProsulumMabButton{

	var $_option_ButtonSettings = '_mab_button_settings';
	
	function __construct(){
	}

	function getDefaultSettings(){
		$defaults = array(
		
			'title' => 'My Button',
			
			## Background
			'background-color-start' => '#faa51a',
			'background-color-end' => '#f47a20',
			'background-color-hover-start' => '#f88e11',
			'background-color-hover-end' => '#f06015',
			
			## Borders and Padding
			'border-color' => '#da7c0c',
			'border-color-hover' => '',
			'border-width' => 0,
			'border-radius' => 10,
			'padding-tb' => 7,
			'padding-lr' => 18,
			
			## Drop Shadow
			'box-shadow-color' => '#000000',
			'box-shadow-opacity' => .3,
			'box-shadow-x' => 0,
			'box-shadow-y' => 1,
			'box-shadow-size' => 2,
			
			## Inner Shadow
			'inset-shadow-color' => '#333333',
			'inset-shadow-opacity' => .0,
			'inset-shadow-x' => 0,
			'inset-shadow-y' => 0,
			'inset-shadow-size' => 0,
			
			## Font
			'font-family' => '"Myriad Pro", Helvetica, Arial, Tahoma, sans-serif',
			'font-color' => '#fef4e9',
			'font-size' => '14',
			'font-weight' => 'normal',
			'font-transform' => 'none',
			
			## Text Shadow 1
			'text-shadow-1-color' => '#000000',
			'text-shadow-1-opacity' => 0.3,
			'text-shadow-1-x' => 0,
			'text-shadow-1-y' => 1,
			'text-shadow-1-size' => 1,
			
			## Text Shadow 2
			/*
			'text-shadow-2-color' => '#301200',
			'text-shadow-2-opacity' => 1,
			'text-shadow-2-x' => 1,
			'text-shadow-2-y' => 1,
			'text-shadow-2-size' => 1,
			*/
			
		);
		
		return apply_filters( 'mab_button_defaults', $defaults );

	}
	
	//button UI
	function buttonColorPicker( $id, $label_text, $current ){
		$esc_id = esc_attr( $id );
		echo '<label class="descriptor" for="button-editing-' . $esc_id . '">' . esc_html( $label_text ) . '</label>';
		echo '<input type="text" size="7" class="mab-color-picker mab-button-input" name="button-settings[' . $esc_id . ']" id="button-editing-' . $esc_id . '" value="' . esc_attr( $current ) . '" />';
		echo "\n";
	}
	
	function buttonSelect( $id, $label_text, $current, $range_start, $range_end, $unit, $step = 1 ){
		$esc_id = esc_attr( $id );
		if( !empty( $label_text ) )
			echo '<label class="descriptor" for="button-editing-' . $esc_id . '">' . esc_html( $label_text ) . '</label>';
			
		echo '<select name="button-settings[' . $esc_id . ']" id="button-editing-' . $esc_id . '" class="mab-button-input">';
		foreach( range( $range_start, $range_end, $step ) as $value )
			echo '<option ' . selected( $value, $current, false ) . ' value="' . esc_attr( $value ) . '">' . esc_html( $value . $unit ) . '</option>';

		echo "</select>\n";
	}
	
	function getButton( $key = null ){
	
		$settings = $this->getSettings();
		
		if( null === $key ){
		}
		
		if( isset( $settings[$key] ) )
			return $settings[$key];
		
		//returns the settings of the button in start of array
		return array_shift( $settings );
	}
	
	function updateSettings( $settings, $key = 'all' ){
		if( !is_array( $settings ) ){
			return $key;
		}
		
		if( $key == 'all' ){
			update_option( $this->_option_ButtonSettings, $settings );
			return '';
		}
		
		$existing = $this->getSettings();
		$settings['timesaved'] = current_time('timestamp');
		
		if( isset( $existing[$key] ) ){
			$existing[$key] = $settings;
		} elseif( isset( $settings['id'] ) ) {
			$key = $settings['id'];
			$existing[$key] = $settings;
		} else {
			$existing[] = $settings;
			//pop the key value of the last saved settings
			$key = array_pop( array_keys( $existing ) );
		}
		
		update_option( $this->_option_ButtonSettings, $existing );
		return $key;
	}
	
	function getSettings(){
	
		$settings = get_option( $this->_option_ButtonSettings );
		
		if( !is_array( $settings ) ){
			$settings = $this->getDefaultSettings();
		}
		
		//create default setting. the block below
		//only runs if the above IF statement runs.
		if( isset( $settings['background-color-start'] ) ){
			//explain: $settings['background-color-start'] is only set when running $this->getDefaultSettings()
			$settings['timesaved'] = current_time( 'timestamp' );
			$settings['title'] = __('Default', 'mab' );
			$settings = array( 0 => $settings );
			update_option( $this->_option_ButtonSettings, $settings );
		}
		
		return $settings;
	}
	
	/**
	 * Similar function to getSettings(). But, returns empty array() if
	 * there are no configured buttons
	 */
	function getConfiguredButtons(){
		
		$buttons = get_option( $this->_option_ButtonSettings );
		
		if( !is_array( $buttons ) ){
		 	return array();
		}
		
		return $buttons;
	}
	
	function duplicateButton( $key ){
		$buttons = $this->getConfiguredButtons();

		if( !isset( $buttons[$key] ) )
			return false;

		$original = $buttons[$key];

		//duplicate
		$duplicate = $original;

		$duplicate['title'] = $original['title'] . ' (copy)';
		$duplicate['timesaved'] = current_time( 'timestamp' );

		//add duplicate to $buttons
		$buttons[] = $duplicate;

		//pop the key value of the last saved button
		$duplicate_key = array_pop( array_keys( $buttons ) );

		//save
		update_option( $this->_option_ButtonSettings, $buttons );
		return $duplicate_key;
	}

	function deleteConfiguredButton( $key ){
		$buttons = $this->getConfiguredButtons();
		unset( $buttons[$key] );
		$this->updateSettings( $buttons );
		return $key;
	}
	
	function isValidButtonKey( $key ){
		$buttons = $this->getConfiguredButtons();
		return isset( $buttons[$key] );
	}
	
	function getButtonCode( $button, $key = '' ){
		$filelocation = 'misc/button-code.php';
		$data['button'] = $button;
		$data['key'] = $key;
		$button_code = ProsulumMabCommon::getView( $filelocation, $data );
		
		return $button_code;
	}
	
	/**
	 * Write Configured Buttons Stylesheet
	 * @param array $newvalue buttons settings
	 * @param any $oldvalue unused
	 */
	function writeConfiguredButtonsStylesheet( $newvalue, $oldvalue ) {
		$css = '';
		if( is_array( $newvalue ) ) {
			foreach( $newvalue as $key => $button )
				$css .= strip_tags( $this->getButtonCode( $button, $key ) );
		}
			
		$handle = @fopen( mab_get_custom_buttons_stylesheet_path(), 'w' );
		@fwrite( $handle, mab_minify_css( $css ) );
		@fclose( $handle );
		
		return $newvalue;
	}
	
	/**
	 * Adds Preconfigured Buttons into the Buttons Array
	 */
	function createPreconfiguredButtons(){
		$buttons = array();
		
		if( file_exists(  MAB_LIB_DIR . 'preconfigured-buttons.php' ) ){
			include_once( MAB_LIB_DIR . 'preconfigured-buttons.php' );
		}
		
		foreach( $buttons as $button ){
			$this->updateSettings( $button, '' );
		}
	}
	
}


