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
 * Display translated text that has been escaped for safe use in HTML output.
 * https://developer.wordpress.org/reference/functions/esc_html_e/
 */
?>
<div class="wrap">
<h2><span class="dashicons dashicons-info mt-1 pt-1"></span> <?php esc_html_e( 'Includes for WordPress', 'includes' ); ?> &#8594; <small><?php esc_html_e( 'Include Content Anywhere!', 'includes' ); ?></small></h2>


<?php
require_once dirname( INCLUDES_FILE ) . '/templates/plugin-admin/notice.php';

/*
 * Sanitizes content for allowed HTML tags for post content.
 * https://developer.wordpress.org/reference/functions/wp_kses_post/
 */
echo wp_kses_post( $this->tabs() );
?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-1"><div id="post-body-content">
<div class="postbox"><div class="inside">
