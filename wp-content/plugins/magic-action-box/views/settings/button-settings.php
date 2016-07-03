<div class="themes-php">
	<div class="wrap">
		<?php screen_icon('edit-comments'); ?>
		<h2 id="mab-settings-header">Add New Button</h2>
		
<!-- END HEADER -->
<form method="post" action="<?php echo add_query_arg( array() ); ?>" id="mab-button-form">
	<div id="mab-content">
			
<?php if( isset( $_GET['updated'] ) && $_GET['updated'] == 'true' ): ?>
	<div id="mab-design-settings-update" class="updated fade"><p><strong><?php _e( 'Button Saved.', 'mab' ); ?></strong></p></div>
<?php elseif( isset( $_GET['reset'] ) && $_GET['reset'] == 'true' ): ?>
	<div id="mab-design-settings-reset" class="updated fade"><p><strong><?php _e( 'Button Reset.', 'mab' ); ?></strong></p></div>
<?php endif; ?>

<?php $MabButton = MAB('button');
$button = $data['button'];
$key = $data['key'];
$action = $data['action'];
$button_code = $data['button-code']; ?>

<?php 
//TODO: put button id/key here if editing a button
if( $action == 'edit' && isset( $key ) ):
?>
<input type="hidden" name="mab-button-key" value="<?php echo esc_attr( $key ); ?>" />
<?php endif; ?>



<?php
//TODO: wp nonces 
wp_nonce_field( 'save-mab-button-settings-nonce','save-mab-button-settings-nonce' ); 
?>

<?php //TODO: hidden fields ?>
<input type="hidden" name="mab-button-settings-action" value="<?php echo $action; //"add" or "edit" ?>" />

