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
use Includes\Trait_Taxonomy_Key as TraitTaxonomyKey;

/**
 * Register Taxonomy
 */
final class Taxonomy {
	use TraitPosttypeKey;
	use TraitTaxonomyKey;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $taxonomy;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $posttype;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $plural_name;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $singular_name;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $hierarchical;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $show_ui;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $query_var;

	/**
	 * Taxonomy Arg.
	 *
	 * @var string
	 */
	protected $show_admin_column;

	/**
	 * Taxonomy Arg.
	 *
	 * @var array
	 */
	protected $rewrite = array();


	/**
	 * Set Class Parameters
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args = array() ) {
		$this->taxonomy = $this->clean_taxonomy( $args['taxonomy'] );
		$this->posttype = $this->clean_posttype( $args['posttype'] );

		/*
		 * Retrieve the translation of $text.
		 * https://developer.wordpress.org/reference/functions/__/
		 */
		$this->plural_name       = __( 'Categories', 'includes' );
		$this->singular_name     = __( 'Category', 'includes' );
		$this->hierarchical      = true;
		$this->show_ui           = true;
		$this->query_var         = true;
		$this->show_admin_column = false;
		$this->rewrite           = array(
			'slug' => $this->taxonomy,
		);

		if ( true === isset( $args['plural_name'] ) ) {
			$this->plural_name = $args['plural_name'];
		}

		if ( true === isset( $args['singular_name'] ) ) {
			$this->singular_name = $args['singular_name'];
		}

		if ( true === isset( $args['hierarchical'] ) ) {
			$this->hierarchical = (bool) $args['hierarchical'];
		}

		if ( true === isset( $args['show_ui'] ) ) {
			$this->show_ui = (bool) $args['show_ui'];
		}

		if ( true === isset( $args['query_var'] ) ) {
			$this->query_var = (bool) $args['query_var'];
		}

		if ( true === isset( $args['show_admin_column'] ) ) {
			$this->show_admin_column = (bool) $args['show_admin_column'];
		}

		if ( true !== empty( $args['rewrite'] ) ) {
			$this->rewrite = (array) $args['rewrite'];
		}

	}//end __construct()


	/**
	 * Init Taxonomy Action
	 *
	 * @return void
	 */
	public function init() {
		/*
		 * Fires after WordPress has finished loading but before any headers are sent.
		 * https://developer.wordpress.org/reference/hooks/init/
		 */
		add_action( 'init', array( $this, 'register' ) );

	}//end init()


	/**
	 * Register Taxonomy
	 *
	 * @return void
	 */
	public function register() {
		/*
		 * Determines whether the taxonomy name exists.
		 * https://developer.wordpress.org/reference/functions/taxonomy_exists/
		 */
		if ( true === taxonomy_exists( $this->taxonomy ) ) {
			return;
		}

		/*
		 * Creates or modifies a taxonomy object.
		 * https://developer.wordpress.org/reference/functions/register_taxonomy/
		 */
		register_taxonomy( $this->taxonomy, array( $this->posttype ), $this->args() );

	}//end register()


	/**
	 * Build Taxonomy Args
	 *
	 * @return array
	 */
	public function args() {
		return array(
			'hierarchical'      => $this->hierarchical,
			'show_ui'           => $this->show_ui,
			'query_var'         => $this->query_var,
			'show_admin_column' => $this->show_admin_column,
			'rewrite'           => $this->rewrite,
			'labels'            => $this->labels(),
		);

	}//end args()


	/**
	 * Build Taxonomy Labels Args
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
		return array(
			'name'              => esc_html( $this->plural_name ),
			'singular_name'     => esc_html( $this->singular_name ),
			/* Translators: %s Plugin Plural Name. */
			'search_items'      => sprintf( esc_html__( 'Search %s', 'includes' ), $this->plural_name ),
			/* Translators: %s Plugin Singular Name. */
			'all_items'         => sprintf( esc_html__( 'All %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'parent_item'       => sprintf( esc_html__( 'Parent %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'edit_item'         => sprintf( esc_html__( 'Edit %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'update_item'       => sprintf( esc_html__( 'Update %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Singular Name. */
			'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'includes' ), $this->singular_name ),
			/* Translators: %s Plugin Plural Name. */
			'menu_name'         => esc_html( $this->plural_name ),
		);

	}//end labels()

}//end class
