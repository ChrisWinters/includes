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

use Includes\Trait_Posttype_Key as TraitPosttypeKey;

/**
 * Register Post Type
 */
final class Posttype {
	use TraitPosttypeKey;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $posttype;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $plural_name;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $singular_name;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $public;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $exclude_from_search;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $publicly_queryable;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $show_ui;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $show_in_menu;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $show_in_nav_menus;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $show_in_admin_bar;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $map_meta_cap;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $query_var;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $show_in_rest;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $rest_base;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $has_archive;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $hierarchical;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $menu_position;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $capability_type;

	/**
	 * Posttype Args.
	 *
	 * @var string
	 */
	protected $menu_icon;

	/**
	 * Posttype Args.
	 *
	 * @var array
	 */
	protected $taxonomies = [];

	/**
	 * Posttype Args.
	 *
	 * @var array
	 */
	protected $supports = [];

	/**
	 * Posttype Args.
	 *
	 * @var array
	 */
	protected $rewrite = [];


	/**
	 * Set Class Parameters
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args = [] ) {
		$this->posttype      = $this->clean_posttype( $args['posttype'] );
		$this->plural_name   = $args['plural_name'];
		$this->singular_name = $args['singular_name'];

		// Defaults.
		$this->public              = false;
		$this->show_in_nav_menus   = true;
		$this->exclude_from_search = true;
		$this->publicly_queryable  = false;
		$this->show_ui             = true;
		$this->show_in_menu        = true;
		$this->show_in_admin_bar   = false;
		$this->map_meta_cap        = true;
		$this->query_var           = false;
		$this->show_in_rest        = true;
		$this->rest_base           = false;
		$this->has_archive         = false;
		$this->hierarchical        = false;
		$this->menu_position       = 26;
		$this->capability_type     = 'post';
		$this->menu_icon           = 'dashicons-info';
		$this->taxonomies          = [];
		$this->supports            = [
			'title',
			'editor',
			'author',
			'revisions',
			'thumbnail',
			'title',
			'editor',
			'comments',
			'revisions',
			'trackbacks',
			'author',
			'excerpt',
			'page-attributes',
			'thumbnail',
			'custom-fields',
			'post-formats',
		];

		$this->rewrite = [
			'slug'       => $this->posttype,
			'with_front' => false,
		];

		if ( true === isset( $args['public'] ) ) {
			$this->public = (bool) $args['public'];
		}

		if ( true === isset( $args['show_in_nav_menus'] ) ) {
			$this->show_in_nav_menus = (bool) $args['show_in_nav_menus'];
		}

		if ( true === isset( $args['exclude_from_search'] ) ) {
			$this->exclude_from_search = (bool) $args['exclude_from_search'];
		}

		if ( true === isset( $args['publicly_queryable'] ) ) {
			$this->publicly_queryable = (bool) $args['publicly_queryable'];
		}

		if ( true === isset( $args['show_ui'] ) ) {
			$this->show_ui = (bool) $args['show_ui'];
		}

		if ( true === isset( $args['show_in_menu'] ) ) {
			$this->show_in_menu = (bool) $args['show_in_menu'];
		}

		if ( true === isset( $args['show_in_admin_bar '] ) ) {
			$this->show_in_admin_bar = (bool) $args['show_in_admin_bar '];
		}

		if ( true === isset( $args['map_meta_cap '] ) ) {
			$this->map_meta_cap = (bool) $args['map_meta_cap '];
		}

		if ( true === isset( $args['query_var'] ) ) {
			$this->query_var = (bool) $args['query_var'];
		}

		if ( true === isset( $args['show_in_rest'] ) ) {
			$this->show_in_rest = (bool) $args['show_in_rest'];
		}

		if ( true === isset( $args['rest_base'] ) ) {
			$this->rest_base = (bool) $args['rest_base'];
		}

		if ( true === isset( $args['has_archive'] ) ) {
			$this->has_archive = (bool) $args['has_archive'];
		}

		if ( true === isset( $args['hierarchical'] ) ) {
			$this->hierarchical = (bool) $args['hierarchical'];
		}

		if ( true === isset( $args['menu_position'] ) ) {
			$this->menu_position = (int) $args['menu_position'];
		}

		if ( true === isset( $args['capability_type'] ) ) {
			$this->capability_type = esc_attr( $args['capability_type'] );
		}

		if ( true === isset( $args['menu_icon'] ) ) {
			$this->menu_icon = esc_attr( $args['cmenu_icon'] );
		}

		if ( true !== empty( $args['taxonomies'] ) ) {
			$this->taxonomies = (array) $args['taxonomies'];
		}

		if ( true !== empty( $args['supports'] ) ) {
			$this->supports = (array) $args['supports'];
		}

		if ( true !== empty( $args['rewrite'] ) ) {
			$this->rewrite = (array) $args['rewrite'];
		}
	}//end __construct()


	/**
	 * Init Class Action
	 *
	 * @return void
	 */
	public function init() {
		/*
		 * Fires after WordPress has finished loading but before any headers are sent.
		 * https://developer.wordpress.org/reference/hooks/init/
		 */
		add_action( 'init', [ $this, 'register' ] );
	}//end init()


