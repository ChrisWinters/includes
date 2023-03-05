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
        '\Includes\Admin\View\displayAdmin'
    );

    // Enqueue plugin admin area stylesheet.
    \add_action(
        'admin_enqueue_scripts',
        '\Includes\Admin\View\enqueueScripts'
    );

    // Update plugin settings.
    \add_action(
        'admin_post_update',
        '\Includes\Admin\Post\actions'
    );

    // Add MetaBoxes.
    \add_action(
        'add_meta_boxes',
        'Includes\Admin\MetaBox\add'
    );

    // Save code MetaBox data.
    \add_action(
        'save_post_includes',
        '\Includes\Admin\MetaBox\save',
    );

    // Modify post type columns.
    \add_filter(
        'manage_includes_posts_columns',
        '\Includes\Admin\PostType\modifyColumns',
        10,
        1
    );

    // Inject custom post type column content.
    \add_action(
        'manage_includes_posts_custom_column',
        '\Includes\Admin\PostType\columnContent',
        10,
        2
    );

    // Inject shortcode form field on taxonomy terms.
    \add_action(
        'includes_edit_form_fields',
        '\Includes\Admin\Taxonomy\formField',
        10,
        1
    );

    // Display any shortcode within a registered sidebar.
    \add_action(
        'widgets_init',
        '\Includes\Widget\register'
    );

    // Plugin admin area notices.
    \add_action(
        'admin_notices',
        '\Includes\Admin\notices'
    );

    // Corrects search query for includes post type.
    \add_action(
        'pre_get_posts',
        '\Includes\Query\adminSearch'
    );

    // Flush rewrite rules.
    \register_activation_hook(
        INCLUDES_FILE,
        '\Includes\Register\activation'
    );

    // Flush rewrite rules.
    \register_deactivation_hook(
        INCLUDES_FILE,
        '\Includes\Register\deactivation'
    );
}
