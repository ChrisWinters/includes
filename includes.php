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
