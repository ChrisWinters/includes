<?php
/**
 * Plugin Admin Template
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 *
 * Escaping for HTML blocks.
 * https://developer.wordpress.org/reference/functions/esc_html/
 *
 * Escaping for HTML attributes.
 * https://developer.wordpress.org/reference/functions/esc_attr/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 *
 * Outputs the html checked attribute.
 * https://developer.wordpress.org/reference/functions/checked/
 *
 * Echoes a submit button, with provided text and appropriate class( es ).
 * https://developer.wordpress.org/reference/functions/submit_button/
 */
?>
<div class="text-dark font-weight-bold p-0 m-0 h2"><?php esc_html_e( 'Plugin Settings', 'includes' ); ?></div>

<p><?php esc_html_e( 'Enable and Disable Plugin Features.', 'includes' ); ?></p>

<hr class="hr" />

<form enctype="multipart/form-data" method="post" action="">
<?php
wp_nonce_field(
	INCLUDES_SETTING_PREFIX . 'action',
	INCLUDES_SETTING_PREFIX . 'nonce'
);
?>
<input type="hidden" name="action" value="update" />

<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
<table class="form-table">
	<tbody>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Display Shortcodes on Category Term Pages', 'includes' ); ?></label></th>
		<td><input type="radio" name="shortcode_terms" value="1" id="enable_shortcode_terms" <?php checked( $this->get_setting( 'shortcode_terms' ), '1' ); ?>/> <label for="enable_shortcode_terms"><?php esc_html_e( 'Enable', 'includes' ); ?></label> <input type="radio" name="shortcode_terms" value="default" id="disable_shortcode_terms" <?php checked( $this->get_setting( 'shortcode_terms' ), '' ); ?> /> <label for="disable_shortcode_terms"><?php esc_html_e( 'Disable', 'includes' ); ?></label><p class="description"><?php esc_html_e( 'Adds shortcode input boxes to category terms assigned to the includes post type. To view: Includes > Categories > Edit - to view the shortcode( s ).', 'includes' ); ?></p></td>
		</tr>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Enable [code] Shortcode', 'includes' ); ?></label></th>
		<td><input type="radio" name="shortcode_code" value="1" id="enable_shortcode_code" <?php checked( $this->get_setting( 'shortcode_code' ), '1' ); ?>/> <label for="enable_shortcode_code"><?php esc_html_e( 'Enable', 'includes' ); ?></label> <input type="radio" name="shortcode_code" value="default" id="disable_shortcode_code" <?php checked( $this->get_setting( 'shortcode_code' ), '' ); ?> /> <label for="disable_shortcode_code"><?php esc_html_e( 'Disable', 'includes' ); ?></label><p class="description"><?php esc_html_e( ' Enables custom shortcode [code] and adds "code/script" editor box below main Includes editor. Supports PHP, Bash, jQuery, JavaScript, etc. WARNING: The code you enter into "code" editor is raw unfiltered data for both input and output!!!', 'includes' ); ?></p></td>
		</tr>
	</tbody>
</table>

<hr class="my-4 w-75" />
<?php } ?>

<table class="form-table">
	<tbody>
<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Allow Posts & Pages to use [includes] Shortcode', 'includes' ); ?></label></th>
		<td><input type="radio" name="shortcode_posts_pages" value="1" id="enable_shortcode_posts_pages" <?php checked( $this->get_setting( 'shortcode_posts_pages' ), '1' ); ?>/> <label for="enable_shortcode_posts_pages"><?php esc_html_e( 'Enable', 'includes' ); ?></label> <input type="radio" name="shortcode_posts_pages" value="default" id="disable_shortcode_posts_pages" <?php checked( $this->get_setting( 'shortcode_posts_pages' ), '' ); ?> /> <label for="disable_shortcode_posts_pages"><?php esc_html_e( 'Disable', 'includes' ); ?></label><p class="description"><?php esc_html_e( 'Use the slug from any published post/page to automatically include the content.', 'includes' ); ?></p></td>
		</tr>
<?php } ?>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Shortcodes in Post/Page Titles', 'includes' ); ?></label></th>
		<td><input type="radio" name="shortcode_post_titles" value="1" id="enable_shortcode_post_titles" <?php checked( $this->get_setting( 'shortcode_post_titles' ), '1' ); ?>/> <label for="enable_shortcode_post_titles"><?php esc_html_e( 'Enable', 'includes' ); ?></label> <input type="radio" name="shortcode_post_titles" value="default" id="disable_shortcode_post_titles" <?php checked( $this->get_setting( 'shortcode_post_titles' ), '' ); ?> /> <label for="disable_shortcode_post_titles"><?php esc_html_e( 'Disable', 'includes' ); ?></label><p class="description"><?php esc_html_e( 'Any shortcode can be used in post/page titles once enabled.', 'includes' ); ?></p></td>
		</tr>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Shortcodes in Menus', 'includes' ); ?></label></th>
		<td><input type="radio" name="shortcode_menus" value="1" id="enable_shortcode_menus" <?php checked( $this->get_setting( 'shortcode_menus' ), '1' ); ?>/> <label for="enable_shortcode_menus"><?php esc_html_e( 'Enable', 'includes' ); ?></label> <input type="radio" name="shortcode_menus" value="default" id="disable_shortcode_menus" <?php checked( $this->get_setting( 'shortcode_menus' ), '' ); ?> /> <label for="disable_shortcode_menus"><?php esc_html_e( 'Disable', 'includes' ); ?></label><p class="description"><?php esc_html_e( 'Any shortcode can be used in menus once enabled.', 'includes' ); ?></p></td>
		</tr>
		<tr>
		<th scope="row"><label><?php esc_html_e( 'Shortcodes in Widget Titles', 'includes' ); ?></label></th>
		<td><input type="radio" name="shortcode_widget_titles" value="1" id="enable_shortcode_widget_titles" <?php checked( $this->get_setting( 'shortcode_widget_titles' ), '1' ); ?>/> <label for="enable_shortcode_widget_titles"><?php esc_html_e( 'Enable', 'includes' ); ?></label> <input type="radio" name="shortcode_widget_titles" value="default" id="disable_shortcode_widget_titles" <?php checked( $this->get_setting( 'shortcode_widget_titles' ), '' ); ?> /> <label for="disable_shortcode_widget_titles"><?php esc_html_e( 'Disable', 'includes' ); ?></label><p class="description"><?php esc_html_e( 'Any shortcode can be used in menus once enabled.', 'includes' ); ?></p></td>
		</tr>
		<tr>
		<td colspan="2"><p class="description"><?php esc_html_e( 'Note: By default WordPress automatically parses shortcodes within text widgets.', 'includes' ); ?></p></td>
		</tr>
	</tbody>
</table>

	<div class="textcenter"><?php submit_button( esc_html__( 'update settings', 'includes' ) ); ?></div>

</form>

<?php
if ( ! includes_fs()->can_use_premium_code() ) {
	include_once dirname( INCLUDES_FILE ) . '/templates/plugin-admin/cleanup.php';
}
