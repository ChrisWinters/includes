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
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 *
 * Escaping for HTML attributes.
 * https://developer.wordpress.org/reference/functions/esc_attr/
 *
 * Checks and cleans a URL.
 * https://developer.wordpress.org/reference/functions/esc_url/
 *
 * Retrieves the URL for the current site.
 * https://developer.wordpress.org/reference/functions/site_url/
 */
?>
<div class="postbox">
	<div class="h5 p-1 font-weight-bold"><?php esc_html_e( 'Includes for WordPress', 'includes' ); ?></div>
<div class="inside" style="clear:both;padding-top:1px;"><div class="para">

<?php if ( includes_fs()->is_anonymous() ) { ?>
<form enctype="multipart/form-data" method="post" action="">
	<?php
	wp_nonce_field(
		INCLUDES_SETTING_PREFIX . 'action',
		INCLUDES_SETTING_PREFIX . 'nonce'
	);
	?>
<input type="hidden" name="action" value="reconnect" />
<input type="submit" name="submit" value=" <?php esc_html_e( 'Connect To Plugin Services', 'includes' ); ?> " />
</form>
<?php } ?>
	<ul>
<?php if ( includes_fs()->is_not_paying() ) { ?>
		<li class="font-weight-bold">→ <a href="<?php echo esc_url( site_url( 'wp-admin/network' ) ); ?>/edit.php?post_type=includes&page=includes-pricing"><?php esc_html_e( 'Upgrade For Awesome Features!', 'includes' ); ?></a></li>
<?php } ?>
		<li>&bull; <a href="<?php echo esc_url( site_url( 'wp-admin/network' ) ); ?>/edit.php?post_type=includes&page=includes-contact"><?php esc_html_e( 'Contact Support', 'includes' ); ?></a></li>
		<li>&bull; <a href="https://wordpress.org/support/plugin/includes/" target="_blank"><?php esc_html_e( 'WordPress Forum', 'includes' ); ?></a></li>
		<li>&bull; <a href="https://github.com/ChrisWinters/includes" target="_blank"><?php esc_html_e( 'Plugin Home Page', 'includes' ); ?></a></li>
		<li>&bull; <a href="https://github.com/ChrisWinters/includes/issues" target="_blank"><?php esc_html_e( 'Bugs & Feature Requests', 'includes' ); ?></a></li>
	</ul>
</div></div> <!-- end inside-pad & inside -->
</div> <!-- end postbox -->
