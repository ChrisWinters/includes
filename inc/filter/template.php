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
    // Only load if the requested URI is the includes post type.
    if (
        true === isset($_SERVER['REQUEST_URI']) &&
        false === str_contains($_SERVER['REQUEST_URI'], 'includes')
    ) {
        return;
    }

    // Plugin setting: True uses theme templates to view Includes content.
    if (true !== (bool) \Includes\Option\setting('shortcode_viewer')) {
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
        function ($template): string {
            // Force theme to throw 404 if query is bad.
            if (true === str_contains($template, '404')) {
                header('HTTP/1.0 404 Not Found');

                return $template;
            }

            return \Includes\settings('template_path').'/viewer.php';
        },
        99
    );
}
