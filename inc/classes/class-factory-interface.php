<?php
/**
 * Interface
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

/**
 * Interface For Factory Classes
 */
interface Factory_Interface {
	/**
	 * Class Creator
	 *
	 * @param string $classname Qualified Classname.
	 * @param string $args      Class Args.
	 *
	 * @return object
	 */
	public function create( $classname = '', $args = [] );
}//end interface
