<?php
$meta = $data['meta'];
$forms = $data['forms'];
?>

<div class="mab-option-box">
	<h4><label for="mab-gforms-select">Select Gravity Form</label></h4>
	<p>Select the form that you would like to display in this action box.</a>.</p>

	<?php
	if( !empty( $forms ) ):
	$selected_form_id = !empty( $meta['gforms']['form-id'] ) ? $meta['gforms']['form-id'] : '';
	?>
	<select name="mab[gforms][form-id]" class="large-text">
		<?php foreach( $forms as $form ): ?>
		<option value="<?php echo $form->id; ?>" <?php selected($selected_form_id, $form->id ); ?> ><?php echo $form->title; ?></option>
		<?php endforeach; ?>
	</select>
	<p><?php _e("Can't find your form? Make sure it's active.", MAB_DOMAIN); ?></p>

	<?php else: ?>
	<div class="mab-notice">You don't have any forms yet. <a href="<?php echo admin_url('admin.php?page=gf_new_form'); ?>">Create one</a></div>
	<?php endif; ?>
</div>

<?php if(!empty($forms)): ?>
<div class="mab-option-box">
	<h4>Form Display Options</h4>

	<p>
		<?php $display_title = !empty($meta['gforms']['show-title']) ? 1 : 0; ?>
		<label><input type="checkbox" value="1" <?php checked($display_title, 1); ?> name="mab[gforms][show-title]"> Display Form Title</label>
	</p>

	<p>
		<?php $display_desc = !empty($meta['gforms']['show-desc']) ? 1 : 0; ?>
		<label><input type="checkbox" value="1" <?php checked($display_desc, 1); ?> name="mab[gforms][show-desc]"> Display Form Description</label>
	</p>

	<p>
		<?php $display_title = !empty($meta['gforms']['ajax']) ? 1 : 0; ?>
		<label><input type="checkbox" value="1" <?php checked($display_title, 1); ?> name="mab[gforms][ajax]"> Enable AJAX</label>
	</p>
</div>
<?php endif; ?>