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


// Init Shortcode Filters.
new Shortcode_Filters();

// Register Includes Posttype.
$includes_posttype = new Posttype(
	[
		'posttype'           => INCLUDES_PLUGIN_NAME,
		'plural_name'        => ucfirst( INCLUDES_PLUGIN_NAME ),
		'singular_name'      => ucfirst( INCLUDES_SINGULAR_NAME ),
		'public'             => true,
		'query_var'          => true,
		'publicly_queryable' => true,
		'hierarchical'       => true,
		'capability_type'    => 'page',
		'taxonomies'         => [ INCLUDES_PLUGIN_NAME ],
		'rewrite'            => [ 'slug' => '' ],
		'supports'           => [ 'title', 'editor', 'author', 'revisions', 'custom-fields' ],
	]
);
$includes_posttype->init();

// Register Includes Posttype Template.
$includes_posttype_template = new Posttype_Template(
	[
		'posttype' => INCLUDES_PLUGIN_NAME,
		'template' => plugin_dir_path( INCLUDES_FILE ) . 'templates/posttype-includes.php',
	]
);
$includes_posttype_template->init();

// Start Shortcode Register.
$includes_shortcode_factory = new Factory_Shortcode();

// Register Includes Shortcode.
$includes_shortcode_includes = $includes_shortcode_factory->create(
	'Shortcode_Includes',
	[
		'shortcodes' => [ INCLUDES_SINGULAR_NAME, INCLUDES_PLUGIN_NAME ],
		'posttype'   => INCLUDES_PLUGIN_NAME,
		'taxonomy'   => INCLUDES_PLUGIN_NAME,
	]
);
$includes_shortcode_includes->register();
