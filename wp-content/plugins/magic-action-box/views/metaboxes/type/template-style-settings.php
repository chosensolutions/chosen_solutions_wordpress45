<?php
/**
 * Style Settings Template
 * this template is loaded using php include
 */
?>
<?php 
$MabDesign = MAB('design');
$preconfiguredStyles = $data['styles']; 
$userStyles = $MabDesign->getStyleSettings(); 
$selected_style = isset( $meta['style'] ) ? $meta['style'] : null;
?>
<div class="mab-option-box">
	<h4><label for="mab-style"><?php _e('Action Box Style', 'mab' ); ?></label></h4>
	<p>Choose a style for this Action Box. Select <strong>User Settings</strong> to use the design settings specified below.</p>
	<select id="mab-style" class="large-text" name="mab[style]">
		<?php $selected_style = isset( $meta['style'] ) ? $meta['style'] : null; ?>
		<option value="user" <?php selected($selected_style, 'user'); ?>>User Styles</option>
		<option value="none" <?php selected($selected_style, 'none'); ?>>None</option>
		<?php //PRECONFIGURED STYLES ?>
		<optgroup label="Pre-configured Styles">
		<?php foreach( $preconfiguredStyles as $key => $style ): ?>
			<option value="<?php echo $key; ?>" <?php selected( $selected_style, $key ); ?> ><?php echo $style['name']; ?></option>
		<?php endforeach; ?>
		</optgroup>
		
	</select>
	<select id="mab-user-style" class="large-text" name="mab[userstyle]" style="display: none;">
		<?php $selected_user_style = isset( $meta['userstyle'] ) ? $meta['userstyle'] : null; ?>
		<?php foreach( $userStyles as $key => $style ) : ?>
			<option value="<?php echo $key; ?>" <?php selected( $selected_user_style, $key ); ?> ><?php echo $style['title']; ?></option>
		<?php endforeach; ?>
	</select>
	<p class="description">More styles available in <a href="http://www.magicactionbox.com/features/?pk_campaign=LITE&pk_kwd=editScreen-moreStyles" target="_blank">Magic Action Box Pro</a>.</p>
	<h4 id="mab-style-preview-heading"><?php _e('Thumbnail Preview','mab'); ?><br />
	<small>Note: This is only a representation of the design and does not reflect the actual look.</small></h4>
	<ul id="mab-style-preview">
		<li id="mab-style-user-preview" style="display:none;"><span class="mab-style-caption">You can create your owns styles</span></li>
		<li id="mab-style-none-preview" style="display:none;"><span class="mab-style-caption"><strong>Note:</strong> CSS styles specified in the Custom CSS box <em>(under Design Setting: Others)</em> will still be applied.</span></li>
		<?php foreach( $preconfiguredStyles as $key => $style ): ?>
			<?php $styleThumb = $MabAdmin->getActionBoxStyleThumb( $key ); ?>
			<li id="mab-style-<?php echo $key; ?>-preview" <?php if( $key != $selected_style ):?> style="display: none;" <?php endif; ?>>
				<div class="mab-style-thumb">
					<?php if( !empty( $styleThumb ) ): ?>
						<img class="mab-style-image" src="<?php echo $styleThumb; ?>" alt="" width="300" />
					<?php else: ?>
						<span class="mab-style-noimage"><strong>No thumbnail image defined</strong></span>
					<?php endif; ?>
					<span class="mab-style-caption">Any CSS styles specified in the Custom CSS box<br /><strong>(Design Settings: Others)</strong> will be applied.</span>
				</div>
				<div class="mab-style-description"><strong>Description:</strong><br /><?php echo !empty( $style['description']) ? $style['description'] : 'None.'; ?></div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
