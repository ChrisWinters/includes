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
 * Sanitize & Truncate Taxonomy Key
 */
trait Trait_Taxonomy_Key {
	/**
	 *  Sanitize Key & Truncate To 32 Characters.
	 *
	 * @param string $taxonomy Taxonomy Slug.
	 *
	 * @return string
	 */
	final public function clean_taxonomy( $taxonomy = '' ) {
		if ( true === empty( $taxonomy ) ) {
			return '';
		}

		/*
		 * Lowercase alphanumeric characters, dashes and underscores are allowed
		 * https://developer.wordpress.org/reference/functions/sanitize_key/
		 */
		$taxonomy = sanitize_key( $taxonomy );

		if ( true === strlen( $taxonomy ) > 32 ) {
			$taxonomy = substr( $taxonomy, 0, 32 );
		}

		return $taxonomy;

	}//end clean_taxonomy()

}//end trait
