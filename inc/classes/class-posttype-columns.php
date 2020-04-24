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

use Includes\Trait_Option_Manager as TraitOptionManager;
use Includes\Trait_Posttype_Key as TraitPosttypeKey;
use Includes\Trait_Taxonomy_Key as TraitTaxonomyKey;

/**
 * Post Type Columns Injector
 */
final class Posttype_Columns {
	use TraitOptionManager;
	use TraitPosttypeKey;
	use TraitTaxonomyKey;

	/**
	 * Taxonomy Name.
	 *
	 * @var string
	 */
	protected $posttype;

	/**
	 * Taxonomy Name.
	 *
	 * @var string
	 */
	protected $taxonomy;

	/**
	 * Shortcode Key Name.
	 *
	 * @var string
	 */
	protected $shortcode;

	/**
	 * Columns To Unset.
	 *
	 * @var array
	 */
	protected $unset_columns = array();

	/**
	 * Columns To Set.
	 *
	 * @var array
	 */
	protected $set_columns = array();


	/**
	 * Set Class Parameters
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args = array() ) {
		$this->posttype  = $this->clean_posttype( $args['posttype'] );
		$this->taxonomy  = $this->clean_taxonomy( $args['taxonomy'] );
		$this->shortcode = $args['shortcode'];

		$this->unset_columns = array(
			'title',
			'author',
			'date',
		);

		if ( ( includes_fs()->can_use_premium_code() ) ) {
			$this->set_columns = array(
				'title'     => esc_html__( 'Include Name', 'includes' ),
				'shortcode' => esc_html__( 'Shortcode', 'includes' ),
				'category'  => esc_html__( 'Categories', 'includes' ),
				'author'    => esc_html__( 'Created By', 'includes' ),
				'date'      => esc_html__( 'Published', 'includes' ),
			);
		} else {
			$this->set_columns = array(
				'title'     => esc_html__( 'Include Name', 'includes' ),
				'shortcode' => esc_html__( 'Shortcode', 'includes' ),
				'author'    => esc_html__( 'Created By', 'includes' ),
				'date'      => esc_html__( 'Published', 'includes' ),
			);
		}

		if ( filter_input( INPUT_GET, 'post_type' ) !== $this->posttype ) {
			return;
		}
	}//end __construct()


	/**
	 * Init Columns
	 */
	public function init() {
		/*
		 * Filters the columns displayed in the Posts list table for a specific post type
		 * https://developer.wordpress.org/reference/hooks/manage_post_type_posts_columns/
		 */
		add_filter(
			'manage_' . $this->posttype . '_posts_columns',
			array(
				$this,
				'columns',
			),
			10,
			1
		);

		/*
		 * Fires for each custom column of a specific post type in the Posts list table.
		 * https://developer.wordpress.org/reference/hooks/manage_post-post_type_posts_custom_column/
		 */
		add_action(
			'manage_' . $this->posttype . '_posts_custom_column',
			array(
				$this,
				'contents',
			),
			10,
			2
		);
	}//end init()


	/**
	 * Unset/Set Custom Custom Post Type Columns
	 *
	 * @param array $columns Current Post Type Columns.
	 *
	 * @return array $columns
	 */
	public function columns( $columns ) {
		$unset_columns = array();

		if ( true !== empty( $this->unset_columns ) ) {
			$unset_columns = $this->unset_columns;
		}

		foreach ( $unset_columns as $column ) {
			if ( true === isset( $column ) ) {
				unset( $columns[ $column ] );
			}
		}

		$set_columns = array();

		if ( true !== empty( $this->set_columns ) ) {
			$set_columns = $this->set_columns;
		}

		foreach ( $set_columns as $column => $label ) {
			if ( true === isset( $column ) && true === isset( $label ) ) {
				$columns[ $column ] = $label;
			}
		}

		return $columns;
	}//end columns()


