<div class="themes-php">
	<div class="wrap mab-style-editor">
		<?php screen_icon('edit-comments'); ?>
<h2 class="nav-tab-wrapper">
	<a id="mab-designs-tab" href="#mab-styles" class="nav-tab">Styles</a>
	<a id="mab-buttons-tab" href="#mab-buttons" class="nav-tab">Buttons</a>
	<a id="mab-fonts-tab" href="#mab-fonts" class="nav-tab">Custom Fonts</a>
</h2>
<!-- END HEADER -->

<?php 
## MESSAGES
if( isset( $_GET['deleted'] ) && 'true' == $_GET['deleted'] ):
?>
	<div id="mab-settings-deleted-message" class="updated fade"><p><strong><?php esc_html_e( 'Item Deleted', 'mab' ); ?></strong></p></div>

<?php elseif( isset( $_GET['duplicated'] ) && 'true' == $_GET['duplicated'] ) : ?>
	<div id="mab-settings-duplicated-message" class="updated fade"><p><strong><?php esc_html_e( 'Item Duplicated', 'mab' ); ?></strong></p></div>

<?php elseif( isset( $_GET['mab-button-duplicated'] ) ): ?>
	<?php $duplicate_key_url = esc_url( add_query_arg( array( 'page' => 'mab-button-settings', 'mab-button-id' => $_GET['mab-button-duplicated'] ), admin_url('admin.php') ) ); ?>
	<div id="mab-settings-duplicated-button-message" class="updated fade"><p><strong><?php _e( sprintf( 'Button duplicated. <a href="%1$s">Click here</a> to edit the new button.', $duplicate_key_url ), 'mab' ); ?></strong></p></div>

<?php elseif( isset( $_GET['mab-preconfigured-buttons'] ) && 'true' == $_GET['mab-preconfigured-buttons'] ): ?>
	<div id="mab-settings-preconfigured-message" class="updated fade"><p><strong><?php esc_html_e( 'Preconfigured Buttons Created', 'mab' ); ?></strong></p></div>

<?php elseif( isset( $_GET['mab-invalid-button-id'] ) && $_GET['mab-invalid-button-id'] == true ): ?>
	<div id="mab-settings-invalid-button-id-message" class="updated fade"><p><strong><?php esc_html_e( 'Invalid button ID used', 'mab' ); ?></strong></p></div>
<?php endif;

##END MESSAGES
?>

<?php
$buttons = $data['buttons'];
$styles = $data['styles'];
$fonts = $data['fonts'];
?>

<div id="mab-styles" class="group">
	<h3><?php _e('Action Box Styles', 'mab' ); ?> <a href="<?php echo esc_url(admin_url('admin.php?page=mab-style-settings')); ?>" class="button button-primary"><?php _e('Create New Style', 'mab' ); ?></a></h3>

	<table class="widefat">
		<thead>
			<tr>
				<th scope="col"><?php _e('Name','mab' ); ?></th>
				<th scope="col"><?php _e('Last Saved', 'mab' ); ?></th>
				<th scope="col"><?php _e('Actions', 'mab' ); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col"><?php _e('Name','mab' ); ?></th>
				<th scope="col"><?php _e('Last Saved', 'mab' ); ?></th>
				<th scope="col"><?php _e('Actions', 'mab' ); ?></th>
			</tr>
		</tfoot>
		<tbody>
			<?php //var_dump( $buttons ); 
			foreach( $styles as $style_key => $style ):
			?>
			<tr>
				<td><?php echo esc_html( $style['title'] ); ?></td>
				<td><?php echo esc_html(date( 'F j, Y \a\t g:iA', $style['timesaved'] ) ); ?></td>
				<td>
					<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'mab-style-settings', 'mab-style-key' => $style_key), admin_url('admin.php') ) ); ?>"><?php _e('Edit','mab'); ?></a>
				
					| <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'page'=> 'mab-design', 'mab-style-key' => $style_key, 'mab-duplicate-style' => 'true' ), admin_url( 'admin.php' ) ), 'mab-duplicate-style' ) ); ?>"><?php _e('Duplicate', 'mab' ); ?></a>
				
					| <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'page' => 'mab-design', 'mab-style-key' => $style_key, 'mab-delete-style' => 'true'), admin_url('admin.php') ), 'mab-delete-style') ); ?>"><?php _e('Delete','mab' ); ?></a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- #mab-designs -->

