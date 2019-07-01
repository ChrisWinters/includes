<?php
/**
 * Manager Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

use Includes\Trait_Query_String as TraitQueryString;

/**
 * Post Type Template Display
 */
final class Posttype_Template {
	use TraitQueryString;

	/**
	 * Post Type Slug.
	 *
	 * @var string
	 */
	public $posttype;

	/**
	 * Path/Template to Include.
	 *
	 * @var string
	 */
	public $template;


	/**
	 * Set Class Parameters
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args = [] ) {
		if ( false === $this->maybe_load_class( $args ) ) {
			return;
		}

		$this->posttype = $args['posttype'];
		$this->template = $args['template'];
	}//end __construct()


	/**
	 * Init Template Filter
	 */
	public function init() {
		/*
		 * Filters the path of the current template before including it.
		 * https://developer.wordpress.org/reference/hooks/template_include/
		 */
		add_filter(
			'template_include',
			[
				$this,
				'template',
			],
			99
		);
	}//end init()


	/**
	 * Check If Class Should Load Or Not
	 *
	 * @param array $args Posttype / Taxonomy slugs.
	 *
	 * @return bool
	 */
	public function maybe_load_class( $args = [] ) {
		if ( false === $this->query_string( 'post' ) ) {
			return false;
		}

		if ( false === $this->query_string( 'post_type' ) ) {
			return false;
		}

		if ( false === isset( $args['posttype'] ) ||
			false === isset( $args['template'] ) ) {
			return false;
		}

		if ( $this->query_string( 'post_type' ) !== $args['posttype'] ) {
			return false;
		}

		return true;
	}//end maybe_load_class()


	/**
	 * Load Template
	 *
	 * @param string $template Template Being Called.
	 *
	 * @return string
	 */
	public function template( $template ) {
		if ( false === $this->maybe_load_template() ) {
			return $template;
		}

		return $this->build_template_path();
	}//end template()


	/**
	 * Check If Template Should Load Or Not
	 *
	 * @return bool
	 */
	public function maybe_load_template() {
		/*
		 * Contains data from the current post in The Loop.
		 * https://codex.wordpress.org/Function_Reference/%24post
		 */
		global $post;

		if ( true === isset( $post->post_type ) &&
			$post->post_type !== $this->posttype ) {
			return false;
		}

		/*
		 * Checks if a post type exists.
		 * https://developer.wordpress.org/reference/functions/post_type_exists/
		 */
		if ( true !== post_type_exists( $this->posttype ) ) {
			return false;
		}

		return true;
	}//end maybe_load_template()


	/**
	 * Build Template Path
	 *
	 * @return string
	 */
	public function build_template_path() {
		$template_basename = basename( $this->template );
		$template_parts    = explode( '-', $template_basename );

		/*
		 * Retrieve the name of the highest priority template file that exists.
		 * https://developer.wordpress.org/reference/functions/locate_template/
		 */
		$user_template = locate_template(
			[
				$template_basename,
				'single-' . $template_parts[1],
			]
		);

		if ( true !== empty( $user_template ) ) {
			return $user_template;
		}

		if ( true === empty( $user_template ) ) {
			return $this->template;
		}
	}//end build_template_path()
}//end class
