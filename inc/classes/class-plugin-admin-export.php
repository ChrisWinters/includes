<?php
/**
 * Manager Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

use Includes\Trait_Option_Manager as TraitOptionManager;

/**
 * Export Plugin Settings
 */
final class Plugin_Admin_Export {
	use TraitOptionManager;

	/**
	 * Export Settings
	 *
	 * @return string $data
	 */
	public function data() {
		/*
		 * Whether the current user has a specific capability.
		 * https://developer.wordpress.org/reference/functions/current_user_can/
		 */
		if ( false === current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		/*
		 * Removes option by name.
		 * https://developer.wordpress.org/reference/functions/delete_option/
		 */
		delete_option( 'includes_children' );

		$loaded_options = $this->get_option();

		if ( true === empty( $loaded_options ) ) {
			return false;
		}

		$options = array();

		foreach ( $loaded_options as $name => $value ) {
			$options[ $name ] = $value;
		}

		// Return Data.
		if ( false === empty( $options ) ) {
			/*
			 * Encode a variable into JSON, with some sanity checks.
			 * https://developer.wordpress.org/reference/functions/wp_json_encode/
			 */
			return htmlentities(
				wp_json_encode(
					$options,
					(
						JSON_UNESCAPED_UNICODE |
						JSON_UNESCAPED_SLASHES |
						JSON_NUMERIC_CHECK
					)
				)
			);
		}

		return false;

	}//end data()

}//end class
