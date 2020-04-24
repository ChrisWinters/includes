<?php
/**
 * Helper Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

/**
 * WP Query Interaction For Shortcodes
 */
trait Trait_Shortcode_Wp_Query {
	/**
	 * WP Query Attribute
	 *
	 * @var string
	 */
	protected $category;

	/**
	 * Number of Items to Display.
	 *
	 * @var int
	 */
	protected $posts_per_page;

	/**
	 * WP Query Attribute
	 *
	 * @var string
	 */
	protected $orderby;

	/**
	 * WP Query Attribute
	 *
	 * @var string
	 */
	protected $order;

	/**
	 * WP Query Attribute
	 *
	 * @var string
	 */
	protected $slug;


	/**
	 * Set Class Parameters & Initialize Class
	 *
	 * @param string $posttype Post Type Slug.
	 * @param string $taxonomy Taxonomy Slug.
	 * @param array  $atts     Shortcode Attributes.
	 */
	final public function wpquery( $posttype, $taxonomy = '', $atts = array() ) {
		// Required.
		if ( true === empty( $atts ) ) {
			return array();
		}

		// Clear, Required.
		$this->slug = '';

		// Maybe Reset Slug.
		if ( true !== empty( $atts['slug'] ) ) {
			$this->slug = $atts['slug'];
		}

		$this->posttype = $posttype;
		$this->taxonomy = $taxonomy;

		// Default 1 Post Per Page.
		$this->posts_per_page = 1;

		// Maybe Reset Posts Per Page.
		if ( true !== empty( $atts['posts_per_page'] ) ) {
			$this->posts_per_page = $atts['posts_per_page'];
		}

		if ( ( includes_fs()->can_use_premium_code() ) ) {
			// No Values.
			$this->category = '';
			$this->orderby  = '';
			$this->order    = '';

			if ( true !== empty( $atts['category'] ) ) {
				$this->category = $atts['category'];
			}

			if ( true !== empty( $atts['orderby'] ) ) {
				$this->orderby = $atts['orderby'];
			}

			if ( true !== empty( $atts['order'] ) ) {
				$this->order = $atts['order'];
			}

			if ( true === empty( $this->category ) && true === empty( $this->slug ) ) {
				return array();
			}
		}

		return $this->set_wpquery();

	}//end wpquery()


	/**
	 * Merge Arrays/Values & Build WP Query.
	 *
	 * @return array
	 */
	final private function set_wpquery() {
		if ( '1' === $this->get_setting( 'shortcode_posts_pages' ) ) {
			$post_type = array(
				$this->posttype,
				'post',
				'page',
			);
		} else {
			$post_type = $this->posttype;
		}

		return array_merge(
			array(
				'post_type'      => $post_type,
				'post_status'    => 'publish',
				'orderby'        => $this->set_order_by(),
				'order'          => $this->set_order(),
				'posts_per_page' => intval( $this->posts_per_page ),
				'nopaging'       => false,
				'no_found_rows'  => true,
			),
			$this->set_query_type()
		);

	}//end set_wpquery()



	/**
	 * Build WP Query Query Type
	 * Sets the slug name or taxonomy slug name
	 *
	 * @return array
	 */
	final private function set_query_type() {
		$array = array();

		if ( true !== empty( $this->slug ) ) {
			/*
			 * Sanitizes a string key.
			 * https://developer.wordpress.org/reference/functions/sanitize_key/
			 */
			$array = array(
				'name' => sanitize_key( $this->slug ),
			);
		}

		if ( true !== empty( $this->category ) ) {
			/*
			 * Sanitizes a string key.
			 * https://developer.wordpress.org/reference/functions/sanitize_key/
			 */
			$array = array(
				'tax_query' => array(
					array(
						'taxonomy'         => $this->taxonomy,
						'field'            => 'slug',
						'terms'            => $this->category,
						'include_children' => true,
					),
				),
			);
		}

		return $array;

	}//end set_query_type()


	/**
	 * Build WP Query Orderby.
	 *
	 * @return string
	 */
	final private function set_order_by() {
		$allowed_orderbys = array(
			'none',
			'ID',
			'date',
			'title',
			'slug',
			'rand',
			'modified',
		);

		$orderby = 'slug';

		if ( ( includes_fs()->can_use_premium_code() ) ) {
			if ( true !== empty( $this->orderby ) && true === in_array( $this->orderby, $allowed_orderbys, true ) ) {
				$orderby = $this->orderby;
			}
		}

		return $orderby;

	}//end set_order_by()


	/**
	 * Build WP Query Order.
	 *
	 * @return string
	 */
	final private function set_order() {
		$order = 'DESC';

		if ( ( includes_fs()->can_use_premium_code() ) ) {
			if ( true !== empty( $this->order ) && 'asc' === strtolower( $this->order ) ) {
				$order = 'ASC';
			}
		}

		return $order;

	}//end set_order()

}//end trait