	/**
	 * Register Post Type
	 *
	 * @return void
	 */
	public function register() {
		/*
		 * Checks if a post type exists
		 * https://developer.wordpress.org/reference/functions/post_type_exists/
		 */
		if ( true === post_type_exists( $this->posttype ) ) {
			return;
		}

		/*
		 * Register Post Type
		 * https://developer.wordpress.org/reference/functions/register_post_type/
		 * https://developer.wordpress.org/reference/functions/get_post_typelabels/
		 */
		register_post_type( $this->posttype, $this->args() );
	}//end register()


	/**
	 * Build Post Type Args
	 *
	 * @return array
	 */
	public function args() {
		return [
			'public'              => $this->public,
			'show_in_nav_menus'   => $this->show_in_nav_menus,
			'exclude_from_search' => $this->exclude_from_search,
			'publicly_queryable'  => $this->publicly_queryable,
			'show_ui'             => $this->show_ui,
			'show_in_menu'        => $this->show_in_menu,
			'show_in_admin_bar'   => $this->show_in_admin_bar,
			'map_meta_cap'        => $this->map_meta_cap,
			'query_var'           => $this->query_var,
			'show_in_rest'        => $this->show_in_rest,
			'rest_base'           => $this->rest_base,
			'has_archive'         => $this->has_archive,
			'hierarchical'        => $this->hierarchical,
			'menu_position'       => $this->menu_position,
			'capability_type'     => $this->capability_type,
			'menu_icon'           => $this->menu_icon,
			'taxonomies'          => $this->taxonomies,
			'supports'            => $this->supports,
			'rewrite'             => $this->rewrite,
			'labels'              => $this->labels(),
		];
	}//end args()


	/**
	 * Build Post Type Labels Args
	 *
	 * @return array
	 */
	public function labels() {
		/*
		 * Escaping for HTML blocks.
		 * https://developer.wordpress.org/reference/functions/esc_html/
		 *
		 * Retrieve the translation of $text.
		 * https://developer.wordpress.org/reference/functions/__/
		 */
		return [
			'name'                  => esc_html( $this->plural_name ),
			'singular_name'         => esc_html( $this->plural_name ),
			'menu_name'             => esc_html( $this->plural_name ),
			'name_admin_bar'        => esc_html( $this->plural_name ),
			'add_new'               => esc_html__( 'Add New', 'includes' ),
			/* Translators: %s Plugin Singular Name. */
			'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'new_item'              => sprintf( esc_html__( 'New %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Plural Name. */
			'edit_item'             => sprintf( esc_html__( 'Edit %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'view_item'             => sprintf( esc_html__( 'View %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'all_items'             => sprintf( esc_html__( 'View %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'search_items'          => sprintf( esc_html__( 'Search %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'parent_item_colon'     => sprintf( esc_html__( 'Parent %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'not_found'             => sprintf( esc_html__( 'No %s To Display', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'not_found_in_trash'    => sprintf( esc_html__( 'No %s Found in Trash', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Singular Name. */
			'archives'              => sprintf( esc_html__( '%s Archives', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'attributes'            => sprintf( esc_html__( '%s Attributes', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'items_list'            => sprintf( esc_html__( '%s List', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'items_list_navigation' => sprintf( esc_html__( '%s List Navigation', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Plural Name. */
			'insert_into_item'      => sprintf( esc_html__( 'Insert Into %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Plural Name. */
			'filter_items_list'     => sprintf( esc_html__( 'Filter %s', 'includes' ), $this->plural_name ),
		];
	}//end labels()
}//end class
