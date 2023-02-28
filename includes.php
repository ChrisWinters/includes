<?php

/**
 * Plugin Name: Includes
 * Plugin URI: https://github.com/ChrisWinters/includes
 * Description: Includes for WordPress - Include Content Anywhere!
 * Version: 4.1.1
 * License: GNU GPLv3
 * Author: Chris Winters
 * Text Domain: includes
 * Author URI: https://github.com/ChrisWinters
 * Copyright ( c ) 2014-2023 Chris Winters.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

// Require plugin settings.
require_once __DIR__.'/inc/settings.php';

// Require allowed plugin functions.
foreach ((array) \Includes\settings('files') as $file) {
    require_once __DIR__.'/inc/functions/'.$file;
}

// Init backend plugin features.
\add_action(
    'plugins_loaded',
    '\Includes\loadBackend'
);

// Init global plugin features.
\add_action(
    'init',
    '\Includes\initPlugin'
);

/**
 * Load backend plugin features.
 */
function loadBackend(): void
{
    if (false === \is_admin()) {
        return;
    }

    // Load plugin menu and admin area templates.
    \add_action(
        'admin_menu',
        '\Includes\PluginAdmin\View\displayAdmin'
    );

    // Enqueue plugin admin area stylesheet.
    \add_action(
        'admin_enqueue_scripts',
        '\Includes\PluginAdmin\View\enqueueScripts'
    );

    // Update plugin settings.
    \add_action(
        'admin_post_update',
        '\Includes\PluginAdmin\Post\actions'
    );

    // Add MetaBoxes.
    \add_action(
        'add_meta_boxes',
        'Includes\PluginAdmin\MetaBox\add'
    );

    // Save code MetaBox data.
    \add_action(
        'save_post_includes',
        '\Includes\PluginAdmin\MetaBox\save',
    );

    // Modify post type columns.
    \add_filter(
        'manage_includes_posts_columns',
        '\Includes\PluginAdmin\PostType\modifyColumns',
        10,
        1
    );

    // Inject custom post type column content.
    \add_action(
        'manage_includes_posts_custom_column',
        '\Includes\PluginAdmin\PostType\columnContent',
        10,
        2
    );

    \add_action(
        'includes_edit_form_fields',
        '\Includes\PluginAdmin\Taxonomy\formField',
        10,
        1
    );

    // Plugin admin area notices.
    \add_action(
        'admin_notices',
        '\Includes\PluginAdmin\notices'
    );

    // Flush rewrite rules.
    \register_activation_hook(
        __FILE__,
        '\Includes\Register\activation'
    );

    // Flush rewrite rules.
    \register_deactivation_hook(
        __FILE__,
        '\Includes\Register\deactivation'
    );
}

/**
 * Load global plugin features.
 */
function initPlugin(): void
{
    // Register includes post type.
    \register_post_type(
        'includes',
        \Includes\Args\postType()
    );

    // Register includes taxonomy.
    \register_taxonomy(
        'includes',
        [
            'includes',
        ],
        \Includes\Args\taxonomy()
    );

    // Shortcode: [includes]
    // Shortcode: [includes code=true]
    \add_shortcode(
        'includes',
        '\Includes\Shortcode\includes'
    );

    // Legacy shortcode: [code]
    \add_shortcode(
        'includes',
        '\Includes\Shortcode\code'
    );

    // Inject viewer into template include path.
    \Includes\Filter\template();

    // Allow includes shortcode in featured areas.
    \Includes\Filter\menuItems();
    \Includes\Filter\postTitles();
    \Includes\Filter\widgetText();
    \Includes\Filter\widgetTitles();
}
