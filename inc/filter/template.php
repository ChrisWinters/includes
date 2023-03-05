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
    // Frontend only.
    if (true === \is_admin()) {
        return;
    }

    // Only load if the requested URI is the includes post type.
    // Cannot check for post type yet, but may need to disable feature.
    if (
        true === isset($_SERVER['REQUEST_URI']) &&
        false === str_contains($_SERVER['REQUEST_URI'], 'includes')
    ) {
        return;
    }

    // Plugin setting: True uses theme templates to view shortcode content.
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
        function (): string {
            return \Includes\settings('template_path').'/viewer.php';
        },
        99
    );
}
