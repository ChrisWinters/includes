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
?>
<br /><br />

<hr class="hr" />
<hr class="hr" />

<form enctype="multipart/form-data" method="post" action="">
<?php
wp_nonce_field(
	INCLUDES_SETTING_PREFIX . 'action',
	INCLUDES_SETTING_PREFIX . 'nonce'
);
?>
<input type="hidden" name="action" value="delete" />

	<div class="textright">
		<p class="submit">
			<input type="submit" name="submit" value=" <?php esc_html_e( 'delete all settings', 'includes' ); ?> " class="button button-secondary" onclick="return confirm(  'Are You Sure?'  );" />
		</p>
	</div>

</form>
