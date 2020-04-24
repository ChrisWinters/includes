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
	public function shortcode( $atts = array(), $content = null ) {
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
			// Turn on output buffering.
			ob_start();

			while ( $query->have_posts() ) {
				/*
				 * Iterate the post index in the loop.
				 * https://developer.wordpress.org/reference/functions/the_post/
				 */
				$query->the_post();

				/*
				 * Display the post content.
				 * https://developer.wordpress.org/reference/functions/the_content/tent/
				 */
				the_content();
			}//end while

			/*
			 * Restores the $post global
			 * https://developer.wordpress.org/reference/functions/wp_reset_postdata/
			 */
			$query->reset_postdata();

			// Get current buffer contents and delete current output buffer.
			return ob_get_clean();
		}//end if

	}//end shortcode()

}//end class
