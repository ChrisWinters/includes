<?php

/**
 * View Post Type Content
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */
// Include WordPress.
require './wp-blog-header.php';
if ( false === defined( 'ABSPATH' ) ) {
    exit;
}
/*
 * Determines whether the current visitor is a logged in user.
 * https://developer.wordpress.org/reference/functions/is_user_logged_in/
 *
 * Whether the current user has a specific capability.
 * https://developer.wordpress.org/reference/functions/current_user_can/
 *
 * Redirects to another page.
 * https://developer.wordpress.org/reference/functions/wp_redirect/
 *
 * Displays information about the current site.
 * https://developer.wordpress.org/reference/functions/bloginfo/
 */

if ( true !== is_user_logged_in() || true !== current_user_can( 'administrator' ) ) {
    wp_safe_redirect( get_bloginfo( 'url' ) );
    exit;
}

// Required To View.

if ( false === filter_input( INPUT_GET, 'post_type' ) || false === filter_input( INPUT_GET, 'post' ) ) {
    wp_safe_redirect( get_bloginfo( 'url' ) );
    exit;
}

/*
 * Sanitizes a string key.
 * https://developer.wordpress.org/reference/functions/sanitize_key/
 */
$posttype_key = sanitize_key( filter_input(
    INPUT_GET,
    'post_type',
    FILTER_SANITIZE_ENCODED,
    FILTER_FLAG_STRIP_HIGH
) );
$postid = absint( filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT ) );
$includes_plugin_path = str_replace( site_url( '/' ), ABSPATH, plugins_url() ) . '/includes';
if ( true === file_exists( $includes_plugin_path . '/sdk/includes-fs.php' ) ) {
    require $includes_plugin_path . '/sdk/includes-fs.php';
}
/*
 * Checks if a post type exists
 * https://developer.wordpress.org/reference/functions/post_type_exists/
 */

if ( true === post_type_exists( $posttype_key ) ) {
    // Disable W3 Total Cache.
    define( 'DONOTMINIFY', true );
    define( 'DONOTCDN', true );
    define( 'DONOTCACHCEOBJECT', true );
    /*
     * Sets the display status of the admin bar.
     * https://developer.wordpress.org/reference/functions/show_admin_bar/
     */
    add_filter( 'show_admin_bar', '__return_false' );
    show_admin_bar( false );
    /*
     * Replaces double line-breaks with paragraph elements.
     * https://developer.wordpress.org/reference/functions/wpautop/
     */
    remove_filter( 'the_content', 'wpautop' );
    /*
     * Displays the language attributes for the html tag.
     * https://developer.wordpress.org/reference/functions/language_attributes/
     *
     * Displays information about the current site.
     * https://developer.wordpress.org/reference/functions/bloginfo/
     *
     * Displays the language attributes for the html tag.
     * https://developer.wordpress.org/reference/functions/language_attributes/
     *
     * Displays information about the current site.
     * https://developer.wordpress.org/reference/functions/bloginfo/
     *
     * Fire the wp_head action.
     * https://developer.wordpress.org/reference/functions/wp_head/
     *
     * Displays the class names for the body element.
     * https://developer.wordpress.org/reference/functions/body_class/
     */
    ?>
	<!DOCTYPE html>
	<html <?php 
    language_attributes();
    ?> class="no-js no-svg">
	<head>
		<title></title>
	<meta charset="<?php 
    bloginfo( 'charset' );
    ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php 
    wp_head();
    ?>
	</head>
	<body <?php 
    body_class();
    ?>>
		<?php 
    /*
     * Filters the post content.
     * https://developer.wordpress.org/reference/hooks/the_content/
     *
     * Retrieve data from a post field based on post ID
     * https://developer.wordpress.org/reference/functions/get_post_field/
     */
    $html = apply_filters( 'the_content', get_post_field( 'post_content', $postid ) );
    /*
     * Search content for shortcodes and filter shortcodes through their hooks
     * https://developer.wordpress.org/reference/functions/do_shortcode/
     */
    echo  do_shortcode( $html ) ;
    /*
     * Fire the wp_footer action.
     * https://developer.wordpress.org/reference/functions/wp_footer/
     */
    wp_footer();
    ?>
	</body>
	</html>
	<?php 
}

//end if