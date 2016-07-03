jQuery(document).ready(function(){
	
	var mab_image_selector = function(){
		var pID = jQuery('#post_ID').val();
		var trigger = jQuery(this);

		//Change "insert into post" to "Use this image"
		setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').addClass('button-primary').val('Use This Image');}, 1500);
		
		//hide "Save All Changes" button
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#file-form #save').hide();}, 1500 );
		
		//hide "From URL" tab
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#tab-type_url').hide();}, 500 );

		tb_show("", "media-upload.php?&TB_iframe=true&type=image"); 

		window.send_to_editor = function(html){
			var imgurl = jQuery('img',html).attr('src');
			trigger.siblings('.mab-image-select-target').val( imgurl );
			trigger.siblings('.mab-image-select-preview').attr('src', imgurl);
			tb_remove();
		}

		return false;
	};

	/**
	 * Image select stuff
	 */
	jQuery(document).on('click', '.mab-image-select .mab-image-select-trigger', mab_image_selector);

	/** TO REPLACE 
	 * Convert the block of code below to a function
	======================================================**/
	
	
	
	//main background image wp upload
	jQuery('#main_background_image_upload').click(function(){

		var pID = jQuery('#post_ID').val();
		
		//Change "insert into post" to "Use this File"
		setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').addClass('button-primary').val('Use This Image');}, 1500);
		
		//hide "Save All Changes" button
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#file-form #save').hide();}, 1500 );
		
		//hide "From URL" tab
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#tab-type_url').hide();}, 500 );

		tb_show("", "media-upload.php?&TB_iframe=true&type=image"); 

		window.send_to_editor = function(html){
			var imgurl = jQuery('img',html).attr('src');
			jQuery('#main_background_image').val( imgurl );
			tb_remove();
		}

		return false;
	});
	
	//Opt In Box Image upload
	jQuery('#mab-optin-form-image-url-upload').click(function(){

		var pID = jQuery('#post_ID').val();
		
		//Change "insert into post" to "Use this File"
		setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').addClass('button-primary').val('Use This Image');}, 1500);
		
		//hide "Save All Changes" button
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#file-form #save').hide();}, 1500 );
		
		//hide "From URL" tab
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#tab-type_url').hide();}, 500 );

		tb_show("", "media-upload.php?&TB_iframe=true&type=image"); 		

		window.send_to_editor = function(html){
			var imgurl = jQuery('img',html).attr('src');
			jQuery('#mab-optin-form-image-url').val( imgurl );
			tb_remove();
		}
	
		return false;
	});
	
	//Aside Image upload
	jQuery('#mab-aside-image-url-upload').click(function(){

		var pID = jQuery('#post_ID').val();
		
		//Change "insert into post" to "Use this File"
		setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').addClass('button-primary').val('Use This Image');}, 1500);
		
		//hide "Save All Changes" button
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#file-form #save').hide();}, 1500 );
		
		//hide "From URL" tab
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#tab-type_url').hide();}, 500 );

		tb_show("", "media-upload.php?&TB_iframe=true&type=image"); 

		window.send_to_editor = function(html){
			var imgurl = jQuery('img',html).attr('src');
			jQuery('#mab-aside-image-url').val( imgurl );
			tb_remove();
		}
		
		return false;
	});
	
	//Sales Box main button image upload
	jQuery('#mab-main-button-image-url-upload').click(function(){

		var pID = jQuery('#post_ID').val();
		
		//Change "insert into post" to "Use this File"
		setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').addClass('button-primary').val('Use This Image');}, 1500);
		
		//hide "Save All Changes" button
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#file-form #save').hide();}, 1500 );
		
		//hide "From URL" tab
		setInterval(function(){ jQuery('#TB_iframeContent').contents().find('#tab-type_url').hide();}, 500 );

		tb_show("", "media-upload.php?&TB_iframe=true&type=image"); 

		window.send_to_editor = function(html){
			var imgurl = jQuery('img',html).attr('src');
			jQuery('#mab-main-button-image-url').val( imgurl );
			jQuery('#mab-main-button-image-preview').attr('src',imgurl);
			tb_remove();
		}
		
		return false;
	});

	
	/** END TO REPLACE 
	=================================================== **/

	/* TODO: find a way to wrap design fields in own div */
	var isUnsaved = false, $design_settings = jQuery('#post-body-content');

    // Only show the background color input when the background color option type is Color (Hex)
    jQuery('.background-option-types', $design_settings).each(function() {
        mabShowHideHexColor(jQuery(this));
        jQuery(this).change( function() {
            mabShowHideHexColor( jQuery(this) ) 
        });
    });
    
    // Add color picker to color input boxes.
    jQuery('input:text.mab-color-picker' ).each(function (i) {
        jQuery(this).after('<div id="picker-' + i + '" style="z-index: 100; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>');
        jQuery('#picker-' + i).hide().farbtastic(jQuery(this));
    })
    .focus(function() {
        jQuery(this).next().show();
    })
    .blur(function() {
        jQuery(this).next().hide();
        isUnsaved = true;
    });
    
    /**
     * Tabs on Design/Button Settings
     */
	// Switches tab group on load
	jQuery('.group').hide();
	var activetab = '';
	if (typeof(localStorage) != 'undefined' ) {
		activetab = localStorage.getItem("activetab");
	}
	if (activetab != '' && jQuery(activetab).length ) {
		jQuery(activetab).fadeIn();
	} else {
		jQuery('.group:first').fadeIn();
	}

	//Switches tab on load
	if (activetab != '' && jQuery(activetab + '-tab').length ) {
		jQuery(activetab + '-tab').addClass('nav-tab-active');
	}
	else {
		jQuery('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	//Switches groups when clicking on the tab
	jQuery('.nav-tab-wrapper a').click(function(evt) {
		jQuery('.nav-tab-wrapper a').removeClass('nav-tab-active');
		jQuery(this).addClass('nav-tab-active').blur();
		var clicked_group = jQuery(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activetab", jQuery(this).attr('href'));
		}
		jQuery('.group').hide();
		jQuery(clicked_group).fadeIn();
		evt.preventDefault();
	});

});

/**
	* Show or hide the hex color input.
	* 
	* @author Gary Jones
	* @param {String} jQuery object for a Select element
	* @since 0.9.7
	*/
function mabShowHideHexColor($selectElement) {
	// Use of hide() and show() look bad, as it makes it display:block before display:none / inline.
	$selectElement.next().css('display','none');
	if ($selectElement.val() == 'hex') {
		$selectElement.next().css('display', 'inline');
	}
}