<?php
/**
 * Plugin Name: Includes
 * Plugin URI: https://github.com/ChrisWinters/includes
 * Description: Includes for WordPress - Include Content Anywhere!
 * Version: 4.1.1
 * License: GNU GPLv3
 * Copyright ( c ) 2019-2020 Chris Winters
 * Author: Chris W.
 * Author URI: https://github.com/ChrisWinters
 * Text Domain: includes.
 *
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 *
 * @see       /LICENSE
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Plugin settings.
 *
 * @param string $key the array key to get the value for
 */
function settings(string $key): string|array
{
    $settings = [
        'plugin_version' => '5.0.0',
        'plugin_name' => \__('Includes for WordPress', 'includes'),
        'plugin_about' => \__('Include Content Anywhere!', 'includes'),
        'security_message' => \__('You are not authorized to perform this action.', 'includes'),
        'updated_message' => \__('Updated settings.', 'includes'),
        'deleted_message' => \__('All settings deleted.', 'includes'),
        'error_message' => \__('No action taken. Select an option first.', 'includes'),
        'version_message' => \__('WordPress 3.8 is required! Upgrade WordPress and try again.', 'includes'),
        'template_path' => dirname(__FILE__).'\inc\templates',
        'admin_tabs' => [
            'settings' => \__('Settings', 'includes'),
        ],
    ];

    return $settings[$key];
}

require_once __DIR__.'/inc/functions/taxonomy.php';
require_once __DIR__.'/inc/functions/postType.php';
require_once __DIR__.'/inc/functions/shortcode.php';

require_once __DIR__.'/inc/functions/option/delete.php';
require_once __DIR__.'/inc/functions/option/get.php';
require_once __DIR__.'/inc/functions/option/setting.php';
require_once __DIR__.'/inc/functions/option/update.php';

require_once __DIR__.'/inc/functions/filter/menuItems.php';
require_once __DIR__.'/inc/functions/filter/postTitles.php';
require_once __DIR__.'/inc/functions/filter/template.php';
require_once __DIR__.'/inc/functions/filter/widgetText.php';
require_once __DIR__.'/inc/functions/filter/widgetTitles.php';

require_once __DIR__.'/inc/functions/plugin-admin/adminNotices.php';
require_once __DIR__.'/inc/functions/plugin-admin/postObject.php';
require_once __DIR__.'/inc/functions/plugin-admin/postRedirect.php';
require_once __DIR__.'/inc/functions/plugin-admin/queryString.php';
require_once __DIR__.'/inc/functions/plugin-admin/securityCheck.php';

require_once __DIR__.'/inc/functions/plugin-admin/posts/actions.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/delete.php';
require_once __DIR__.'/inc/functions/plugin-admin/posts/update.php';

require_once __DIR__.'/inc/functions/query/wp.php';
require_once __DIR__.'/inc/functions/query/args/category.php';
require_once __DIR__.'/inc/functions/query/args/order.php';
require_once __DIR__.'/inc/functions/query/args/orderby.php';
require_once __DIR__.'/inc/functions/query/args/postsPerPage.php';
require_once __DIR__.'/inc/functions/query/args/single.php';

require_once __DIR__.'/inc/functions/plugin-admin/view/displayAdmin.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/enqueueScripts.php';
require_once __DIR__.'/inc/functions/plugin-admin/view/includeTemplates.php';

require_once __DIR__.'/inc/functions/registerPlugin.php';

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
        '\Includes\PluginAdmin\Posts\actions'
    );

    // Plugin admin area notices.
    \add_action(
        'admin_notices',
        '\Includes\PluginAdmin\adminNotices'
    );
}

/**
 * Load global plugin features.
 */
function plugin(): void
{
    // Register includes post type.
    \Includes\postType();

    // Register includes taxonomy.
    \Includes\taxonomy();

    // Register shortcode: [includes]
    \add_shortcode(
        'includes',
        '\Includes\shortcode'
    );

    // Inject viewer into template include path.
    \Includes\Filter\template();

    // Allow includes shortcode in featured areas.
    \Includes\Filter\menuItems();
    \Includes\Filter\postTitles();
    \Includes\Filter\widgetText();
    \Includes\Filter\widgetTitles();
}
