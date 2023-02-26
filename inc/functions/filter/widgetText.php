<?php
/**
 * Public function.
 */

namespace Includes\Filter;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe allow shortcodes in text widgets.
 */
function widgetText(): void
{
    if ('1' === \Includes\Option\setting('shortcode_widgets')) {
        if (false === \has_filter('widget_text', 'do_shortcode')) {
            \add_filter('widget_text', 'do_shortcode');
        }
    }
}
