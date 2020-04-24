<?php
/**
 * Class Trait
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

/**
 * Required Params Exception Error
 */
trait Trait_Exception {
	/**
	 * Silent Exception Notice Unless WP_DEBUG = true Then wp_die()
	 *
	 * @param array $args     Class Args.
	 * @param array $required Required Parameter Key Names.
	 * @throws \Exception     With Error Message.
	 */
	public function required_params( $args = array(), $required = array() ) {
		ob_start();

		try {
			if ( true === empty( $args ) ) {
				throw new \Exception( "Class $args required." );
			}

			if ( true === empty( $required ) ) {
				throw new \Exception( "Class $required parameter key names required." );
			}

			foreach ( (array) $required as $param ) {
				if ( true === empty( $args[ $param ] ) || false === isset( $args[ $param ] ) ) {
					throw new \Exception( "Class parameter '{$param}' is required." );
				}
			}

			foreach ( (array) $required as $param ) {
				if ( false === isset( $param ) ) {
					throw new \Exception( "Class parameter '\$this->{$param}' is required." );
				}
			}
		} catch ( \Exception $e ) {
			ob_end_clean();

			if ( true === WP_DEBUG ) {
				wp_die( esc_html( $e->getMessage() ) );
			}

			$e->getMessage();
		}//end try

	}//end required_params()

}//end class
