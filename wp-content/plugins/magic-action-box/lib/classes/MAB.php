<?php

class MAB extends ProsulumMabBase{
	const POST_TYPE = 'action-box';
	const KEY_ACTION_BOX_TYPE = '_mab_action_box_type';
	const KEY_DUPLICATED = '_mab_action_box_duplicated';
	const KEY_SETTINGS = '_mab_settings';
	const KEY_POST_META = '_mab_post_meta';
	const KEY_DESIGN_SETTINGS = '_mab_design_settings';
	const KEY_CURRENT_VERSION = '_mab_current_version';
	const KEY_NOTICE = '_mab_nag_notice';
	const KEY_INSTALL_DATE = '_mab_install_date';

	public static function activate(){
		$MabBase = MAB();

		if( !is_object( $MabBase ) ){
			$MabBase = new MAB();
		}

		//check for post type
		if( !post_type_exists( self::POST_TYPE ) )
			$MabBase->register_post_type();

		//setup initial settings?
		$settingsApi = MAB('settings');
		$settingsApi->defaultSettingsIfNew();

		flush_rewrite_rules();
	}

	public static function deactivate(){

	}
}