<?php

/**
 * Public Facing Class Instances
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
 * Determines whether the current request is for an administrative interface page.
 * https://developer.wordpress.org/reference/functions/is_admin/
 */

if ( true === is_admin() ) {
    // Inject Posttype Columns.
    $includes_taxonomy_columns = new Posttype_Columns( [
        'posttype'  => INCLUDES_PLUGIN_NAME,
        'taxonomy'  => INCLUDES_PLUGIN_NAME,
        'shortcode' => INCLUDES_PLUGIN_NAME,
    ] );
    $includes_taxonomy_columns->init();
    // Save Plugin Admin Data.
    $includes_plugin_admin_save = new Plugin_Admin_Save();
    $includes_plugin_admin_save->init();
    // Display Plugin Admin.
    $includes_plugin_admin = new Plugin_Admin();
    $includes_plugin_admin->init();
    // Inject Custom Includes Permalinks.
    $includes_posttype_permalinks = new Posttype_Permalinks( [
        'posttype' => INCLUDES_PLUGIN_NAME,
    ] );
    $includes_posttype_permalinks->init();
}
