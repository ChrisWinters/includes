<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue plugin admin area stylesheet.
 */
function enqueueScripts(): void
{
    $currentPage = \Includes\Admin\queryString('page');

    // Only start loading within plugin admin areas.
    if (true === empty($currentPage) || 'includes' !== $currentPage) {
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
