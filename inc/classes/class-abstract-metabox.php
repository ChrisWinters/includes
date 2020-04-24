<?php
/**
 * Abstract Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

use Includes\Trait_Exception as TraitException;
use Includes\Trait_Posttype_Key as TraitPosttypeKey;

/**
 * Register Metabox
 */
abstract class Abstract_Metabox {
	use TraitException;
	use TraitPosttypeKey;

	/**
	 * Metabox Slug ID.
	 *
	 * @var string
	 */
	protected $metabox_id;

	/**
	 * Metabox Title Label.
	 *
	 * @var string
	 */
	protected $metabox_title;

	/**
	 * Post Type Slug.
	 *
	 * @var string
	 */
	protected $posttype;

	/**
	 * Custom Content Method Args.
	 *
	 * @var array
	 */
	protected $callback_args = array();


	/**
	 * Setup Class
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args ) {
		$this->setup( $args );

	}//end __construct()


	/**
	 * Register Meta Boxe
	 */
	final public function init() {
		/*
		 * Fires after all built-in meta boxes have been added.
		 * https://developer.wordpress.org/reference/hooks/add_meta_boxes/
		 */
		add_action( 'add_meta_boxes', array( $this, 'register' ) );

	}//end init()


	/**
	 * Set Class Parameters & Initialize Class
	 *
	 * @param array $args Metabox Args.
	 */
	final public function setup( $args = array() ) {
		$this->metabox_id    = $args['metabox_id'];
		$this->metabox_title = $args['metabox_title'];
		$this->posttype      = $this->clean_posttype( $args['posttype'] );
		$this->callback_args = array();

		if ( true !== empty( $args['callback_args'] ) ) {
			$this->callback_args = $args['callback_args'];
		}

		/*
		 * Fires after all built-in meta boxes have been added.
		 * https://developer.wordpress.org/reference/hooks/add_meta_boxes/
		 */
		add_action( 'add_meta_boxes', array( $this, 'register' ) );

		if ( filter_input( INPUT_POST, INCLUDES_SETTING_PREFIX . 'nonce' ) ) {
			/*
			 * Fires once a post has been saved.
			 * https://developer.wordpress.org/reference/hooks/save_post_post-post_type/
			 */
			add_action( 'save_post_' . $this->posttype, array( $this, 'save' ) );
		}

		$this->required_params( $args, array( 'metabox_id', 'metabox_title', 'posttype' ) );

	}//end setup()


	/**
	 * Register Taxonomy
	 *
	 * @return void
	 */
	final public function register() {
		/*
		 * Checks if a post type exists
		 * https://developer.wordpress.org/reference/functions/post_type_exists/
		 */
		if ( true !== post_type_exists( $this->posttype ) ) {
			return;
		}

		/*
		 * Determine if user is a site admin.
		 * https://developer.wordpress.org/reference/functions/is_super_admin/
		 */
		if ( true !== is_super_admin() ) {
			return;
		}

		/*
			* Adds a meta box to one or more screens.
			* https://developer.wordpress.org/reference/functions/add_meta_box/
		*/
		add_meta_box(
			$this->metabox_id,
			$this->metabox_title,
			array(
				$this,
				'content',
			),
			$this->posttype,
			'normal',
			'high',
			$this->callback_args
		);

	}//end register()


	/**
	 * Metabox Content
	 *
	 * @param object $post WordPress Post Object.
	 *
	 * @return html
	 */
	abstract protected function content( $post );


	/**
	 * Save Meta Box Data
	 *
	 * @param object $post_id Current Post ID.
	 *
	 * @return void
	 */
	final public function save( $post_id ) {
		if ( true === defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		/*
		 * Whether the current user has a specific capability.
		 * https://developer.wordpress.org/reference/functions/current_user_can/
		 *
		 * Makes sure that a user was referred from another admin page.
		 * https://developer.wordpress.org/reference/functions/check_admin_referer/
		 */
		if ( false === current_user_can( 'manage_options' ) || false === check_admin_referer( INCLUDES_SETTING_PREFIX . 'action', INCLUDES_SETTING_PREFIX . 'nonce' ) ) {
			/*
			 * Kill WordPress execution and display HTML message with error message.
			 * https://developer.wordpress.org/reference/functions/wp_die/
			 */
			wp_die( esc_html__( 'You are not authorized to perform this action.', 'includes' ) );
		}

		if ( false !== filter_input( INPUT_POST, $this->metabox_id ) ) {
			if ( true === empty( filter_input( INPUT_POST, $this->metabox_id ) ) ) {
				$metabox_data = '';
			} else {
				$metabox_data = htmlentities( stripslashes( filter_input( INPUT_POST, $this->metabox_id ) ) );
			}

			/*
			 * Updates a post meta field based on the given post ID.
			 * https://developer.wordpress.org/reference/functions/update_post_meta/
			 */
			update_post_meta( (int) $post_id, $this->metabox_id, $metabox_data );
		}

	}//end save()

}//end class
