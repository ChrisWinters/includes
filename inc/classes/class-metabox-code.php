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

use Includes\Abstract_Metabox as AbstractMetabox;
use Includes\Trait_Option_Manager as TraitOptionManager;

/**
 * WordPress Metabox
 */
final class Metabox_Code extends AbstractMetabox {
	use TraitOptionManager;

	/**
	 * Setup Class
	 *
	 * @param string $args Class Args.
	 */
	public function __construct( $args ) {
		if ( false === $this->get_setting( 'shortcode_code' ) ) {
			return;
		}

		$this->setup( $args );

	}//end __construct()


	/**
	 * Metabox Content
	 *
	 * @param object $post WordPress Post Object.
	 */
	public function content( $post ) {
		/*
		 * Retrieve post meta fields, based on post ID.
		 * https://developer.wordpress.org/reference/functions/get_post_custom/
		 */
		$fields = get_post_custom( $post->ID );

		$content = '';

		if ( true === isset( $fields[ $this->metabox_id ] ) ) {
			$content = html_entity_decode( htmlentities( $fields[ $this->metabox_id ][0] ), ENT_QUOTES | ENT_XML1, 'UTF-8' );
		}

		/*
		 * Retrieve or display nonce hidden field for forms.
		 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
		 */
		wp_nonce_field( INCLUDES_SETTING_PREFIX . 'action', INCLUDES_SETTING_PREFIX . 'nonce' );

		echo wp_kses_post( '<textarea style="height:300px;width:100%;" autocomplete="off" name="' . esc_attr( $this->metabox_id ) . '">' );
		echo filter_var( $content, FILTER_UNSAFE_RAW, FILTER_FLAG_NO_ENCODE_QUOTES );
		echo wp_kses_post( '</textarea>' );

	}//end content()

}//end class
