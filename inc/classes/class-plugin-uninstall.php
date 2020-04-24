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

if ( false === defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

/**
 * Remove Plugin Settings
 */
final class Plugin_Uninstall {
	/**
	 * Init Plugin Uninstall
	 */
	public static function init() {
		self::clean_options_data();
		self::clean_post_data();
	}//end init()


	/**
	 * Delete Plugin and Freemius Options
	 */
	private static function clean_options_data() {
		/*
		 * WordPress Database Access Abstraction Object.
		 * https://developer.wordpress.org/reference/classes/wpdb/
		 */
		global $wpdb;

		/*
		 * Retrieve an entire SQL result set from the database.
		 * https://developer.wordpress.org/reference/classes/wpdb/get_results/
		 */
		$includes_options = $wpdb->get_results(
			"SELECT option_name 
			FROM $wpdb->options 
			WHERE option_name 
			LIKE 'includes%'",
			ARRAY_A
		);

		foreach ( (array) $includes_options as $option ) {
			if ( true !== empty( $option ) && isset( $option['option_name'] ) ) {
				/*
				 * Removes option by name. Prevents removal of protected WordPress options.
				 * https://developer.wordpress.org/reference/functions/delete_option/
				 */
				delete_option( $option['option_name'] );
			}
		}

		/*
		 * Retrieve an entire SQL result set from the database.
		 * https://developer.wordpress.org/reference/classes/wpdb/get_results/
		 */
		$fs_options = $wpdb->get_results(
			"SELECT option_name 
			FROM $wpdb->options 
			WHERE option_name 
			LIKE 'fs_%'",
			ARRAY_A
		);

		if ( true === empty( $fs_options ) ) {
			return;
		}

		foreach ( (array) $fs_options as $option ) {
			if ( true !== empty( $option ) && isset( $option['option_name'] ) ) {
				/*
				 * Removes option by name. Prevents removal of protected WordPress options.
				 * https://developer.wordpress.org/reference/functions/delete_option/
				 */
				delete_option( $option['option_name'] );
			}
		}
	}//end clean_options_data()


	/**
	 * Delete Includes Posts & Post Meta Data
	 */
	private static function clean_post_data() {
		/*
		 * WordPress Database Access Abstraction Object.
		 * https://developer.wordpress.org/reference/classes/wpdb/
		 */
		global $wpdb;

		/*
		 * Retrieve an entire SQL result set from the database.
		 * https://developer.wordpress.org/reference/classes/wpdb/get_results/
		 */
		$result = $wpdb->get_results(
			"SELECT $wpdb->posts.ID 
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
			AND $wpdb->posts.post_type = 'includes'
			ORDER BY $wpdb->posts.post_date DESC",
			ARRAY_A
		);

		$post_ids = array();

		if ( true === empty( $result ) ) {
			return;
		}

		foreach ( (array) $result as $key => $post ) {
			$post_ids[ $post['ID'] ] = $post['ID'];
		}

		foreach ( (array) array_unique( $post_ids ) as $post_id ) {
			/*
			 * Deletes a post meta field for the given post ID.
			 * https://developer.wordpress.org/reference/functions/delete_post_meta/
			 */
			delete_post_meta( (int) $post_id, 'includes_code' );

			/*
			 * Trash or delete a post or page.
			 * https://developer.wordpress.org/reference/functions/wp_delete_post/
			 */
			wp_delete_post( (int) $post_id, true );
		}
	}//end clean_post_data()
}//end class
