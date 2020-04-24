<?php
/**
 * Autoload Classes
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Register Classes
 *
 * @param string $class Loaded Classes.
 *
 * @since 1.0.0
 */
function includes_register_classes( $class ) {
	// Namespace Prefix.
	$prefix = 'Includes\\';

	// Move To Next Rgistered autoloader.
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return;
	}

	// Build Class Name.
	$relative_class = strtolower( str_replace( '_', '-', substr( $class, $len ) ) );

	// Replace Dir Separators and Replace Namespace with Base Dir.
	$file = INCLUDES_DIR . '/inc/classes/class-' . str_replace( '\\', '/', $relative_class ) . '.php';

	// Include File.
	if ( true === file_exists( $file ) ) {
		require $file;
	}

}//end includes_register_classes()

spl_autoload_register( 'Includes\includes_register_classes' );
