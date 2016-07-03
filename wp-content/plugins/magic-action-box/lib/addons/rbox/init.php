<?php
/** Definitions **/
define( 'MAB_RBOX_TYPE', 'rbox' );
define( 'MAB_RBOX_DOMAIN', MAB_DOMAIN );

/** Initialize our addon **/
add_action( 'mab_init', 'mab_rbox_init' );

function mab_rbox_init(){

	$status = 'disabled';

	$upgrade = sprintf(__('<em><small>(Available in <a href="%s" target="_blank">Magic Action Box Pro</a>)</small></em><br />'), 'http://www.magicactionbox.com/features/?pk_campaign=LITE&pk_kwd=addScreen');

	$description = $upgrade . __('Use this box type to display a different random action box on every page load.', 'mab' );
	$title = __('Random Box', 'mab' );

	$boxType = array(
		'type' => MAB_RBOX_TYPE,
		'name' => $title,
		'description' => $description,
		'status' => $status
	);
	mab_register_action_box( $boxType );
}