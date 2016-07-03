<?php
$post = $data;
?>
<div class="mab-publish-action">
	<div class="mab-delete-action">
	<?php if( current_user_can('delete_post', $post->ID ) ):
		if( !EMPTY_TRASH_DAYS )
			$deleteText = __('Delete Permanently');
		else
			$deleteText = __('Move to Trash');
		?>
		<a class="submitdelete deletion" href="<?php echo get_delete_post_link($post->ID); ?>"><?php echo $deleteText; ?></a>
	<?php endif; ?>
	</div>
	
	<div class="mab-submit-action">
		<?php if( !in_array($post->post_status, array('publish','future','private')) || 0 == $post->ID ): ?>
			<?php submit_button( __( 'Save' ), 'primary', 'publish', false, array( 'tabindex' => '5', 'accesskey' => 'p' ) ); ?>
			<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Publish') ?>" />
		<?php else: ?>
			<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Update') ?>" />
			<input name="save" type="submit" class="button-primary" id="publish" tabindex="5" accesskey="p" value="<?php esc_attr_e('Update') ?>" />
		<?php endif; ?>
	</div>
</div>