<?php
/**
 * Copied from Premise design-settings.php file
 */



/**
 * This file is a fork of the Prose design settings code.  It is customized for the Premise landing page plugin to ensure that
 * it only applies settings which make sense for landing page.
 */

function mab_get_mapping(){
	// Format:
	// '#selector' => array(
	//      'property1' => 'value1',
	//      'property2' => 'value2',
	//      'property-with-multiple-values-or-units' => array(
	//		  array('value', 'unit'),
	//		  array('value', 'string'),
	//		  array('value', 'unit')
	//      ),
	//      'property4' => 'value4'
	// ),
	$mapping = array(
		'.magic-action-box' => array( ## MAIN
			'box-shadow' => 'main_background_shadow',
			'margin' => array(

				array('main_margin_top', 'px'),

				array('auto', 'fixed_string'),

				array('main_margin_bottom', 'px')

			),
		),
		'.magic-action-box a' => array( ## LINKS
			'background' => 'main_link_background',

			'background-color_select' => 'main_link_background_select',

			'color' => array( 
				array( 'main_link_color', 'string' ),
				array( '!important', 'fixed_string')
			),

			'text-decoration' => array( 
				array( 'main_link_decoration', 'string'),
				array( '!important', 'fixed_string'),
			)
		),
		'.magic-action-box a:hover' => array(
			'background' => 'main_link_hover_background',

			'background-color_select' => 'main_link_hover_background_select',

			'color' => array( 
				array( 'main_link_hover', 'string' ),
				array( '!important', 'fixed_string')
			),

			'text-decoration' => array(
				array('main_link_hover_decoration', 'string'),
				array('!important', 'fixed_string' ),
			)
		),
		'.magic-action-box .mab-wrap' => array( ## WRAP
			'background-color' => 'main_background_color',
			'background-color_select' => 'main_background_color_select',
			'background-position' => array(
				array('top','fixed_string'),

				array('main_background_align','string'),

			),
			'background-image' => array(

				array("url(",'fixed_string'),

				array('main_background_image','string'),

				array(")", 'fixed_string'),

			),
			'background-repeat' => 'main_background_repeat',
			'border' => array(

				array('main_border','px'),

				array('main_border_style', 'string'),

				array('main_border_color', 'string')

			),
			'padding' => array( array( 'main_padding', 'px' ) ),
			'-moz-border-radius' => array( array('main_corner_radius','px') ),

			'-khtml-border-radius' => array( array('main_corner_radius','px') ),

			'-webkit-border-radius' => array( array('main_corner_radius','px') ),

			'border-radius' => array( array('main_corner_radius','px') ),
			'width' => array( array('main_width','px') ),
		),
		'.magic-action-box .mab-content' => array( ## CONTENT
			'color' => array( 
				array( 'main_font_color', 'string' ),
				array( '!important', 'fixed_string')
			),
			'font-family' => 'main_font_family',

			'font-size' => array( 
				array('main_font_size', 'px'),
				array( '!important', 'fixed_string')
			),

			'line-height' => array( 
				array('main_line_height', 'px'),
				array( '!important', 'fixed_string') 
			),
		),
		'.magic-action-box .mab-content *' => array(
			'color' => array( 
				array( 'main_font_color', 'string' ),
				array( '!important', 'fixed_string')
			),
			'font-family' => 'main_font_family',

			'font-size' => array(
				array('main_font_size', 'px'),
				array( '!important', 'fixed_string')
			),

			'line-height' => array( 
				array('main_line_height', 'px'),
				array( '!important', 'fixed_string')),
		),
		'.magic-action-box .mab-wrap .mab-heading' => array( ## MAIN HEADING <h3 class="mab-heading">
			'margin-top' => array( 
				array( 'heading_margin_top', 'px' ),
				array( '!important', 'fixed_string')
			),
			'margin-bottom' => array( 
				array( 'heading_margin_bottom', 'px' ),
				array( '!important', 'fixed_string')
			),
			'text-align' => 'heading_align',
			'color' => array( 
				array('heading_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array( 'heading_font_family', 'string' ),
				array( '!important', 'fixed_string')
			),
			'font-size' => array( 
				array('heading_font_size','px'),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array( 'heading_font_style', 'string'),
				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array( 'heading_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'line-height' => array( 
				array( 'heading_line_height', 'px' ),
				array( '!important', 'fixed_string')
			),
			'text-transform' => array(
				array('heading_text_transform','string'),
				array( '!important', 'fixed_string')
			),
		),
		'.magic-action-box .mab-wrap .mab-subheading' => array( ## SUBHEADING <h4 class="mab-subheading">
			'margin-top' => array( 
				array( 'subheading_margin_top', 'px' ),
				array( '!important', 'fixed_string')
			),
			'margin-bottom' => array( 
				array( 'subheading_margin_bottom', 'px' ),
				array( '!important', 'fixed_string')
			),
			'text-align' => 'subheading_align',
			'color' => array(
				array('subheading_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('subheading_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('subheading_font_size','px'),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array( 'subheading_font_style','string'),
				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array( 'subheading_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'line-height' => array( 
				array( 'subheading_line_height', 'px' ),
				array( '!important', 'fixed_string')
			),
			'text-transform' => array(
				array( 'subheading_text_transform','string'),
				array( '!important', 'fixed_string')
			),
		),
		'.magic-action-box .mab-main-copy' => array( ## MAIN COPY
		),
		'.magic-action-box .mab-secondary-copy' => array( ## SECONDARY COPY
		),
		'.magic-action-box .mab-main-action-wrap' => array( ## MAIN ACTION WRAP
		),
		'.magic-action-box .mab-main-action-wrap form' => array( ## OPTIN FORMS?
		),
		'.magic-action-box .mab-main-action-wrap .mab-field' => array( ## FIELD WRAPS
			'margin-right' => array( 
				array( 'field_margin_right', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap .mab-field label' => array( ## LABEL
			'color' => array(
				array('input_label_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('input_label_font_size','px'),
				array( '!important', 'fixed_string')
			),
			'font-family' => 'input_label_font_family',
			'font-style' => 'input_label_font_style',
			'font-weight' => 'input_label_font_weight',
			'margin-bottom' => array( 
				array( 'input_label_margin_bottom', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap .mab-field input' => array( ## INPUT
			'background' => array(
				array('input_background_color','string'),
				array( '!important', 'fixed_string')
			),
			'background-color_select' => 'input_background_color_select',
			'border' => array(
				array('input_border','px'),

				array('input_border_style', 'string'),

				array('input_border_color', 'string'),
				array( '!important', 'fixed_string')

			),
			'-moz-border-radius' => array( array('input_border_radius','px') ),

			'-khtml-border-radius' => array( array('input_border_radius','px') ),

			'-webkit-border-radius' => array( array('input_border_radius','px') ),

			'border-radius' => array( 
				array('input_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('input_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('input_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('input_font_size', 'px' ),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array('input_font_style','string'),


				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array('input_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'padding-top' => array( array( 'input_padding_top','px' ), array( '!important', 'fixed_string') ),
			'padding-bottom' => array( array( 'input_padding_bottom','px' ), array( '!important', 'fixed_string') ),
			'padding-right' => array( array( 'input_padding_right','px' ), array( '!important', 'fixed_string') ),
			'padding-left' => array( array( 'input_padding_left','px' ), array( '!important', 'fixed_string') ),
			'width' => array( 
				array( 'input_width', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap input' => array( ## INPUT
			'background' => array(
				array('input_background_color','string'),
				array( '!important', 'fixed_string')
			),
			'background-color_select' => 'input_background_color_select',
			'border' => array(
				array('input_border','px'),

				array('input_border_style', 'string'),

				array('input_border_color', 'string'),
				array( '!important', 'fixed_string')

			),
			'-moz-border-radius' => array( array('input_border_radius','px') ),

			'-khtml-border-radius' => array( array('input_border_radius','px') ),

			'-webkit-border-radius' => array( array('input_border_radius','px') ),

			'border-radius' => array( 
				array('input_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('input_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('input_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('input_font_size', 'px' ),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array('input_font_style','string'),


				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array('input_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'padding-top' => array( array( 'input_padding_top','px' ), array( '!important', 'fixed_string') ),
			'padding-bottom' => array( array( 'input_padding_bottom','px' ), array( '!important', 'fixed_string') ),
			'padding-right' => array( array( 'input_padding_right','px' ), array( '!important', 'fixed_string') ),
			'padding-left' => array( array( 'input_padding_left','px' ), array( '!important', 'fixed_string') ),
			'width' => array( 
				array( 'input_width', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap .mab-field textarea' => array( ##TEXTAREA
			'background' => array(
				array('input_background_color','string'),
				array( '!important', 'fixed_string')
			),
			'background-color_select' => 'input_background_color_select',
			'border' => array(
				array('input_border','px'),

				array('input_border_style', 'string'),

				array('input_border_color', 'string'),
				array( '!important', 'fixed_string')

			),
			'-moz-border-radius' => array( array('input_border_radius','px') ),

			'-khtml-border-radius' => array( array('input_border_radius','px') ),

			'-webkit-border-radius' => array( array('input_border_radius','px') ),

			'border-radius' => array( 
				array('input_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('input_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('input_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('input_font_size', 'px' ),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array('input_font_style','string'),
				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array('input_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'width' => array( 
				array( 'input_width', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap textarea' => array( ##TEXTAREA
			'background' => array(
				array('input_background_color','string'),
				array( '!important', 'fixed_string')
			),
			'background-color_select' => 'input_background_color_select',
			'border' => array(
				array('input_border','px'),

				array('input_border_style', 'string'),

				array('input_border_color', 'string'),
				array( '!important', 'fixed_string')

			),
			'-moz-border-radius' => array( array('input_border_radius','px') ),

			'-khtml-border-radius' => array( array('input_border_radius','px') ),

			'-webkit-border-radius' => array( array('input_border_radius','px') ),

			'border-radius' => array( 
				array('input_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('input_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('input_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('input_font_size', 'px' ),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array('input_font_style','string'),
				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array('input_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'width' => array( 
				array( 'input_width', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box ::-webkit-input-placeholder' => array(
			'color' => array(array('inherit', 'fixed_string'))
		),
		'.magic-action-box :-moz-placeholder' => array(
			'color' => array(array('inherit', 'fixed_string'))
		),
		'.magic-action-box ::-moz-placeholder' => array(
			'color' => array(array('inherit', 'fixed_string'))
		),
		'.magic-action-box :-ms-input-placeholder' => array(
			'color' => array(array('inherit', 'fixed_string'))
		),
		'.magic-action-box ::input-placeholder' => array(
			'color' => array(array('inherit', 'fixed_string'))
		),
		'.magic-action-box .mab-main-action-wrap select' => array( ##SELECT
			'background' => array(
				array('input_background_color','string'),
				array( '!important', 'fixed_string')
			),
			'background-color_select' => 'input_background_color_select',
			'border' => array(
				array('input_border','px'),

				array('input_border_style', 'string'),

				array('input_border_color', 'string'),
				array( '!important', 'fixed_string')

			),
			'-moz-border-radius' => array( array('input_border_radius','px') ),

			'-khtml-border-radius' => array( array('input_border_radius','px') ),

			'-webkit-border-radius' => array( array('input_border_radius','px') ),

			'border-radius' => array( 
				array('input_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('input_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('input_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('input_font_size', 'px' ),
				array( '!important', 'fixed_string')
			),
			'font-style' => array(
				array('input_font_style','string'),
				array( '!important', 'fixed_string')
			),
			'font-weight' => array(
				array('input_font_weight','string'),
				array( '!important', 'fixed_string')
			),
			'width' => array( 
				array( 'input_width', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap select option' => array( ##SELECT

			'color' => array(
				array( 'inherit !important', 'fixed_string')
			),
			'font-family' => array(
				array( 'inherit !important', 'fixed_string')
			),
			'font-size' => array(
				array( 'inherit !important', 'fixed_string')
			),
			'font-style' => array(
				array( 'inherit !important', 'fixed_string')
			),
			'font-weight' => array(
				array( 'inherit !important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap form input[type="submit"]' => array( ## FORM SUBMIT
			'background' => array(
				array('button_background_color','string'),
				array( '!important', 'fixed_string')
			),

			'background-color_select' => 'button_background_color_select',
			'border' => array(

				array('button_border','px'),

				array('button_border_style','string'),

				array('button_border_color','string'),

				array('!important', 'fixed_string'),

			),
			'-moz-border-radius' => array( array('button_border_radius','px') ),

			'-khtml-border-radius' => array( array('button_border_radius','px') ),

			'-webkit-border-radius' => array( array('button_border_radius','px') ),

			'border-radius' => array( 
				array('button_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('button_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('button_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('button_font_size','px'),
				array( '!important', 'fixed_string')
			),
			'margin-top' => array( array( 'button_margin_top','px' ), array( '!important', 'fixed_string') ),
			'margin-bottom' => array( array( 'button_margin_bottom','px' ), array( '!important', 'fixed_string') ),
			'margin-left' => array( array( 'button_margin_left','px' ), array( '!important', 'fixed_string') ),
			'margin-right' => array( array( 'button_margin_right','px' ), array( '!important', 'fixed_string') ),
			'padding-top' => array( array( 'button_padding_top','px' ), array( '!important', 'fixed_string') ),
			'padding-bottom' => array( array( 'button_padding_bottom','px' ), array( '!important', 'fixed_string') ),
			'padding-right' => array( array( 'button_padding_right','px' ), array( '!important', 'fixed_string') ),
			'padding-left' => array( array( 'button_padding_left','px' ), array( '!important', 'fixed_string') ),
			'text-shadow' => array(
				array('button_text_shadow','string'),
				array( '!important', 'fixed_string')
			),
			'text-transform' => 'button_text_transform',
			'width' => array( 
				array( 'button_width', 'px' ),
				array( '!important', 'fixed_string')
			)
		),
		'.magic-action-box .mab-main-action-wrap form input.submit' => array(
			'background' => array(
				array('button_background_color','string'),
				array( '!important', 'fixed_string')
			),

			'background-color_select' => 'button_background_color_select',
			'border' => array(

				array('button_border','px'),

				array('button_border_style','string'),

				array('button_border_color','string'),

				array('!important', 'fixed_string'),

			),
			'-moz-border-radius' => array( array('button_border_radius','px') ),


			'-khtml-border-radius' => array( array('button_border_radius','px') ),

			'-webkit-border-radius' => array( array('button_border_radius','px') ),

			'border-radius' => array( 
				array('button_border_radius','px'),
				array( '!important', 'fixed_string')
			),
			'color' => array(
				array('button_font_color','string'),
				array( '!important', 'fixed_string')
			),
			'font-family' => array(
				array('button_font_family','string'),
				array( '!important', 'fixed_string')
			),
			'font-size' => array(
				array('button_font_size','px'),
				array( '!important', 'fixed_string')
			),
			'margin-top' => array( array( 'button_margin_top','px' ), array( '!important', 'fixed_string') ),
			'margin-bottom' => array( array( 'button_margin_bottom','px' ), array( '!important', 'fixed_string') ),
			'margin-left' => array( array( 'button_margin_left','px' ), array( '!important', 'fixed_string') ),
			'margin-right' => array( array( 'button_margin_right','px' ), array( '!important', 'fixed_string') ),
			'padding-top' => array( array( 'button_padding_top','px' ), array( '!important', 'fixed_string') ),
			'padding-bottom' => array( array( 'button_padding_bottom','px' ), array( '!important', 'fixed_string') ),
			'padding-right' => array( array( 'button_padding_right','px' ), array( '!important', 'fixed_string') ),
			'padding-left' => array( array( 'button_padding_left','px' ), array( '!important', 'fixed_string') ),
			'text-shadow' => array(
				array('button_text_shadow','string'),
				array( '!important', 'fixed_string')
			),
			'text-transform' => 'button_text_transform'
		),
		'.magic-action-box .mab-main-action-wrap form input[type="submit"]:hover' => array(
			'background' => array(
				array('button_background_hover_color','string'),
				array('!important', 'fixed_string')
			),
			'background-color_select' => 'button_background_hover_color_select',
			'border-color' => array(
				array('button_border_hover_color', 'string'),
				array('!important', 'fixed_string')
			),
			'color' => array(
				array('button_font_hover_color','string'),
				array( '!important', 'fixed_string')
			),
			'text-shadow' => 'button_text_shadow'
		),
		'.magic-action-box .mab-main-action-wrap form input.submit:hover' => array(
			'background' => array(
				array('button_background_hover_color','string'),
				array('!important', 'fixed_string')
			),

			'background-color_select' => 'button_background_hover_color_select',
			'border-color' => array(
				array('button_border_hover_color', 'string'),
				array('!important', 'fixed_string')
			),
			'color' => array(
				array('button_font_hover_color','string'),
				array( '!important', 'fixed_string')
			),
			'text-shadow' => 'button_text_shadow'
		),
		'.magic-action-box .mab-aside' => array( ## ASIDE
			'background' => 'aside_background_color',

			'background-color_select' => 'aside_background_color_select',
			'border' => array(

				array('aside_border','px'),

				array('aside_border_style', 'string'),

				array('aside_border_color', 'string')

			),
			'box-shadow' => 'aside_background_shadow',
			'-moz-box-shadow' => 'aside_background_shadow',

			'-webkit-box-shadow' => 'aside_background_shadow',
			'margin-top' => array( array( 'aside_margin_top', 'px' ) ),
			'margin-bottom' => array( array( 'aside_margin_bottom', 'px' ) ),

			'margin-left' => array( array( 'aside_margin_left', 'px' ) ),
			'margin-right' => array( array( 'aside_margin_right', 'px' ) ),
			'padding' => array( array( 'aside_padding','px' ) ),
			'-moz-border-radius' => array( array('aside_corner_radius','px') ),
			'-khtml-border-radius' => array( array('aside_corner_radius','px') ),
			'-webkit-border-radius' => array( array('aside_corner_radius','px') ),
			'border-radius' => array( array('aside_corner_radius','px') )
		),
		'.magic-action-box .mab-aside img' => array( ## IMG INsidE AsIDE
		),
		
		'minify_css' => 'minify_css',
		'mab_custom_css' => 'mab_custom_css'
	);
	
	return apply_filters('mab_get_mapping',$mapping);
	
}

/**
 * Used to create the actual markup of options.
 *
 * @author Gary Jones
 * @param string Used as comparison to see which option should be selected.
 * @param string $type One of 'border', 'family', 'style', 'variant', 'weight', 'align', 'decoration', 'transform'.
 * @since 0.9.5
 * @return string HTML markup of dropdown <option>s
 * @version 0.9.8
 */
function mab_create_options($compare, $type) {

	switch($type) {
		case "border":
			// border styles
			$options = array(
			array('None', 'none'),
			array('Solid', 'solid'),
			array('Dashed', 'dashed'),
			array('Dotted', 'dotted'),
			array('Double', 'double'),
			array('Groove', 'groove'),
			array('Ridge', 'ridge'),
			array('Inset', 'inset'),
			array('Outset', 'outset')
			);
			break;
		case "family":
			//font-family sets
			static $fonts = array();

			if(empty($fonts)){
				$fonts = array(
				array('Arial', 'Arial, Helvetica, sans-serif'),
				array('Arial Black', "'Arial Black', Gadget, sans-serif"),
				array('Century Gothic', "'Century Gothic', sans-serif"),
				array('Courier New', "'Courier New', Courier, monospace"),
				array('Georgia', 'Georgia, serif'),
				array('Lucida Console', "'Lucida Console', Monaco, monospace"),
				array('Lucida Sans Unicode', "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"),
				array('Palatino Linotype', "'Palatino Linotype', 'Book Antiqua', Palatino, serif"),
				array('Tahoma', 'Tahoma, Geneva, sans-serif'),
				array('Times New Roman', "'Times New Roman', serif"),
				array('Trebuchet MS', "'Trebuchet MS', Helvetica, sans-serif"),
				array('Verdana', 'Verdana, Geneva, sans-serif')
				);
				$MabBase = MAB();
				$settingsApi = MAB('settings');
				$settings = $settingsApi->getAll();
				if(!empty($settings['fonts'])){
					$t_fonts = explode("\n", str_replace("\r", "", $settings['fonts']));

					foreach($t_fonts as $f){
						$line = explode(':', $f);

						if(count($line) > 1){
							// used delimiter. first element is the font
							// name. second is the actual font family
							// value
							$fonts[] = array($line[0],$line[1]);
						} else {
							$fonts[] = array($line[0],$line[0]);
						}
					}
				}
			}

			$options = apply_filters('mab_font_family_options', $fonts);
			sort($options);
			array_unshift($options, array('Inherit', 'inherit')); // Adds Inherit option as first option.
			break;
		case "style":
			// font-style options
			$options = array(
			array('Normal', 'normal'),
			array('Italic', 'italic')
			);
			break;
		case "variant":
			// font-variant options
			$options = array(
			array('Normal', 'normal'),
			array('Small-Caps', 'small-caps')
			);
			break;
		case "weight":
			// font-weight options
			$options = array(
			array('Normal', 'normal'),
			array('Bold', 'bold')
			);
			break;
		case "align":
			// text-align options
			$options = array(
			array('Left', 'left'),
			array('Center', 'center'),
			array('Right', 'right'),
			array('Justify', 'justify')
			);
			break;
		case "decoration":
			// text-decoration options
			$options = array(
			array('None', 'none'),
			array('Underline', 'underline'),
			array('Overline', 'overline')
			// Include line-through?
			);
			break;
		case "transform":
			// text-transform options
			$options = array(
			array('None', 'none'),
			array('Capitalize', 'capitalize'),
			array('Lowercase', 'lowercase'),
			array('Uppercase', 'uppercase')
			);
			break;
		case "background":
			// background color options
			$options = array(
			array('Color (Hex)', 'hex'),
			array('Inherit', 'inherit'),
			array('Transparent', 'transparent')
			);
			break;
		case "color":
			// font color options
			$options = array(
			array('Color (Hex)', 'hex'),
			array('Inherit', 'inherit')
			);
			break;
		case 'repeat':
			$options = array(
			array('None', 'no-repeat'),
			array('Horizontal', 'repeat-x'),
			array('Vertical', 'repeat-y'),
			array('All', 'repeat')
			);
			break;
		case 'image_align':
			$options = array(
			array('Left','left'),
			array('Center', 'center'),
			array('Right','right')
			);
			break;
		default:
			$options = '';
	}
	if ( is_array($options) ) {
		$output = '';
		foreach ($options as $option) {
			$output .= '<option value="'. esc_attr($option[1]) . '" title="' . esc_attr($option[1]) . '" ' . selected(esc_attr($option[1]), esc_attr($compare), false) . '>' . __($option[0], 'mab' ) . '</option>';
		}
	} else {
		$output = '<option>Select type was not valid.</option>';
	}
	return $output;
}

/**
 * This next section defines functions that contain the content of the "boxes" that will be
 * output by default on the "Design Settings" page. There's a bunch of them.
 */



	/** GLOBAL DESIGN - applies to all action boxes? **/
	
	/* General Design Settings */
	function mab_general_design_settings( $post = null ){
		//functions here are from lib/design-utilities.php
		echo '<div class="mab-option-box">';
		
		mab_add_heading( 'This settings apply to the main containing box.' );
		mab_setting_line( mab_add_background_color_setting('main_background_color', 'Background' ) );
		mab_setting_line(array(mab_add_text_setting('main_background_image', 'Background Image', 25), mab_add_select_setting('main_background_repeat', '', 'repeat'), mab_add_select_setting('main_background_align', '', 'image_align')));
		$url = esc_attr(add_query_arg(array('send_to_mab_field_id'=>'main_background_image', 'TB_iframe' => 1, 'width' => 640, 'height' => 459), add_query_arg('TB_iframe', null, get_upload_iframe_src('image'))));
		mab_setting_line(mab_add_note(sprintf('<a id="main_background_image_upload" href="%s">Upload</a> your background image.', $url)));
		mab_setting_line(mab_add_border_setting('main_border', 'Border'));

		mab_setting_line(mab_add_text_setting('main_background_shadow', 'Background Shadow'));
		mab_setting_line(mab_add_note(__('Enter <code>0 1px 3px #999999</code> for a subtle background shadow.', 'mab' )));

		mab_setting_line(mab_add_size_setting('main_margin_bottom', 'Margin Bottom'));
		mab_setting_line(mab_add_size_setting('main_margin_top', 'Margin Top'));
		mab_setting_line(mab_add_size_setting('main_padding', 'Padding'));
		mab_setting_line(mab_add_size_setting('main_corner_radius', 'Rounded Corner Radius'));
		mab_setting_line(mab_add_size_setting('main_width', 'Action Box Width'));
		mab_setting_line(mab_add_note(__('Leave blank to set width automatically.', 'mab' )));
		
		echo '</div>';
		
		do_action('mab_design_settings_general');
	}
	
	/* Main Copy */
	function mab_main_copy_design_settings( $post = null ){
		echo '<div class="mab-option-box">';
		mab_add_heading( 'Main font settings. Can be overriden by other sections.' );
		mab_setting_line(mab_add_color_setting('main_font_color', 'Color'));
		mab_setting_line(mab_add_select_setting('main_font_family', 'Font', 'family'));
		mab_setting_line(mab_add_note(__('All fonts listed are considered web-safe', 'mab' )));
		mab_setting_line(mab_add_size_setting('main_font_size', 'Font Size'));
		mab_setting_line(mab_add_size_setting('main_line_height', 'Line Height'));
		### LINKS
		mab_add_heading( 'Link Settings' );
		mab_setting_line(mab_add_background_color_setting('main_link_background', 'Background'));
		mab_setting_line(mab_add_color_setting('main_link_color', 'Color'));
		mab_setting_line(mab_add_select_setting('main_link_decoration', 'Decoration', 'decoration'));
		mab_setting_line(mab_add_background_color_setting('main_link_hover_background', 'Hover Background'));
		mab_setting_line(mab_add_color_setting('main_link_hover', 'Hover Color'));
		mab_setting_line(mab_add_select_setting('main_link_hover_decoration', 'Hover Decoration', 'decoration'));

		echo '</div>';
		do_action('mab_main_copy_design_settings');
	}
	
	/* Headings */
	function mab_heading_design_settings( $post = null ){
		### MAIN HEADING
		echo '<div class="mab-option-box">';
		mab_add_heading( 'The following apply to the Main Heading.' );
		mab_setting_line(mab_add_size_setting('heading_margin_bottom', 'Margin Bottom'));
		mab_setting_line(mab_add_size_setting('heading_margin_top', 'Margin Top'));
		mab_setting_line(mab_add_select_setting('heading_align', 'Text Align', 'align'));
		mab_setting_line(mab_add_size_setting('heading_line_height', 'Line Height'));
		echo '<br />';
		mab_setting_line(mab_add_color_setting('heading_font_color', 'Heading Color'));
		mab_setting_line(mab_add_select_setting('heading_font_family', 'Heading Font', 'family'));
		mab_setting_line(mab_add_size_setting('heading_font_size', 'Heading Font Size'));
		mab_setting_line(mab_add_select_setting('heading_font_style', 'Heading Font Style', 'style'));
		mab_setting_line(mab_add_select_setting('heading_font_weight', 'Heading Font Weight', 'weight'));
		mab_setting_line(mab_add_select_setting('heading_text_transform', 'Heading Text Transform', 'transform'));
		echo '</div>';
		
	}
	
	function mab_sub_heading_design_settings( $post = null ){
		
		### SUBHEADING
		echo '<div class="mab-option-box">';
		mab_add_heading( 'The following apply to the Sub-heading' );
		mab_setting_line(mab_add_size_setting('subheading_margin_bottom', 'Margin Bottom'));
		mab_setting_line(mab_add_size_setting('subheading_margin_top', 'Margin Top'));
		mab_setting_line(mab_add_select_setting('subheading_align', 'Text Align', 'align'));
		mab_setting_line(mab_add_size_setting('subheading_line_height', 'Line Height'));
		echo '<br />';
		mab_setting_line(mab_add_color_setting('subheading_font_color', 'Sub-heading Color'));
		mab_setting_line(mab_add_select_setting('subheading_font_family', 'Sub-heading Font', 'family'));
		mab_setting_line(mab_add_size_setting('subheading_font_size', 'Sub-heading Font Size'));
		mab_setting_line(mab_add_select_setting('subheading_font_style', 'Sub-heading Font Style', 'style'));
		mab_setting_line(mab_add_select_setting('subheading_font_weight', 'Sub-heading Font Weight', 'weight'));
		mab_setting_line(mab_add_select_setting('subheading_text_transform', 'Sub-heading Text Transform', 'transform'));
		echo '</div>';
	}
	
	
	/* Action Box Aside - usually contains an image */
	function mab_aside_design_settings( $post = null ){
		echo '<div class="mab-option-box">';
		mab_setting_line( mab_add_background_color_setting('aside_background_color', 'Background' ) );
		mab_setting_line(mab_add_border_setting('aside_border', 'Border'));
		mab_setting_line(mab_add_text_setting('aside_background_shadow', 'Background Shadow'));
		mab_setting_line(mab_add_note(__('Enter <code>0 1px 1px #999999</code> for a subtle background shadow.', 'mab' )));
		mab_setting_line(mab_add_size_setting('aside_margin_top', 'Margin Top'));
		mab_setting_line(mab_add_size_setting('aside_margin_bottom', 'Margin Bottom'));
		mab_setting_line(mab_add_size_setting('aside_margin_right', 'Margin Right'));
		mab_setting_line(mab_add_size_setting('aside_margin_left', 'Margin Left'));
		mab_setting_line(mab_add_note(__('Enter a negative margin value <code>-20</code> to the side where the image is placed to move it out of the box.', 'mab' )));
		mab_setting_line(mab_add_size_setting('aside_padding', 'Padding'));
		mab_setting_line(mab_add_size_setting('aside_corner_radius', 'Rounded Corner Radius'));
		echo '</div>';
	}
	
	/* Other */
	function mab_other_design_settings( $post = null ){
		mab_setting_line( mab_add_textarea_setting( 'mab_custom_css', __( 'Custom CSS', 'mab' ), 25, 10 ) );
	}
	
	/** OPT IN SPECIFIC **/

	function mab_form_design_settings( $post = null ){
		### LABELS
		echo '<div class="mab-option-box">';
		mab_setting_line(mab_add_size_setting('field_margin_right', 'Distance Between Fields (Right Margin)' ) );
		mab_add_heading( 'Form Labels' );
		mab_setting_line(mab_add_color_setting('input_label_font_color', 'Color'));
		mab_setting_line(mab_add_size_setting('input_label_font_size', 'Font Size'));
		mab_setting_line(mab_add_select_setting('input_label_font_family', 'Font', 'family'));
		mab_setting_line(mab_add_select_setting('input_label_font_style', 'Font Style', 'style'));
		mab_setting_line(mab_add_select_setting('input_label_font_weight', 'Font Weight', 'weight'));
		mab_setting_line(mab_add_size_setting('input_label_margin_bottom', 'Bottom Margin'));
		echo '</div>';
		
		### INPUT BOXES
		echo '<div class="mab-option-box">';
		mab_add_heading( 'Input Boxes' );
		mab_setting_line(mab_add_background_color_setting('input_background_color', 'Background'));
		mab_setting_line(mab_add_border_setting('input_border', 'Border'));
		mab_setting_line(mab_add_color_setting('input_font_color', 'Text Color'));
		mab_setting_line(mab_add_select_setting('input_font_family', 'Font', 'family'));
		mab_setting_line(mab_add_size_setting('input_font_size', 'Font Size'));
		mab_setting_line(mab_add_select_setting('input_font_style', 'Font Style', 'style'));
		mab_setting_line(mab_add_size_setting('input_padding_top', 'Top Padding'));
		mab_setting_line(mab_add_size_setting('input_padding_bottom', 'Bottom Padding'));
		mab_setting_line(mab_add_size_setting('input_padding_right', 'Right Padding'));
		mab_setting_line(mab_add_size_setting('input_padding_left', 'Left Padding'));
		mab_setting_line(mab_add_size_setting('input_border_radius', 'Rounded Corner Radius'));
		mab_setting_line(mab_add_size_setting('input_width', 'Input Field Width'));
		echo '</div>';
		
		### SUBMIT BUTTON
		echo '<div class="mab-option-box">';
		mab_add_heading( 'Submit Button' );
		mab_setting_line(mab_add_background_color_setting('button_background_color', 'Background'));
		mab_setting_line(mab_add_background_color_setting('button_background_hover_color', 'Background Hover'));
		mab_setting_line(mab_add_border_setting('button_border', 'Border'));
		mab_setting_line(mab_add_color_setting('button_border_hover_color', 'Border Hover Color'));
		mab_setting_line(mab_add_color_setting('button_font_color', 'Text Color'));
		mab_setting_line(mab_add_color_setting('button_font_hover_color', 'Text Color Hover'));
		mab_setting_line(mab_add_text_setting('button_text_shadow', 'Text Shadow' ));
		mab_setting_line(mab_add_text_setting('button_text_shadow_hover', 'Text Shadow Hover' ));
		mab_setting_line(mab_add_note(__('Enter <code>[x-offset]px [y-offset]px [shadow size]px [color]</code> to add Text Shadow. Example: <code>1px 1px 0 #000000</code>', 'mab' )));
		mab_setting_line(mab_add_select_setting('button_font_family', 'Font', 'family'));
		mab_setting_line(mab_add_size_setting('button_font_size', 'Font Size'));
		mab_setting_line(mab_add_size_setting('button_margin_top', 'Top Margin'));
		mab_setting_line(mab_add_size_setting('button_margin_bottom', 'Bottom Margin'));
		mab_setting_line(mab_add_size_setting('button_margin_left', 'Left Margin'));
		mab_setting_line(mab_add_size_setting('button_margin_right', 'Right Margin'));
		mab_setting_line(mab_add_note(__('Use margins to position your submit button correctly.', 'mab' )));
		mab_setting_line(mab_add_size_setting('button_padding_top', 'Top Padding'));
		mab_setting_line(mab_add_size_setting('button_padding_bottom', 'Bottom Padding'));
		mab_setting_line(mab_add_size_setting('button_padding_right', 'Right Padding'));
		mab_setting_line(mab_add_size_setting('button_padding_left', 'Left Padding'));
		mab_setting_line(mab_add_size_setting('button_border_radius', 'Rounded Corner Radius'));
		mab_setting_line(mab_add_select_setting('button_text_transform', 'Text Transform', 'transform'));
		mab_setting_line(mab_add_size_setting('button_width', 'Submit Button Width'));
		echo '</div>';
	}