<div id="mab-buttons" class="group">
	<h3><?php _e('CSS3 Buttons', 'mab' ); ?> <a href="<?php echo esc_url(admin_url('admin.php?page=mab-button-settings')); ?>" class="button button-primary"><?php _e('Create New', 'mab' ); ?></a> <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'page' => 'mab-design', 'mab-create-preconfigured' => 'true' ), admin_url('admin.php') ), 'mab-create-preconfigured' ) ); ?>" class="button button-secondary"><?php _e('Create Preconfigured Buttons', 'mab' ); ?></a></h3>
	
	<table class="widefat">
		<thead>
			<tr>
				<th scope="col"><?php _e('Title','mab' ); ?></th>
				<th scope="col"><?php _e('Last Saved', 'mab' ); ?></th>
				<th scope="col"><?php _e('Example Button', 'mab' ); ?></th>
				<th scope="col"><?php _e('Actions', 'mab' ); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col"><?php _e('Title','mab' ); ?></th>
				<th scope="col"><?php _e('Last Saved', 'mab' ); ?></th>
				<th scope="col"><?php _e('Example Button', 'mab' ); ?></th>
				<th scope="col"><?php _e('Actions', 'mab' ); ?></th>
			</tr>
		</tfoot>
		<tbody>
			<?php //var_dump( $buttons ); 
			foreach( $buttons as $key => $button ):
			?>
			<tr>
				<td><?php echo esc_html( $button['title'] ); ?></td>
				<td><?php echo esc_html(date( 'F j, Y \a\t g:iA', $button['timesaved'] ) ); ?></td>
				<td><a href="#" onclick="return false;" style="display:block; float: left; margin: 5px 0;" class="mab-button-<?php echo $key; ?>"><?php echo esc_html($button['title']); ?></a></td>
				<td><a href="<?php echo esc_url( add_query_arg( array( 'page' => 'mab-button-settings', 'mab-button-id' => $key), admin_url('admin.php') ) ); ?>"><?php _e('Edit','mab'); ?></a>
				| <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'page' => 'mab-design', 'mab-button-id' => $key, 'mab-button-action' => 'duplicate'), admin_url('admin.php') ), 'mab-duplicate-button') ); ?>"><?php _e('Duplicate','mab' ); ?></a>
				| <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'page' => 'mab-design', 'mab-button-id' => $key, 'mab-button-action' => 'delete'), admin_url('admin.php') ), 'mab-delete-button') ); ?>"><?php _e('Delete','mab' ); ?></a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div><!-- #mab-buttons -->


<div id="mab-fonts" class="group">
	<?php if(!empty($_GET['mab-fonts-updated'])): ?>
	<div class="updated fade"><p><?php _e( 'Fonts saved.', 'mab' ); ?></p></div>
	<?php endif; ?>

	<p><?php _e('Specify fonts you would like to be available when creating your own styles. One font family per line.', 'mab'); ?></p>
	<p><?php _e('You may also specify the name to use in the dropdown by doing: "NAME:FONT-FAMILY"', 'mab'); ?></p>
	<p><em><?php _e('Example:', 'mab'); ?></em><br>
	Roboto<br>
	Oswald<br>
	Metro:Metrophobic, arial, serif<br>
	Open Sans:Open sans condensed
	</p>
	<form method="post" action="<?php echo add_query_arg( array() ); ?>">
		<?php wp_nonce_field( 'save-mab-fonts-nonce','save-mab-fonts-nonce' ); ?>
		<h3><input name="mab-save-fonts" type="submit" class="button button-primary" value="<?php _e('Save', 'mab'); ?>"></h3>
		<textarea class="code large-text" rows="10" style="max-width: 500px;" name="mab[fonts]"><?php echo esc_textarea($fonts); ?></textarea>
	</form>
</div><!-- #mab-fonts -->
<!-- FOOTER -->
	</div><!-- .wrap -->
</div><!-- .themes-php -->
