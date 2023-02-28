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

require_once __DIR__.'/inc/settings.php';

function autoloadFiles()
{
    $files = (array) \Includes\settings('files');

    foreach ($files as $file) {
        require_once __DIR__.'/inc/functions/'.$file;
    }
}

\Includes\autoloadFiles();

// require_once __DIR__.'/inc/functions/args/postType.php';
// require_once __DIR__.'/inc/functions/args/taxonomy.php';

require_once __DIR__.'/inc/functions/option/delete.php';
require_once __DIR__.'/inc/functions/option/get.php';
require_once __DIR__.'/inc/functions/option/setting.php';
require_once __DIR__.'/inc/functions/option/update.php';

require_once __DIR__.'/inc/functions/filter/menuItems.php';
require_once __DIR__.'/inc/functions/filter/postTitles.php';
require_once __DIR__.'/inc/functions/filter/template.php';
require_once __DIR__.'/inc/functions/filter/widgetText.php';
require_once __DIR__.'/inc/functions/filter/widgetTitles.php';

require_once __DIR__.'/inc/functions/plugin-admin/notices.php';
require_once __DIR__.'/inc/functions/plugin-admin/queryString.php';
require_once __DIR__.'/inc/functions/plugin-admin/securityCheck.php';

require_once __DIR__.'/inc/functions/plugin-admin/metabox/add.php';
require_once __DIR__.'/inc/functions/plugin-admin/metabox/editor.php';
require_once __DIR__.'/inc/functions/plugin-admin/metabox/save.php';
require_once __DIR__.'/inc/functions/plugin-admin/metabox/shortcode.php';

require_once __DIR__.'/inc/functions/plugin-admin/post/actions.php';
require_once __DIR__.'/inc/functions/plugin-admin/post/delete.php';
require_once __DIR__.'/inc/functions/plugin-admin/post/redirect.php';
require_once __DIR__.'/inc/functions/plugin-admin/post/object.php';
require_once __DIR__.'/inc/functions/plugin-admin/post/update.php';

require_once __DIR__.'/inc/functions/plugin-admin/posttype/columnCategory.php';
require_once __DIR__.'/inc/functions/plugin-admin/posttype/columnContent.php';
require_once __DIR__.'/inc/functions/plugin-admin/posttype/columnShortcode.php';
require_once __DIR__.'/inc/functions/plugin-admin/posttype/modifyColumns.php';

require_once __DIR__.'/inc/functions/plugin-admin/taxonomy/formField.php';

require_once __DIR__.'/inc/functions/plugin-admin/view/displayAdmin.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/enqueueScripts.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/includeTemplates.php';

require_once __DIR__.'/inc/functions/query/results.php';
require_once __DIR__.'/inc/functions/query/args/category.php';
require_once __DIR__.'/inc/functions/query/args/order.php';
require_once __DIR__.'/inc/functions/query/args/orderby.php';
require_once __DIR__.'/inc/functions/query/args/postsPerPage.php';
require_once __DIR__.'/inc/functions/query/args/single.php';

require_once __DIR__.'/inc/functions/register/deactivation.php';
require_once __DIR__.'/inc/functions/register/activation.php';

require_once __DIR__.'/inc/functions/shortcode/code.php';
require_once __DIR__.'/inc/functions/shortcode/includes.php';

// Init backend plugin features.
\add_action(
    'plugins_loaded',
    '\Includes\backend'
);

// Init global plugin features.
\add_action(
    'init',
    '\Includes\plugin'
);

/**
 * Load backend plugin features.
 */
function backend(): void
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
function plugin(): void
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
