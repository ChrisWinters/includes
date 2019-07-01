<?php
/**
 * Feature Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

use Includes\Abstract_Shortcode as AbstractShortcode;

/**
 * Register 'includes' Shortcode
 */
final class Shortcode_Includes extends AbstractShortcode {
	/**
	 * Do Shortcode
	 *
	 * @param array  $atts    Shortcode Attributes.
	 * @param string $content Shortcode Content.
	 *
	 * @return void
	 */
	public function shortcode( $atts = [], $content = null ) {
		if ( true === empty( $atts ) || true !== is_array( $atts ) ) {
			return;
		}

		$wp_query = $this->wpquery( $this->posttype, $this->taxonomy, $atts );

		if ( true === empty( $wp_query ) ) {
			return;
		}

		/*
		 * WordPress WP_Query Class
		 * https://developer.wordpress.org/reference/classes/wp_query/
		 */
		$query = new \WP_Query( $wp_query );

		/*
		 * Whether current WordPress query has results to loop over.
		 * https://developer.wordpress.org/reference/functions/have_posts/
		 */
		if ( true === $query->have_posts() ) {
			while ( $query->have_posts() ) {
				/*
				 * Iterate the post index in the loop.
				 * https://developer.wordpress.org/reference/functions/the_post/
				 */
				$query->the_post();

				ob_start();

				/*
				 * Search content for shortcodes and filter shortcodes through their hooks
				 * https://developer.wordpress.org/reference/functions/do_shortcode/
				 *
				 * Retrieve the post content.
				 * https://developer.wordpress.org/reference/functions/get_the_content/
				 */
				echo do_shortcode(
					get_the_content()
				);

				/*
				 * Restores the $post global
				 * https://developer.wordpress.org/reference/functions/wp_reset_postdata/
				 */
				wp_reset_postdata();

				return ob_get_clean();
			}//end while
		}//end if
	}//end shortcode()
}//end class
