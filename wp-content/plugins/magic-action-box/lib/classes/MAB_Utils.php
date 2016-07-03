<?php

/**
 * TODO:
 *
 * - complete getMetaBoxViewTemplate() function
 */


/**
 * @since 2.8.6
 */
class MAB_Utils extends MAB_Base{
	private static $_action_box_types = array();
	
	/**
	 * @param string $filename reference a file relative to the MAB_VIEWS_DIR
	 * @param mixed $data data to pass on to the view file
	 * @return string contents of the file
	 */
	public static function getView( $filename, $data = null, $parent = MAB_VIEWS_DIR ){
		
		if( empty( $filename ) ) return '';
		
		//TODO: allow custom views to override standard views
		if( empty( $parent ) ){
			//we will assume that $filename is absolute path
			$file = $filename;
		} else {
			//$filename is relative to $parent
			$file = trailingslashit( $parent ) . $filename;
		}
		
		//$filename = trailingslashit( MAB_VIEWS_DIR ) . $filename;
		
		//check if file exists
		if( !file_exists( $file ) ) return '';
		
		ob_start();
		include( $file );
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
		
	}
	
	/**
	 * Get View Template for MetaBoxes
	 */
	public static function getMetaBoxViewTemplate( $template = '' ){
		
		$filenames = array(
			
		);
	}
	
	/**
	 * Get Settings
	 *
	 * Wrapper function for ProsulumMabBase->get_settings() function
	 *
	 * @return array Magic Action Box settings
	 */
	public static function getSettings(){
		$settings = MAB('settings');
		return $settings->getAll();
	}
	
	/**
	 * Get Action Box Types
	 * @param string $type - unique name/type of action box
	 * @return array|bool - return array of data for action box depending specified through $type or all action boxes if no parameter is passed. Will return FALSE if specified $type is not found
	 */
	public static function getActionBoxTypes( $type = null ){
		$MabBase = MAB();

		$boxTypes = $MabBase->get_registered_action_box_types();
		
		if( !is_null( $type ) ){
			if( isset( $boxTypes[$type] ) ){
				//return specified action box
				return $boxTypes[$type];
			} else {
				//specified action box type does not exist
				return false;
			}
		} else {
			//return all action boxes
			return $boxTypes;
		}
	}

	
	/**
	 * Get Action Box Styles
	 */
	public static function getStyles(){
		return ProsulumMabDesign::baseStyles();
	}
	
	/**
	 * Get a single action box style
	 */
	public static function getSingleStyle( $id ){
		$styles = self::getStyles();
		if( isset( $styles[$id] ) ){
			return $styles[$id];
		}
	}
	
	/**
	 * Get Single Action Box Style Resource
	 * @param string $id unique id for the action box style
	 * @param string $type thumb | css
	 * @return url - url to the resource
	 */
	public static function getStyleResource( $id, $type ){
		$style = self::getSingleStyle( $id );
		
		$styleUrl = trailingslashit( MAB_STYLES_URL . "{$id}/" );
		$styleDir = trailingslashit( MAB_STYLES_DIR . "{$id}/" );
		
		/* TODO: Allow to override location of resources */
		switch( $type ){
			case 'css':
			case 'stylesheet':
				if( file_exists( $styleDir . 'style.css' ) ){
					return $styleUrl . 'style.css';
				} else {
					return '';
				}
				break;
			case 'thumb':
			case 'image':
				if( file_exists( $styleDir . 'thumb.png' ) ){
					return $styleUrl . 'thumb.png';
				} else {
					return '';
				}
				break;
			default:
				return '';
				break;
		}
	}
	
	/**
	 * Deletes all the files in the temp directory under 
	 * wp-content/uploads/magic-action-box/
	 */
	public static function clearCacheDir( $ext = '*' ){
		mab_make_stylesheet_path_writable();
		$dir = mab_get_stylesheet_location('path');
		foreach( glob( $dir . "*.{$ext}" ) as $file ){
			unlink( $file );
		}
	}
	
	
	/**
	 * Strip Whitespace
	 *
	 * @source: http://stackoverflow.com/questions/6225351/how-to-minify-php-page-html-output
	 *
	 * Removes white spaces from string
	 * @param string $string
	 * @return string
	 */
	public static function minifyHtml( $string ){
		//remove comments
		//$string = preg_replace('`<\!\-\-.*\-\->`U', ' ', $string);
		
		//regext taken from http://www.sitepoint.com/forums/showthread.php?696559-Regex-pattern-to-strip-HTML-comments-but-leave-conditonals&s=73ae94661619bcd2a7d0928bbbead020&p=4678083&viewfull=1#post4678083
		$string = preg_replace('#<!--[^\[<>].*?(?<!!)-->#s', '', $string ); 
		
		//remove whitespace
		$search = array(
			'/\>[^\S ]+/s', //strip whitespaces after tags, except space
			'/[^\S ]+\</s', //strip whitespaces before tags, except space
			'/(\s)+/s'  // shorten multiple whitespace sequences
			);
		$replace = array(
			'>',
			'<',
			'\\1'
			);
		$string = preg_replace($search, $replace, $string);
		
		//replace > < with ><
		$string = str_replace('> <', '><', $string );
		
		return $string;
	}
}
