<?php
spl_autoload_register('MabClassLoader');

/**
 * Handles dynamic loading of classes as registered with spl_autoload_register
 *
 */
function MabClassLoader($className) {

    // Check if the class name has our prefix.
    if (strpos($className, 'MAB') !== false || strpos($className, 'ProsulumMab') !== false) {

		$file = MAB_CLASSES_DIR . "$className.php";

		if(is_file($file)) {
			require_once($file);

		}
	}
}
?>