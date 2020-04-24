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

use Includes\Trait_Posttype_Key as TraitPosttypeKey;
use Includes\Trait_Query_String as TraitQueryString;

/**
 * Inject Query String Into Custom Post Type Permalinks
 */
final class Posttype_Permalinks {
	use TraitPosttypeKey;
	use TraitQueryString;

	/**
	 * Post Type Name Key.
	 *
	 * @var string
	 */
	protected $posttype;


	/**
	 * Set Class Parameters & Hook WordPress
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args = array() ) {
		// List View.
		if ( $this->query_string( 'post_type' ) === INCLUDES_PLUGIN_NAME ) {
			$this->posttype = $this->clean_posttype( $args['posttype'] );
		}

		// Add/Edit View.
		if ( 'edit' === $this->query_string( 'action' ) ) {
			$self = filter_input( INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL );

			if ( 'post.php' === basename( wp_unslash( $self ) ) ) {
				$this->posttype = $this->clean_posttype( $args['posttype'] );
			}
		}

	}//end __construct()


	/**
	 * Init Post Type Permalink
	 */
	public function init() {
		if ( false === isset( $this->posttype ) ) {
			return;
		}

		/*
		 * Filters the path of the current template before including it
		 * https://developer.wordpress.org/reference/hooks/template_include/
		 */
		add_filter(
			'post_type_link',
			array(
				$this,
				'permalink',
			),
			10,
			2
		);

	}//end init()


	/**
	 * Modify Permalink Query String
	 *
	 * @param string $permalink   Current Permalink URL.
	 * @param string $post_object Current Post Object.
	 */
	public function permalink( $permalink, $post_object ) {
		/*
		 * Retrieves the post type of the current post or of a given post.
		 * https://developer.wordpress.org/reference/functions/get_post_type/
		 */
		if ( get_post_type( $post_object ) === $this->posttype ) {
			$get_query_string = filter_input_array( INPUT_GET, FILTER_SANITIZE_STRING );

			if ( true === isset( $get_query_string['action'] ) ) {
				// Admin Edit Permalink View.
				$add_query_string = array( 'post_type' => $this->posttype );
			} else {
				// Website Front End View.
				$add_query_string = array( 'post' => $post_object->ID );
			}

			$query_array = array_merge( $get_query_string, $add_query_string );

			/*
			 * Retrieves a modified URL query string
			 * https://developer.wordpress.org/reference/functions/add_query_arg/
			 */
			return add_query_arg( $query_array, $permalink );
		}//end if

		return $permalink;

	}//end permalink()

}//end class
