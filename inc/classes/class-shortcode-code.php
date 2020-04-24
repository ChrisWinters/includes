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
final class Shortcode_Code extends AbstractShortcode {
	/**
	 * Metabox Slug ID.
	 *
	 * @var string
	 */
	protected $metabox_id;


	/**
	 * Setup Class
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args ) {
		$this->metabox_id = $args['metabox_id'];
		$this->init( $args );

	}//end __construct()


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
				 * Retrieves a post meta field for the given post ID.
				 * https://developer.wordpress.org/reference/functions/get_post_meta/
				 */
				$content = get_post_meta( $query->posts[0]->ID, $this->metabox_id, true );

				try {
					eval( '?>' . html_entity_decode( $content, ENT_QUOTES | ENT_XML1, 'UTF-8' ) );

				} catch ( Throwable $t ) {
					$content = null;

				}
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
