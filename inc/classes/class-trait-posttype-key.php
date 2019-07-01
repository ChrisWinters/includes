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
 * Sanitize & Truncate Posttype Key
 */
trait Trait_Posttype_Key {
	/**
	 *  Sanitize Key & Truncate To 20 Characters.
	 *
	 * @param string $posttype Post Type Slug.
	 *
	 * @return string
	 */
	final public function clean_posttype( $posttype = '' ) {
		if ( true === empty( $posttype ) ) {
			return '';
		}

		/*
		 * Lowercase alphanumeric characters, dashes and underscores are allowed
		 * https://developer.wordpress.org/reference/functions/sanitize_key/
		 */
		$posttype = sanitize_key( $posttype );

		if ( true === strlen( $posttype ) > 20 ) {
			$posttype = substr( $posttype, 0, 20 );
		}

		return $posttype;
	}//end clean_posttype()
}//end trait
