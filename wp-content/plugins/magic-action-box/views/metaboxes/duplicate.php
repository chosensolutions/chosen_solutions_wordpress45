<?php
$post_id = $data['post_id'];
$query_args = array('mab-action' => 'duplicate', 'post' => $post_id, 'action' => 'edit' );
$url = add_query_arg( $query_args, admin_url('post.php') );
$url = wp_nonce_url( $url, 'mab-duplicate_action_box_nonce' );

?>
<div class="mab-duplicate-wrap">
	<p>Clicking on the <em>Duplicate</em> button below will create an exact copy of this action box - same style settings and content.</p>
	<a href="<?php echo $url; ?>" class="button-primary">Duplicate this Action Box</a>
</div>