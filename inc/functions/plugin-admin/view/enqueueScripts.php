<?php
/**
 * Public admin area function: view.
 */

namespace Includes\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue plugin admin area stylesheet.
 */
function enqueueScripts(): void
{
    $currentPage = \Includes\PluginAdmin\queryString('page');

    // Only start loading within plugin admin areas.
    if (true === empty($currentPage)) {
        return;
    }

    // Only load within this plugins admin area.
    if ('includes' !== $currentPage) {
        return;
    }

    \wp_enqueue_style(
        'includes',
        \plugins_url(
            '/includes/assets/css/style.min.css'
        ),
        [],
        \Includes\settings('plugin_version'),
        'all'
    );
}
