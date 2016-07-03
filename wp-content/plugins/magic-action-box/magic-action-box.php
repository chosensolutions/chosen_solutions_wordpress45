<?php
/**
 * Plugin Name: Magic Action Box
 * Plugin URI: http://magicactionbox.com
 * Description: Supercharge your blog posts!
 * Version: 2.17.1
 * Author: Prosulum, LLC
 * Author URI: http://prosulum.com
 * License: GPLv2
 */

define( 'MAB_VERSION', '2.17.1');
//e.g. /var/www/example.com/wordpress/wp-content/plugins/after-post-action-box
define( "MAB_DIR", plugin_dir_path( __FILE__ ) );
//e.g. http://example.com/wordpress/wp-content/plugins/after-post-action-box
define( "MAB_URL", plugin_dir_url( __FILE__ ) );
define( 'MAB_THEMES_DIR', trailingslashit( MAB_DIR ) . 'themes/' );
define( 'MAB_THEMES_URL', trailingslashit( MAB_URL ) . 'themes/' );
define( 'MAB_STYLES_DIR', trailingslashit( MAB_DIR ) . 'styles/' );
define( 'MAB_STYLES_URL', trailingslashit( MAB_URL ) . 'styles/' );
//e.g. after-post-action-box/after-post-action-box.php
define( 'MAB_BASENAME', plugin_basename( __FILE__ ) );
define( 'MAB_LIB_DIR', trailingslashit( MAB_DIR ) . 'lib/' );
define( 'MAB_LIB_URL', trailingslashit( MAB_URL ) . 'lib/' );
define( 'MAB_ADDONS_DIR', trailingslashit( MAB_LIB_DIR ) . 'addons/' );
define( 'MAB_ADDONS_URL', trailingslashit( MAB_LIB_URL ) . 'addons/' );
define( 'MAB_CLASSES_DIR', trailingslashit( MAB_LIB_DIR ) . 'classes/' );
define( 'MAB_VIEWS_DIR', trailingslashit( MAB_DIR ) . 'views/' );
define( 'MAB_VIEWS_URL', trailingslashit( MAB_URL ) . 'views/' );
define( 'MAB_ASSETS_URL', trailingslashit( MAB_URL ) . 'assets/' );
define( 'MAB_POST_TYPE', 'action-box' );
define( 'MAB_DOMAIN', 'mab' );

require_once( MAB_CLASSES_DIR . 'autoload.php');

new MAB();

register_activation_hook( __FILE__, array( 'MAB', 'activate' ) );
register_deactivation_hook(__FILE__, array( 'MAB', 'deactivate' ));
