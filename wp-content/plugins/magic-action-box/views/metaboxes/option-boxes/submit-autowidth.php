<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
$submitWidth = !empty($meta['optin']['auto-width-submit']) ? 1 : 0; ?>
	<label><input type="checkbox" value="1" name="mab[optin][auto-width-submit]" <?php checked($submitWidth, 1); ?>> <strong>Auto adjust submit button width.</strong></label>
	<p class="descriptiona">Will apply css declaration <code>width: auto;</code> to the submit button element.</p>