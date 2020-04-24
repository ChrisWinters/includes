<?php
/**
 * Factory Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

use Includes\Factory_Interface as FactoryInterface;


/**
 * Instantiate Shortcode Classes
 */
final class Factory_Shortcode implements FactoryInterface {
	/**
	 * Class Creator
	 *
	 * @param string $classname Qualified Classname.
	 * @param string $args      Class Args.
	 *
	 * @return object
	 */
	public function create( $classname = '', $args = array() ) {
		$class_name = 'Includes\\' . $classname;

		if ( true === empty( $classname ) || false === class_exists( $class_name ) ) {
			return;
		}

		return new $class_name( $args );

	}//end create()

}//end class
