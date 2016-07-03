<?php
	$MabBase = MAB();
	$meta = $data['meta'];
	$assets_url = $data['assets-url'];
	
?>
<div class="mab-option-box">
	<h4><label for="mab-post-action-box"><?php _e('Select Action Box','mab' ); ?></label></h4>
	<p><?php _e( sprintf('Select an Action Box to display. <a href="http://www.magicactionbox.com/features/?pk_campaign=LITE&pk_kwd=selectDefaultBox" target="_blank">With Pro version</a>, you can also specify the default Action Box to use in the <a href="%1s">Main Settings page</a>.', admin_url('admin.php?page=mab-main') ),'mab' ); ?></p>
	<select id="mab-post-action-box" class="large-text" name="mabpostmeta[post-action-box]" >
		<?php $selected_action_box = isset( $meta['post-action-box'] ) ? $meta['post-action-box'] : 'default'; ?>
		<option value="none" <?php selected( $selected_action_box, 'none' ); ?> >Disable</option>
		<option value="default" <?php selected( $selected_action_box, 'default' ); ?> >Use Default</option>
		<?php //Get action boxes available
			$action_boxes_obj = get_posts( array( 'numberposts' => -1, 'orderby' => 'title date', 'post_type' => $MabBase->get_post_type() ) );
			foreach( MAB_ActionBox::getAll() as $action_box ):
		?>
			<option value="<?php echo $action_box->ID; ?>" <?php selected( $selected_action_box, $action_box->ID ); ?> ><?php echo $action_box->post_title; ?></option>
		<?php endforeach; ?>
	</select>
</div>

<div class="mab-option-box">
	<h4>Action Box Placement</h4>
	<p>Where do you want the action box in relation to your post content.</p>

	<ul id="mab-post-action-box-placement-choices" class="mab-placement-choices">
		<li>
			<label for="mab-post-action-box-placement-bottom">
				<img alt="Action Box after the post" src="<?php echo $assets_url; ?>images/actionbox-bottom.png" />
				<br />
				<?php $placement = !empty( $meta['post-action-box-placement'] ) ? $meta['post-action-box-placement'] : 'bottom'; ?>
				<input id="mab-post-action-box-placement-bottom" value="bottom" type="radio" <?php checked( in_array( $placement, array( 'bottom', '') ), true ); ?> name="mabpostmeta[post-action-box-placement]" />
				After Content
			</label>
		</li>
		<li>
			<label for="mab-post-action-box-placement-top">
				<img alt="Action Box before the post" src="<?php echo $assets_url; ?>images/actionbox-top.png" />
				<br />
				<input id="mab-post-action-box-placement-top" value="top" type="radio" <?php checked( $placement, 'top'); ?> name="mabpostmeta[post-action-box-placement]" />
				Before Content
			</label>
		</li>
		<li class="mab-actionbox-placement-manual">
			<label for="mab-post-action-box-placement-manual">
				<p><span>Show action boxes manually using the <code>[magicactionbox]</code> shortcode or the <code>mab_get_actionbox()</code> PHP function.</span></p>
				<input id="mab-post-action-box-placement-manual" value="manual" type="radio" <?php checked( $placement, 'manual'); ?> name="mabpostmeta[post-action-box-placement]" />
				Manual
			</label>
		</li>
	</ul>
	You may also use the shortcode <span style="font-weight: bold; font-family: Consolas,Monaco,monospace;">[magicactionbox id="ACTIONBOX ID"]</span> to manually position your magic action box. You may also use the function <span style="font-weight: bold; font-family: Consolas,Monaco,monospace">mab_get_actionbox()</span> in your theme files to do the same thing. Example: <span style="font-weight: bold; font-family: Consolas,Monaco,monospace">echo mab_get_actionbox();</span>
</div>
