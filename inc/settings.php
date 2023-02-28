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
        'template_path' => dirname(__FILE__).'\inc\templates',
        'files' => [
           '/args/postType.php',
           '/args/taxonomy.php',
           '/option/delete.php',
           '/option/get.php',
           '/option/setting.php',
           '/option/update.php',
           '/filter/menuItems.php',
           '/filter/postTitles.php',
           '/filter/template.php',
           '/filter/widgetText.php',
           '/filter/widgetTitles.php',
           '/plugin-admin/notices.php',
           '/plugin-admin/queryString.php',
           '/plugin-admin/securityCheck.php',
           '/plugin-admin/metabox/add.php',
           '/plugin-admin/metabox/editor.php',
           '/plugin-admin/metabox/save.php',
           '/plugin-admin/metabox/shortcode.php',
           '/plugin-admin/post/actions.php',
           '/plugin-admin/post/delete.php',
           '/plugin-admin/post/redirect.php',
           '/plugin-admin/post/object.php',
           '/plugin-admin/post/update.php',
           '/plugin-admin/posttype/columnCategory.php',
           '/plugin-admin/posttype/columnContent.php',
           '/plugin-admin/posttype/columnShortcode.php',
           '/plugin-admin/posttype/modifyColumns.php',
           '/plugin-admin/taxonomy/formField.php',
           '/plugin-admin/view/displayAdmin.php',
           '/plugin-admin/view/enqueueScripts.php',
           '/plugin-admin/view/includeTemplates.php',
           '/query/results.php',
           '/query/args/category.php',
           '/query/args/order.php',
           '/query/args/orderby.php',
           '/query/args/postsPerPage.php',
           '/query/args/single.php',
           '/register/deactivation.php',
           '/register/activation.php',
           '/shortcode/code.php',
           '/shortcode/includes.php',
        ],
    ];

    return $settings[$key];
}
