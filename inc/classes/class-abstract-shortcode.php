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

use Includes\Trait_Shortcode_Wp_Query as TraitShortcodeWpQuery;
use Includes\Trait_Option_Manager as TraitOptionManager;
use Includes\Trait_Posttype_Key as TraitPosttypeKey;
use Includes\Trait_Taxonomy_Key as TraitTaxonomyKey;
use Includes\Trait_Exception as TraitException;

/**
 * Shortcode Abstract
 */
abstract class Abstract_Shortcode {
	use TraitShortcodeWpQuery;
	use TraitOptionManager;
	use TraitPosttypeKey;
	use TraitTaxonomyKey;
	use TraitException;


	/**
	 * Shortcode Slugs.
	 *
	 * @var array
	 */
	public $shortcodes = [];

	/**
	 * Post Type Slug.
	 *
	 * @var string
	 */
	public $posttype;

	/**
	 * Taxonomy Slug.
	 *
	 * @var string
	 */
	public $taxonomy;


	/**
	 * Setup Class
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args ) {
		$this->init( $args );
	}//end __construct()


	/**
	 * Set Class Parameters & Initialize Class
	 *
	 * @param array $args Shortcode Args.
	 */
	final public function init( $args = [] ) {
		$this->shortcodes = (array) $args['shortcodes'];
		$this->posttype   = $this->clean_posttype( $args['posttype'] );
		$this->taxonomy   = $this->clean_taxonomy( $args['taxonomy'] );

		$this->required_params( $args, [ 'shortcodes', 'posttype', 'taxonomy' ] );
	}//end init()


	/**
	 * Add Shortcode
	 *
	 * @return void
	 */
	final public function register() {
		foreach ( (array) $this->shortcodes as $shortcode ) {
			/*
			 * Adds a new shortcode
			 * https://developer.wordpress.org/reference/functions/add_shortcode/
			 */
			add_shortcode(
				$shortcode,
				[
					$this,
					'shortcode',
				]
			);
		}
	}//end register()


	/**
	 * Do Shortcode
	 *
	 * @param array  $atts    Shortcode Attributes.
	 * @param string $content Shortcode Content.
	 *
	 * @return void
	 */
	abstract protected function shortcode( $atts = [], $content = null );
}//end class
