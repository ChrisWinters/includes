<?php
/**
 * Global function.
 */

namespace Includes\Filter;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Inject shortcode viewer into template include path.
 */
function template(): void
{
    if (true === \is_blog_admin()) {
        return;
    }

    // Only load if the requested URI is the includes post type.
    // Cannot check for post type yet, but need to disable features.
    if (
        true === isset($GLOBALS['REQUEST_URI']) &&
        false === str_contains($GLOBALS['REQUEST_URI'], 'includes')
    ) {
        return;
    }

    // Removes admin bar.
    \add_filter('show_admin_bar', '__return_false');
    \show_admin_bar(false);

    // Replaces double line-breaks with paragraph elements.
    \remove_filter('the_content', 'wpautop');

    // Filters the path of the current template before including it.
    \add_filter(
        'template_include',
        function (): string {
            return \Includes\settings('template_path').'/viewer.php';
        },
        99
    );
}
