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
 * Escaping for HTML blocks.
 * https://developer.wordpress.org/reference/functions/esc_html/
 *
 * Checks and cleans a URL.
 * https://developer.wordpress.org/reference/functions/esc_url/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/_e/
 */

?>
</div></div><!-- .postbox & inside -->
</div><!-- .post-body-content -->

<div id="postbox-container-1" class="postbox-container"><?php require_once dirname( INCLUDES_FILE ) . '/templates/plugin-admin/sidebar.php'; ?></div>

<br class="clear" />
</div></div><!-- .poststuff and post-body -->
	<div class="clearfix">
		<div class="float-left text-left"><small>&#9829; <?php esc_html_e( 'Includes for WordPress', 'includes' ); ?></small></div>
		<div class="float-right text-right"><a href="#top"><span class="dashicons-before dashicons-arrow-up"><?php esc_html_e( 'top', 'includes' ); ?></span></a></div>
	</div>
</div><!-- .wrap -->

<br class="clear" />
