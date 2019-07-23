<?php
/**
 * WordPress Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

/**
 * Activation Rules
 */
final class Plugin_Activate {
	/**
	 * Init Plugin Activation
	 *
	 * @return void
	 */
	public static function init() {
		/*
		 * Retrieves the current WordPress version
		 * https://developer.wordpress.org/reference/functions/get_bloginfo/
		 */
		$wp_version = get_bloginfo( 'version' );

		if ( true === version_compare( $wp_version, 3.8, '<' ) ) {
			/*
			 * Kill WordPress execution and display HTML message with error message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 *
			 * Escaping for HTML blocks.
			 * https://developer.wordpress.org/reference/functions/esc_html/
			 */
			wp_die( esc_html__( 'WordPress 3.8 is required. Please upgrade WordPress and try again.', 'includes' ) );
		}

		// Skip Freemius Connection.
		includes_fs()->skip_connection( null, true );

		/*
		 * Remove rewrite rules and then recreate rewrite rules.
		 * https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
		 */
		flush_rewrite_rules();
	}//end init()
}//end class
