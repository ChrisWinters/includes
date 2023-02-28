<?php
/**
 * Global function.
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
        'template_path' => dirname(INCLUDES_FILE).'\inc\templates',
        'files' => [
            '/loadBackend.php',
            '/initPlugin.php',
            '/functions/args/postType.php',
            '/functions/args/taxonomy.php',
            '/functions/option/delete.php',
            '/functions/option/get.php',
            '/functions/option/setting.php',
            '/functions/option/update.php',
            '/functions/filter/menuItems.php',
            '/functions/filter/postTitles.php',
            '/functions/filter/template.php',
            '/functions/filter/widgetText.php',
            '/functions/filter/widgetTitles.php',
            '/functions/plugin-admin/notices.php',
            '/functions/plugin-admin/queryString.php',
            '/functions/plugin-admin/securityCheck.php',
            '/functions/plugin-admin/metabox/add.php',
            '/functions/plugin-admin/metabox/editor.php',
            '/functions/plugin-admin/metabox/save.php',
            '/functions/plugin-admin/metabox/shortcode.php',
            '/functions/plugin-admin/post/actions.php',
            '/functions/plugin-admin/post/delete.php',
            '/functions/plugin-admin/post/redirect.php',
            '/functions/plugin-admin/post/object.php',
            '/functions/plugin-admin/post/update.php',
            '/functions/plugin-admin/posttype/columnCategory.php',
            '/functions/plugin-admin/posttype/columnContent.php',
            '/functions/plugin-admin/posttype/columnShortcode.php',
            '/functions/plugin-admin/posttype/modifyColumns.php',
            '/functions/plugin-admin/taxonomy/formField.php',
            '/functions/plugin-admin/view/displayAdmin.php',
            '/functions/plugin-admin/view/enqueueScripts.php',
            '/functions/plugin-admin/view/includeTemplates.php',
            '/functions/query/results.php',
            '/functions/query/args/category.php',
            '/functions/query/args/order.php',
            '/functions/query/args/orderby.php',
            '/functions/query/args/postsPerPage.php',
            '/functions/query/args/single.php',
            '/functions/register/deactivation.php',
            '/functions/register/activation.php',
            '/functions/shortcode/code.php',
            '/functions/shortcode/includes.php',
        ],
    ];

    return $settings[$key];
}
