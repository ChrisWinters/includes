<?php
/**
 * Global function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

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
