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
        'allowed_inputs' => [
            'menu_position' => FILTER_VALIDATE_INT,
            'shortcode_viewer' => FILTER_VALIDATE_BOOL,
            'shortcode_fields' => FILTER_VALIDATE_BOOL,
            'shortcode_code' => FILTER_VALIDATE_BOOL,
            'shortcode_terms' => FILTER_VALIDATE_BOOL,
            'shortcode_posts_pages' => FILTER_VALIDATE_BOOL,
            'shortcode_widget' => FILTER_VALIDATE_BOOL,
            'shortcode_post_titles' => FILTER_VALIDATE_BOOL,
            'shortcode_menus' => FILTER_VALIDATE_BOOL,
            'shortcode_widget_titles' => FILTER_VALIDATE_BOOL,
        ],
        'files' => [
            '/initPlugin.php',
            '/loadBackend.php',
            '/posttype.php',
            '/queryString.php',
            '/taxonomy.php',
            '/option/all.php',
            '/option/delete.php',
            '/option/get.php',
            '/option/setting.php',
            '/option/update.php',
            '/filter/menuItems.php',
            '/filter/postTitles.php',
            '/filter/template.php',
            '/filter/widgetText.php',
            '/filter/widgetTitles.php',
            '/admin/notices.php',
            '/admin/securityCheck.php',
            '/admin/column/category.php',
            '/admin/column/content.php',
            '/admin/column/shortcodes.php',
            '/admin/column/modify.php',
            '/admin/metabox/add.php',
            '/admin/metabox/editor.php',
            '/admin/metabox/save.php',
            '/admin/metabox/shortcode.php',
            '/admin/post/actions.php',
            '/admin/post/delete.php',
            '/admin/post/redirect.php',
            '/admin/post/object.php',
            '/admin/post/update.php',
            '/admin/taxonomy/formField.php',
            '/admin/view/displayAdmin.php',
            '/admin/view/enqueueScripts.php',
            '/admin/view/includeTemplates.php',
            '/query/results.php',
            '/query/adminSearch.php',
            '/query/siteSearch.php',
            '/query/args/category.php',
            '/query/args/order.php',
            '/query/args/orderby.php',
            '/query/args/postsPerPage.php',
            '/query/args/single.php',
            '/register/deactivation.php',
            '/register/activation.php',
            '/register/uninstall.php',
            '/shortcode/code.php',
            '/shortcode/includes.php',
            '/widget/register.php',
            '/widget/shortcode.php',
        ],
    ];

    return $settings[$key];
}
