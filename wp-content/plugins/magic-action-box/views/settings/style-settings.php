<?php
$settings = $data['settings'];
$key = $data['key'];
$action = $data['action'];
$baseStyles = $data['base-styles'];
$selectedBaseStyle = mab_get_fresh_design_option('base_style');
$selectedActionBox = !empty($_GET['action-box']) ? $_GET['action-box'] : '';
if(empty($selectedActionBox)){
	$selectedActionBox = mab_get_fresh_design_option('preview_action_box');
}
?>
<div class="themes-php mab-design-settings-page">
	<div class="wrap">

<!--		<div id="actionbox-preview"></div>-->

<form method="post" action="<?php echo add_query_arg( array() ); ?>" id="mab-style-settings-form">

<!--	<div class="mab-panel-controls">
		<label><?php /*_e('Select action box to preview: ', 'mab'); */?></label><select id="actionbox-preview-dropdown" name="mab-design[preview_action_box]">
			<?php /*foreach($data['actionboxes'] as $ab): */?>
				<option value="<?php /*echo $ab->ID; */?>" <?php /*selected($selectedActionBox, $ab->ID); */?>><?php /*echo $ab->post_title; */?></option>
			<?php /*endforeach; */?>
		</select>
		<a href="#fullscreen" class="button mab-fullscreen-toggle" data-enablefullscreen="1"><?php /*_e('Fullscreen', 'mab'); */?></a>
	</div>-->

	<?php if( isset( $key ) ) : ?>
		<input type="hidden" name="mab-style-key" value="<?php echo $key; ?>" />
	<?php endif; ?>

	<p>
		<label for="mab-style-title"><strong>Style Name:</strong></label>
		<input id="mab-style-title" size="30" name="mab-design[title]" value="<?php echo $settings['title']; ?>" type="text" />
	</p>
<!--	<p>
		<label><?php /*_e('Base Style:', 'mab'); */?></label>
		<select id="base-style" name="mab-design[base_style]">
			<option value=""><?php /*_e('None', 'mab'); */?></option>
			<?php /*foreach($baseStyles as $key => $s): */?>
				<option value="<?php /*echo $key; */?>" <?php /*selected($selectedBaseStyle, $key); */?> ><?php /*echo $s['name']; */?></option>
			<?php /*endforeach; */?>
		</select>
	</p>-->
	
	<h3 id="mab-style-settings-tabs" class="nav-tab-wrapper">
		<a id="mab-style-general-tab" href="#mab-style-general" class="nav-tab">General</a>
		<a id="mab-style-copy-tab" href="#mab-style-copy" class="nav-tab">Content Copy</a>
		<a id="mab-style-mainheading-tab" href="#mab-style-mainheading" class="nav-tab">Main Heading</a>
		<a id="mab-style-subheading-tab" href="#mab-style-subheading" class="nav-tab">Sub Heading</a>
		<a id="mab-style-form-tab" href="#mab-style-form" class="nav-tab">Form Elements</a>
		<a id="mab-style-aside-tab" href="#mab-style-aside" class="nav-tab">Aside</a>
		<a id="mab-style-others-tab" href="#mab-style-others" class="nav-tab">Others</a>
	</h3>
	
	<div class="metabox-holder">
		<div class="postbox">
			<div id="mab-content">
				<?php if( isset( $_GET['updated'] ) && $_GET['updated'] == 'true' ): ?>
					<div id="mab-design-settings-update" class="updated fade"><p><strong><?php _e( 'Style Saved.', 'mab' ); ?></strong></p></div>
				<?php elseif( isset( $_GET['reset'] ) && $_GET['reset'] == 'true' ): ?>
					<div id="mab-design-settings-reset" class="updated fade"><p><strong><?php _e( 'Style Reset.', 'mab' ); ?></strong></p></div>
				<?php endif; ?>
				
				<?php //TODO:nonces here
				wp_nonce_field( 'save-mab-style-settings-nonce', 'save-mab-style-settings-nonce' ); ?>
	<!--
	============== END HEADER ==================-->
	
	<div class="mab-settings-wrap">
		<div id="mab-style-general" class="group">
			<h3>General Design and Layout</h3>
			<?php mab_general_design_settings(); ?>
		</div><!-- #mab-style-general -->
		
		<div id="mab-style-copy" class="group">
			<h3>Main Copy</h3>
			<?php mab_main_copy_design_settings(); ?>
		</div><!-- #mab-style-copy -->
		
		<div id="mab-style-mainheading" class="group">
			<h3>Main Heading</h3>
			<?php mab_heading_design_settings(); ?>
		</div><!-- #mab-style-mainheading -->
	
		<div id="mab-style-subheading" class="group">
			<h3>Sub Heading</h3>
			<?php mab_sub_heading_design_settings(); ?>
		</div><!-- #mab-style-subheading -->
		
		<div id="mab-style-form" class="group">
			<h3>Form Elements</h3>
			<?php mab_form_design_settings(); ?>
		</div><!-- #mab-style-form -->
		
		<div id="mab-style-aside" class="group">
			<h3>Aside Content</h3>
			<?php mab_aside_design_settings(); ?>
		</div><!-- #mab-style-asidecontent -->
		
		<div id="mab-style-others" class="group">
			<h3>Others</h3>
			<div class="mab-option-box">
				<?php mab_other_design_settings(); ?>
			</div>
		</div><!-- #mab-style-others -->
		
		<div class="mab-design-settings-page-submit-wrap">
			<input class="button-primary" type="submit" value="<?php _e('Save Style','mab'); ?>" name="save-style-settings" />
		</div>
	</div><!-- .mab-settings-wrap-->
	
	
	<!--============ START FOOTER =================-->
			</div><!-- #mab-content -->
		</div><!-- .postbox -->
	</div><!-- .metabox-holder -->
</form>
		
	</label><!-- .wrap -->
</div><!-- .themes-php -->