<div id="mab-button-creation-container">
	<table class="form-table button-creation-form-table">
	
		<!-- BUTTON NAME -->
		<tr>
			<th scope="row"><label for="button-editing-title"><?php _e('Button Name', 'mab' ); ?></label></th>
			<td>
				<?php 
				$title = $button['title'];
				if( isset( $_GET['reset'] ) && 'true' == $_GET['reset'] && isset( $_GET['button-title'] ) )
					$title = $_GET['button-title'];
				?>
				<input class="large-text" type="text" name="button-settings[title]" id="button-editing-title" value="<?php echo esc_attr( $title ); ?>" /><br />
				<?php _e('This name is for identification purposes only. You will choose the text for the button when you use it.', 'mab' ); ?>
			</td>
		</tr>
		<!-- BACKGROUND -->
		<tr>
			<th scope="row"><?php _e('Background', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'background-color-start', __('Start Color', 'mab' ), $button['background-color-start'] ); ?></li>
					<li><?php $MabButton->buttonColorPicker( 'background-color-end', __('End Color', 'mab' ), $button['background-color-end'] ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- BACKGROUND HOVER-->
		<tr>
			<th scope="row"><?php _e('Background on Hover', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'background-color-hover-start', __('Start Color', 'mab' ), $button['background-color-hover-start'] ); ?></li>
					<li><?php $MabButton->buttonColorPicker( 'background-color-hover-end', __('End Color', 'mab' ), $button['background-color-hover-end'] ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- BORDERS AND PADDING -->
		<tr>
			<th scope="row"><?php _e('Border/Padding', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'border-color', __('Border Color', 'mab' ), $button['border-color'] ); ?></li>
					<li><?php $MabButton->buttonSelect( 'border-width', __('Border Width', 'mab' ), $button['border-width'], 0, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'border-radius', __('Corner Radius', 'mab' ), $button['border-radius'], 0, 100, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'padding-tb', __('Top/Bottom Padding', 'mab' ), $button['padding-tb'], 0, 100, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'padding-lr', __('Left/Right Padding', 'mab' ), $button['padding-lr'], 0, 100, 'px' ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- BORDER ON HOVER -->
		<tr>
			<th scope="row"><?php _e('Border on Hover', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'border-color-hover', __('Border Color on Hover', 'mab' ), $button['border-color-hover'] ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- DROP SHADOW -->
		<tr>
			<th scope="row"><?php _e('Drop Shadow', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'box-shadow-color', __('Shadow Color', 'mab' ), $button['box-shadow-color'] ); ?></li>
					<li><?php $MabButton->buttonSelect( 'box-shadow-opacity', __('Opacity', 'mab' ), $button['box-shadow-opacity'], 0, 1, '', .1 ); ?></li>
					<li><?php $MabButton->buttonSelect( 'box-shadow-x', __('X Distance', 'mab' ), $button['box-shadow-x'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'box-shadow-y', __('Y Distance', 'mab' ), $button['box-shadow-y'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'box-shadow-size', __('Size', 'mab' ), $button['box-shadow-size'], 0, 50, 'px' ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- INNER SHADOW -->
		<tr>
			<th scope="row"><?php _e('Inner Shadow', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'inset-shadow-color', __('Shadow Color', 'mab' ), $button['inset-shadow-color'] ); ?></li>
					<li><?php $MabButton->buttonSelect( 'inset-shadow-opacity', __('Opacity', 'mab' ), $button['inset-shadow-opacity'], 0, 1, '', .1 ); ?></li>
					<li><?php $MabButton->buttonSelect( 'inset-shadow-x', __('X Distance', 'mab' ), $button['inset-shadow-x'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'inset-shadow-y', __('Y Distance', 'mab' ), $button['inset-shadow-y'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'inset-shadow-size', __('Size', 'mab' ), $button['inset-shadow-size'], 0, 50, 'px' ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- FONT FAMILY -->
		<tr>
			<th scope="row"><?php _e('Font Settings', 'mab' ); ?></th>
			<td>
				<ul>
					<li>
						<label for="button-editing-font-family"><?php _e('Font', 'mab' ); ?></label>
						<select name="button-settings[font-family]" id="button-editing-font-family">
							<?php echo mab_create_options($button['font-family'], 'family'); ?>
						</select>
					</li>
					<li>
						<label for="button-editing-font-weight"><?php _e('Font Weight', 'mab' ); ?></label>
						<select name="button-settings[font-weight]" id="button-editing-font-weight">
							<?php echo mab_create_options($button['font-weight'], 'weight'); ?>
						</select>
					</li>
					<li>
						<label for="button-editing-font-transform"><?php _e('Font Transform', 'mab' ); ?></label>
						<select name="button-settings[font-transform]" id="button-editing-font-transform">
							<?php echo mab_create_options($button['font-transform'], 'transform'); ?>
						</select>
					</li>
					<li><?php $MabButton->buttonColorPicker( 'font-color', __('Color', 'mab' ), $button['font-color'] ); ?></li>
					<li><?php $MabButton->buttonSelect( 'font-size', __('Size', 'mab' ), $button['font-size'], 0, 50, 'px' ); ?></li>
				</ul>
			</td>
		</tr>
		<!-- TEXT SHADOW 1-->
		<tr>
			<th scope="row"><?php _e('Text Shadow 1', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'text-shadow-1-color', __('Shadow Color', 'mab' ), $button['text-shadow-1-color'] ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-1-opacity', __('Opacity', 'mab' ), $button['text-shadow-1-opacity'], 0, 1, '', .1 ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-1-x', __('X Distance', 'mab' ), $button['text-shadow-1-x'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-1-y', __('Y Distance', 'mab' ), $button['text-shadow-1-y'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-1-size', __('Size', 'mab' ), $button['text-shadow-1-size'], 0, 50, 'px' ); ?></li>
				</ul>
			</td>
		</tr>
		<?php /*
		<!-- TEXT SHADOW 2-->
		<tr>
			<th scope="row"><?php _e('Text Shadow 2', 'mab' ); ?></th>
			<td>
				<ul>
					<li><?php $MabButton->buttonColorPicker( 'text-shadow-2-color', __('Shadow Color', 'mab' ), $button['text-shadow-2-color'] ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-2-opacity', __('Opacity', 'mab' ), $button['text-shadow-2-opacity'], 0, 1, '', .1 ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-2-x', __('X Distance', 'mab' ), $button['text-shadow-2-x'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-2-y', __('Y Distance', 'mab' ), $button['text-shadow-2-y'], -10, 10, 'px' ); ?></li>
					<li><?php $MabButton->buttonSelect( 'text-shadow-2-size', __('Size', 'mab' ), $button['text-shadow-2-size'], 0, 50, 'px' ); ?></li>
				</ul>
			</td>
		</tr>
		*/ ?>
		
	</table>

</div><!-- #mab-button-creation-container -->

<pre class="code" id="button-code" style="display:none;">
	<?php echo $button_code; ?>
</pre>

<div id="mab-button-preview">
	<h3><?php _e( 'Button Preview', 'mab' ); ?></h3>
	<style type="text/css" id="example-button-style"></style>
	<a class="mab-css3button" href="#" onclick="return false;"><?php _e('Example', 'mab' ); ?></a>
</div>
		
<div class="bottom-buttons">
	<input type="submit" class="button-primary" name="save-button-settings" value="<?php _e('Save Button', 'mab' ); ?>" />
	<input type="submit" class="button-highlighted button-reset" name="button-settings[reset]" value="<?php _e('Reset Button', 'mab' ); ?>" />
</div>

<script type="text/javascript">
	function mab_button_update_example_css(){
		jQuery( '#example-button-style').text(jQuery('#button-code').text());
	}
	
	jQuery( document ).ready( function($){
		
		//live update of button
	    $('#mab-button-creation-container').find('input[type=text],select').bind('blur change keyup keydown', function(event) {
	    	var $this = $(this);
	    	var $buttoncode = $('#button-code');
			var id = $this.attr('id').replace('button-editing-','');
	    	if('' == id) {
	    		id = $this.attr('id').replace('button-editing-','');
	    	}
	    	
	    	var val = $this.val();
	    	
	    	var $element = $('#button-code').find('.'+id);
	    	if($element.is('.rgb')) {
	    		val = hex2rgb(val);
	    	}
	    	
	    	$element.text(val);
	    	mab_button_update_example_css();
	    });

		mab_button_update_example_css();

		//make sure that button has a title. If not set, then use default title
		$('#mab-button-form').submit( function(){
			var name = $('#button-editing-title').val();
			if($.trim(name) == ''){
				$('#button-editing-title').val('My Button');
			}
		});
		
	});
</script>


	</div><!-- #mab-content -->
</form><!-- #mab-button-form -->

<!-- START FOOTER -->

	</div><!-- .wrap -->
</div><!-- .themes-php-->
