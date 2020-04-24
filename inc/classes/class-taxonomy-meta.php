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
use Includes\Trait_Query_String as TraitQueryString;
use Includes\Trait_Taxonomy_Key as TraitTaxonomyKey;

/**
 * Taxonomy Meta Injector
 */
final class Taxonomy_Meta {
	use TraitOptionManager;
	use TraitQueryString;
	use TraitTaxonomyKey;

	/**
	 * Taxonomy Slug.
	 *
	 * @var string
	 */
	protected $taxonomy;

	/**
	 * Shortcode Slug.
	 *
	 * @var string
	 */
	protected $shortcode;


	/**
	 * Set Class Parameters
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args = array() ) {
		$taxonomy = $this->query_string( 'taxonomy' );

		if ( true === empty( $taxonomy ) ) {
			return;
		}

		$this->taxonomy = $this->clean_taxonomy( $args['taxonomy'] );

	}//end __construct()


	/**
	 * Init Meta Action
	 */
	public function init() {
		/*
		 * Fires after WordPress has finished loading but before any headers are sent.
		 * https://developer.wordpress.org/reference/hooks/init/
		 */
		add_action( 'init', array( $this, 'register' ) );

	}//end init()


	/**
	 * Register Taxonomy Meta
	 */
	public function register() {
		if ( false === $this->get_setting( 'shortcode_terms' ) ) {
			return;
		}

		/*
			* Determines whether the taxonomy name exists.
			* https://developer.wordpress.org/reference/functions/taxonomy_exists/
		*/
		if ( true !== taxonomy_exists( $this->taxonomy ) ) {
			return;
		}

		/*
		 * Fires after the Edit Term form fields are displayed.
		 * https://developer.wordpress.org/reference/hooks/taxonomy_edit_form_fields/
		 */
		add_action(
			$this->taxonomy . '_edit_form_fields',
			array(
				$this,
				'display',
			),
			10,
			1
		);

	}//end register()


	/**
	 * Display Form Input( s )
	 *
	 * @param object $term_object Taxonomy Term Object.
	 */
	public function display( $term_object ) {
		if ( true === empty( $term_object ) || true === empty( $term_object->slug ) ) {
			return;
		}

		/*
		 * Escaping for HTML attributes.
		 * https://developer.wordpress.org/reference/functions/esc_attr/
		 */

		$include_shortcode = htmlentities( '[includes category="' . esc_attr( $term_object->slug ) . '"]', ENT_QUOTES );
		$code_shortcode    = htmlentities( '[code category="' . esc_attr( $term_object->slug ) . '"]', ENT_QUOTES );

		/*
		 * Retrieves information about the current site.
		 * https://developer.wordpress.org/reference/functions/get_bloginfo/
		 */

		// Link To Tags Documents.
		$plugin_docs_url = get_bloginfo( 'url' ) .
		'/wp-admin/edit.php?post_type=' .
		INCLUDES_PLUGIN_NAME . '&page=' .
		INCLUDES_PLUGIN_NAME . '&tab=documents#atts';

		/*
		 * Display translated text.
		 * https://developer.wordpress.org/reference/functions/esc_html_e/
		 *
		 * Escaping for HTML blocks.
		 * https://developer.wordpress.org/reference/functions/esc_html/
		 *
		 * Checks and cleans a URL.
		 * https://developer.wordpress.org/reference/functions/esc_url/
		 */
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="term_meta[include_shortcode]"><?php esc_html_e( 'Includes Shortcode', 'includes' ); ?></label>
			</th>
			<td>
				<input type="text" name="" id="term_meta[include_shortcode]" value="<?php echo esc_html( $include_shortcode ); ?>" />
				<?php if ( '1' === $this->get_setting( 'shortcode_code' ) ) { ?>
					<br /><input type="text" name="" id="term_meta[code_shortcode]" value="<?php echo esc_html( $code_shortcode ); ?>" />
				<?php } ?>
				<p class="description">&bull; <a href="<?php echo esc_url( $plugin_docs_url ); ?>"><?php esc_html_e( 'Shortcode Attributes', 'includes' ); ?></a></p>
			</td>
		</tr>
		<?php

	}//end display()

}//end class
