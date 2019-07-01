<?php
/**
 * WordPress Filters
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
 * Add Shortcodes To Widget Titles & Menus
 */
class Shortcode_Filters {
	use TraitOptionManager;

	/**
	 * Hook WordPress
	 */
	public function __construct() {
		/*
		 * Fires after WordPress has finished loading but before any headers are sent.
		 * https://developer.wordpress.org/reference/hooks/init/
		 */
		add_action(
			'init',
			[
				$this,
				'add_filters',
			]
		);

		/*
		 * Filters the widget title.
		 * https://developer.wordpress.org/reference/hooks/widget_title/
		 */
		add_filter(
			'widget_title',
			[
				$this,
				'correct_shortcode_widget_titles',
			],
			10,
			3
		);
	}//end __construct()


	/**
	 * Do Add Filter Hooks
	 *
	 * @return void
	 */
	public function add_filters() {
		/*
		 * Check if any filter has been registered for a hook.
		 * https://developer.wordpress.org/reference/functions/has_filter/
		 *
		 * Hook a function or method to a specific filter action.
		 * https://developer.wordpress.org/reference/functions/add_filter/
		 */

		// Enable Shortcodes In Widget Titles.
		if ( '1' === $this->get_setting( 'shortcode_widget_titles' ) ) {
			if ( false === has_filter( 'widget_title', 'do_shortcode' ) ) {
				add_filter( 'widget_title', 'do_shortcode' );
			}
		}

		// Enable Shortcodes In Widgets.
		if ( '1' === $this->get_setting( 'shortcode_widgets' ) ) {
			if ( false === has_filter( 'widget_text', 'do_shortcode' ) ) {
				add_filter( 'widget_text', 'do_shortcode' );
			}
		}

		// Enable Shortcodes In Menus.
		if ( '1' === $this->get_setting( 'shortcode_menus' ) ) {
			if ( false === has_filter( 'wp_nav_menu_items', 'do_shortcode' ) ) {
				add_filter( 'wp_nav_menu_items', 'do_shortcode' );
			}
		}

		// Enable Shortcodes In Post/Page Titles.
		if ( '1' === $this->get_setting( 'shortcode_post_titles' ) ) {
			if ( false === has_filter( 'the_title', 'do_shortcode' ) ) {
				add_filter( 'the_title', 'do_shortcode' );
			}
		}
	}//end add_filters()


	/**
	 * Correct 'includes' Shortcode In Widget Titles
	 *
	 * @param string $title    The widget title. Default 'Pages'.
	 * @param array  $instance Array of settings for the current widget.
	 * @param mixed  $base     The widget ID.
	 */
	public function correct_shortcode_widget_titles( $title, $instance, $base ) {
		if ( '1' === $this->get_setting( 'shortcode_widget_titles' ) ) {
			return htmlspecialchars_decode( $title );
		}

		return $title;
	}//end correct_shortcode_widget_titles()
}//end class