	/**
	 * Inject Columns Contents
	 *
	 * @param string $column  The Column To Target.
	 * @param int    $post_id Current Posts Post ID.
	 *
	 * @return void
	 */
	public function contents( $column, $post_id ) {
		global $post;

		if ( ( includes_fs()->can_use_premium_code() ) ) {
			if ( 'category' === $column ) {
				echo wp_kses_post( $this->categories__premium_only( $post_id ) );
			}
		}

		if ( 'shortcode' === $column ) {
			echo wp_kses_post( $this->shortcode( $post_id, $post->post_name ) );
		}
	}//end contents()


	/**
	 * Categories Column
	 *
	 * @param int $post_id Current Posts Post ID.
	 *
	 * @return void
	 */
	private function categories__premium_only( $post_id ) {
		/*
		 * Retrieve the terms of the taxonomy that are attached to the post
		 * https://developer.wordpress.org/reference/functions/get_the_terms/
		 */
		$categories = get_the_terms( (int) $post_id, (string) $this->taxonomy );

		if ( true === empty( $categories ) || true !== empty( $categories ) && false === is_array( $categories ) ) {
			return;
		}

		$category_count = count( $categories );

		$counter = 0;

		$html = '';

		foreach ( (array) $categories as $category ) {
			if ( 0 === $category->count ) {
				continue;
			}

			// Comma Count.
			$counter++;

			// Add Comma.
			$comma = ', ';

			// Clear Comma.
			if ( $counter === $category_count ) {
				$comma = '';
			}

			/*
			 * Sanitizes a string key.
			 * https://developer.wordpress.org/reference/functions/sanitize_key/
			 *
			 * Escaping for HTML blocks.
			 * https://developer.wordpress.org/reference/functions/esc_html/
			 */
			$html .= '<a href="edit.php?post_type=' . $this->posttype . '&' .
			$this->taxonomy . '=' . sanitize_key( $category->slug ) . '">' .
			esc_html( $category->name ) . '</a>' . $comma;
		}

		return $html;
	}//end categories__premium_only()


	/**
	 * Shortcode Column
	 *
	 * @param int    $post_id  Current Post ID.
	 * @param string $post_slug Post Slug Value.
	 *
	 * @return void
	 */
	private function shortcode( $post_id, $post_slug ) {
		/*
		 * Retrieves the permalink for a post of a custom post type.
		 * https://developer.wordpress.org/reference/functions/get_post_permalink/
		 */
		$permalink = get_post_permalink();

		$dashicon = '<span class="dashicons dashicons-visibility" style="margin-top:4px;"></span>';

		$shortcode_include = htmlentities( '[includes slug="' . $post_slug . '"]', ENT_QUOTES );
		$html              = "<a href=\"{$permalink}\" target=\"_blank\">{$dashicon}</a> <input type=\"text\" name=\"{$this->posttype}\" value=\"{$shortcode_include}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" />";

		if ( ( includes_fs()->can_use_premium_code() ) ) {
			if ( '1' === $this->get_setting( 'shortcode_code' ) ) {
				$shortcode_code = htmlentities( '[code slug="' . $post_slug . '"]', ENT_QUOTES );
				$html          .= "<br /><a href=\"{$permalink}&type=code\" target=\"_blank\">{$dashicon}</a> <input type=\"text\" name=\"{$this->posttype}_codes\" value=\"{$shortcode_code}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" />";
			}
		}

		/*
		 * Filters text content and strips out disallowed HTML.
		 * https://developer.wordpress.org/reference/functions/wp_kses/
		 */
		echo wp_kses(
			$html,
			array(
				'br'    => true,
				'a'     => array(
					'href'   => true,
					'target' => true,
				),
				'span'  => array(
					'class' => true,
					'style' => true,
				),
				'input' => array(
					'type'    => true,
					'name'    => true,
					'value'   => true,
					'style'   => true,
					'onclick' => true,
				),
			)
		);
	}//end shortcode()
}//end class
