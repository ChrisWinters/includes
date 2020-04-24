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

if ( false === isset( $this->export ) ) {
	return;
}

if ( false !== $this->export->data() ) {
	$data = $this->export->data();
} else {
	/*
	 * Translation text for safe use in HTML output.
	 * https://developer.wordpress.org/reference/functions/esc_html__/
	 */
	$data = esc_html__( 'No Settings To Export', 'includes' );
}

/*
 *
 * Retrieve or display nonce hidden field for forms.
 * https://developer.wordpress.org/reference/functions/wp_nonce_field/
 *
 * Escaping for HTML attributes.
 * https://developer.wordpress.org/reference/functions/esc_attr/
 *
 * Escaping for HTML blocks.
 * https://developer.wordpress.org/reference/functions/esc_html/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/_e/
 */
?>
<div class="text-dark font-weight-bold p-0 m-0 h2"><?php esc_html_e( 'Import/Export/Delete Settings', 'includes' ); ?></div>

<p><?php esc_html_e( 'Manage plugin Import & Export data, or view/delete all plugin settings.', 'includes' ); ?></p>

<hr class="hr" />

<h3><?php esc_html_e( 'Exported Settings', 'includes' ); ?></h3>
<p><?php esc_html_e( 'Exported data for Includes plugin settings only.', 'includes' ); ?></p>

<table class="form-table">
<tr>
	<td colspan="2"><textarea name="export" class="large-text code" id="export" rows="3" onclick="this.focus();this.select()"><?php echo wp_kses_post( $data ); ?></textarea></td>
</tr>
</table>

<?php if ( false !== $this->export->data() ) { ?>
	<h3><?php esc_html_e( 'Email Export To:', 'includes' ); ?></h3>
	<p><?php esc_html_e( 'Enter a valid email address to send the exported settings to.', 'includes' ); ?></p>

	<form enctype="multipart/form-data" method="post" action="">
		<?php
			wp_nonce_field(
				INCLUDES_SETTING_PREFIX . 'action',
				INCLUDES_SETTING_PREFIX . 'nonce'
			);

			$includes_user = get_option( 'admin_email' );
		?>
	<input type="hidden" name="action" value="email" />

	<table class="form-table">
	<tr>
		<td><input type="text" name="email" value="<?php echo esc_html( $includes_user ); ?>" id="email" placeholder="email@address.com" /> <input type="submit" name="submit" id="submit" class="button button-dark" value="<?php esc_html_e( 'send email', 'includes' ); ?>"></td>
	</tr>
	</table>

	</form>
<?php } ?>

	<br /><hr /><br />

<h3><?php esc_html_e( 'Import Settings', 'includes' ); ?></h3>
<p><?php esc_html_e( 'Exported data for Includes plugin settings only.', 'includes' ); ?></p>

<form enctype="multipart/form-data" method="post" action="">
<?php
wp_nonce_field(
	INCLUDES_SETTING_PREFIX . 'action',
	INCLUDES_SETTING_PREFIX . 'nonce'
);
?>
<input type="hidden" name="action" value="import" />

<table class="form-table">
<tr>
	<td><textarea name="import" class="large-text code" id="import" rows="3"></textarea></td>
</tr>
</table>

	<div class="textcenter"><?php submit_button( esc_html__( 'import settings', 'includes' ) ); ?></div>

</form>

<br /><hr /><br />

<h3><?php esc_html_e( 'Saved Settings', 'includes' ); ?></h3>
<p><?php esc_html_e( 'A view of all settings saved by the plugin.', 'includes' ); ?></p>

<form>
<table class="form-table">
<?php
foreach ( (array) $this->all_options() as $key => $value ) {
	?>
	<tr>
	<td>
		<label for="<?php echo esc_attr( $key ); ?>"><b><?php echo esc_html( ucfirst( $key ) ); ?></b></label>
	</td><td>
		<input type="text" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>" id="<?php echo esc_attr( $key ); ?>" readonly />
	</td>
	</tr>
	<?php
}
?>
</table>
</form>

<?php
include_once dirname( INCLUDES_FILE ) . '/templates/plugin-admin/cleanup.php';
