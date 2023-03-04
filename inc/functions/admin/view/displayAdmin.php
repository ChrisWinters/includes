<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\View;

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
        '\Includes\Admin\View\includeTemplates'
    );
}
