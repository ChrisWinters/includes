<?php
/**
 * Public function.
 */

namespace Includes\Filter;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe allow shortcodes in widget titles.
 */
function widgetTitles(): void
{
    if ('1' === \Includes\Option\setting('shortcode_widget_titles')) {
        if (false === \has_filter('widget_title', 'do_shortcode')) {
            \add_filter('widget_title', 'do_shortcode');
        }

        // Correct includes shortcode in widget titles.
        \add_filter(
            'widget_title',
            function ($title, $instance, $base) {
                return htmlspecialchars_decode($title);
            },
            10,
            3
        );
    }
}
