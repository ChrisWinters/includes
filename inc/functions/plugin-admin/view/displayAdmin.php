<?php
/**
 * Public admin area function: view.
 */

namespace Includes\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Load plugin menu, stylesheet, and templates.
 */
function displayAdmin(): void
{
    // Plugin admin menu and templates.
    \add_submenu_page(
        'edit.php?post_type=includes',
        \Includes\settings('plugin_name'),
        __('Settings', 'includes'),
        'manage_options',
        'includes',
        '\Includes\PluginAdmin\View\includeTemplates'
    );
}
