<?php
/**
 * Copied from Premise Plugin design-settings-support.php file
 */
/**
 * This file deals with the importing of design settings.
 *
 * @package mab
 * @author StudioPress & Gary Jones
 * @since 0.9.7
 */

/**
 * This function pulls the design settings from the DB
 * for use/return. Does not cache, so always up to date.
 *
 * @author Gary Jones
 * @param string $opt array index name of option
 * @param string $key actually the postID since style settings are stored as postmeta
 * @return mixed
 * @since 0.9.5
 * @version 0.9.8
 */
function mab_get_fresh_design_option( $opt, $key = null ) {
	$MabDesign = MAB('design');
	$setting = $MabDesign->getConfiguredStyle( $key );
	if( isset( $setting[$opt] ) )
		return $setting[$opt];

	return false;
}

/**
 * This function pulls the design settings from the DB
 * for use/return. Uses cache to minimise repeat lookups.
 *
 * @author StudioPress
 * @return mixed
 */
function mab_get_design_option( $opt, $key = null ) {
	return mab_get_fresh_design_option($opt, $key);
}

/**
 * Pull the option from the database to know if we're wanting minified CSS.
 *
 * @author Gary Jones
 * @since 0.9.7
 * @version 0.9.8
 */
function mab_is_minified($key = null) {
	return mab_get_fresh_design_option('minify_css', $key);
}

/**
 * Adds a dropdown setting - label and select.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @param string $type One of the types allowed in {@link mab_create_options()}
 * @since 0.9.5
 * @return string HTML markup
 * @version 0.9.8
 */
function mab_add_select_setting($id, $label, $type) {
	return mab_add_label($id, $label) . '<select id="' . $id . '" name="' . 'mab-design' . '[' . $id . ']" class="' . $type . '-option-types">' . mab_create_options(mab_get_fresh_design_option($id), $type) . '</select>';
}

/**
 * Adds a color setting - label and input.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @since 0.9.5
 * @return string HTML markup
 */
function mab_add_color_setting($id, $label) {
	return mab_add_label($id, $label) . '<input type="text" id="' . $id . '" name="' . 'mab-design' . '[' . $id . ']" size="8" maxsize="7" value="' . esc_attr( mab_get_fresh_design_option($id) ) . '" class="mab-color-picker" />';
}

/**
 * Adds a background color setting - label, select and input.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @since 0.9.8
 * @return string HTML markup
 */
function mab_add_background_color_setting($id, $label) {
	return mab_add_select_setting($id.'_select', $label, 'background') . '<input type="text" id="' . $id . '_hex" name="' . 'mab-design' . '[' . $id . ']" size="8" maxsize="7" value="' . esc_attr( mab_get_fresh_design_option($id) ) . '" class="mab-color-picker" />';
}


/**
 * Adds a size setting - label and input.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @param int $size Value for the size attribute (default = 1)
 * @since 0.9.5
 * @return string HTML markup
 */
function mab_add_size_setting($id, $label, $size = 1) {
	return mab_add_label($id, $label, false) . '<input class="numeric" type="text" id="' . $id . '" name="' . 'mab-design' . '[' . $id . ']" size="' . $size . '" value="' . esc_attr( mab_get_fresh_design_option($id) ) . '" /><abbr title="pixels">px</abbr></label>';
}

/**
 * Adds a text setting - label and input.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @param int $size Value for the size attribute (default = 25)
 * @since 0.9.5
 * @return string HTML markup
 */
function mab_add_text_setting($id, $label, $size = 25) {
	return mab_add_label($id, $label) . '<input type="text" id="' . $id . '" name="' . 'mab-design' . '[' . $id . ']" size="' . $size . '" value="' . esc_attr( mab_get_fresh_design_option($id) ) . '" />';
}

/**
 * Adds a checkbox setting - input and label.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @since 0.9.6
 * @return string HTML markup
 */
function mab_add_checkbox_setting($id, $label) {
	return mab_add_label($id, $label, true, false) . '<input type="checkbox" id="' . $id . '" name="' . 'mab-design' . '[' . $id . ']" value="true" class="checkbox" ' . checked(mab_get_fresh_design_option($id), 'true', false) . '/>';
}

/**
 * Adds a textarea setting - label and textarea.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @param integer cols Value for the cols attribute (default = 25)
 * @param integer rows Value for the rows attribute (default = 10)
 * @since 0.9.5
 * @return string HTML markup
 */
function mab_add_textarea_setting($id, $label, $cols = 25, $rows = 10) {
	return mab_add_label($id, $label) . '<br /><textarea id="' . $id . '" name="' . 'mab-design' . '[' . $id . ']" cols="39" rows="10">' . mab_get_fresh_design_option($id) . '</textarea>';
}

/**
 * Adds border width, color and style settings on one line.
 *
 * @author Gary Jones
 * @param string $id ID of the element
 * @param string $label Displayed label
 * @return string HTML markup
 * @since 1.0
 */
function mab_add_border_setting($id, $label) {
	return array(mab_add_size_setting($id, $label), mab_add_color_setting($id .'_color', ''), mab_add_select_setting($id . '_style', '', 'border'));
}

/**
 * Adds a NOTE.
 *
 * @author Gary Jones
 * @param string $note Text to display as the note
 * @return string HTML markup
 * @since 0.9.5
 */
function mab_add_note( $note ) {
	return '<span class="description"><strong>' . __( 'Note', 'mab' ) . ':</strong> ' . $note . '</span>';
}


/**
 * Adds the paragraph tags around a setting line and echos the result.
 *
 * @author Gary Jones
 * @param array|string $args
 * @since 0.9.5
 */
function mab_setting_line($args) {
	if ( is_array($args) ) {
		$output = '';
		foreach ($args as $arg) {
			$output .= ' ' .$arg;
		}
		mab_setting_line($output);
	} else {?>
		<p><?php echo $args; ?></p>
	<?php
	}
}

/**
 * Adds the opening label tag, the for attribute, and the label text itself.
 *
 * If the label text is at least 1 character long, then it's wrapped as a label element.
 * @author Gary Jones
 * @param string $id
 * @param string $label
 * @param boolean $add_end_tag Optionaly add closing label tag (default = true)
 * @param boolean $add_colon Optionaly add colon after the label (default = true)
 * @return string HTML markup for a label
 * @since 1.0
 */
function mab_add_label( $id, $label, $add_end_tag = true, $add_colon = true ) {
	if ( strlen( $label ) <= 0 )
		return '';

	$return = sprintf('<label for="%s">%s', $id, __( $label, 'mab' ) );
	if ( $add_colon )
		$return .= ':';
	if ( $add_end_tag )
		$return .= '</label>';

	$return .= ' ';

	return $return;
}

/**
 * Adds a wrapping div around the input/select/textarea
 *
 * @author Ryann Micua
 * @param string $input
 * @param boolean $add_end_tag Optionally add closing div tag (default = true)
 * @return string HTML markup for the control
 */
function mab_add_control( $the_control, $add_end_tag = true ){
	if( strlen( $input ) <= 0 )
		return '';
		
	$return = '<div class="mab-control">' . $the_control;
	if( $add_end_tag )
		$return .= '</div>';
	
	return $return;
}

/**
 * Adds a <h4> header tag. Used for specifying sub sections
 *
 * @param string $heading
 * @param bool $echo
 */
function mab_add_heading( $heading, $echo = true ){
	if( $echo )
		echo '<h4>' . __( $heading, 'mab' ) . '</h4>';
	else
		return '<h4>' . __( $heading, 'mab' ) . '</h4>';
}

