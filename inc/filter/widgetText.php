<?php
/**
 * Global function.
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
    if (1 === (bool) \Includes\Option\setting('shortcode_widgets')) {
        \add_filter('widget_text', 'do_shortcode', 11);
    }
}
