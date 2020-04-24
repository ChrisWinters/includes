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
	// Loads Translated Strings.
	$includes_translate = new \Includes\Translate();

	if ( ( includes_fs()->can_use_premium_code() ) ) {
		// Inject Includes Taxonomy Metaboxes.
		$includes_taxonomy_meta = new Taxonomy_Meta(
			array(
				'taxonomy' => INCLUDES_PLUGIN_NAME,
			)
		);
		$includes_taxonomy_meta->init();
	}


	// Inject Posttype Columns.
	$includes_taxonomy_columns = new Posttype_Columns(
		array(
			'posttype'  => INCLUDES_PLUGIN_NAME,
			'taxonomy'  => INCLUDES_PLUGIN_NAME,
			'shortcode' => INCLUDES_PLUGIN_NAME,
		)
	);
	$includes_taxonomy_columns->init();


	// Save Plugin Admin Data.
	$includes_plugin_admin_save = new Plugin_Admin_Save();
	$includes_plugin_admin_save->init();


	// Display Plugin Admin.
	$includes_plugin_admin = new Plugin_Admin();
	$includes_plugin_admin->init();


	if ( ( includes_fs()->can_use_premium_code() ) ) {
		// Inject Codes Taxonomy Metaboxes.
		$includes_metabox_code = new Metabox_Code(
			array(
				'metabox_id'    => INCLUDES_SETTING_PREFIX . 'code',
				'metabox_title' => __( 'Includes Code ( php, jquery, etc )', 'includes' ),
				'posttype'      => INCLUDES_PLUGIN_NAME,
				'screen'        => INCLUDES_PLUGIN_NAME,
			)
		);
		$includes_metabox_code->init();
	}


	// Inject Custom Includes Permalinks.
	$includes_posttype_permalinks = new Posttype_Permalinks(
		array(
			'posttype' => INCLUDES_PLUGIN_NAME,
		)
	);
	$includes_posttype_permalinks->init();
}
