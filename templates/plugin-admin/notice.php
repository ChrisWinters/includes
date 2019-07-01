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

if ( false !== $this->get_setting( 'sdk_action' ) ) {
	return;
}

?>
<div class="notice notice-info">
	<form enctype="multipart/form-data" method="post" action="">
	<?php
	wp_nonce_field(
		INCLUDES_SETTING_PREFIX . 'action',
		INCLUDES_SETTING_PREFIX . 'nonce'
	);
	?>
	<input type="hidden" name="action" value="sdk" />
		<p><?php esc_html_e( 'Never miss an important update! Opt-in to our security and feature update notifications, and non-sensitive diagnostic tracking with freemius.', 'includes' ); ?></p>
		<p>
			<button class="button button-primary" role="button" type="submit" name="optin" value="1"><?php esc_html_e( 'Opt-In', 'includes' ); ?></button>
			<a class="button button-secondary" href="#" role="button"><?php esc_html_e( 'Learn More', 'includes' ); ?></a>
			<button class="button button-secondary float-right" role="button" type="submit" name="dismiss" value="1"><?php esc_html_e( 'Dismiss', 'includes' ); ?></button>
		</p>
	</form>
</div>
