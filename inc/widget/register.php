<?php
/**
 * Global function.
 */

namespace Includes\Widget;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Registers WP_Widget widget(s).
 */
function register(): void
{
    // Widget that renders shortcodes.
    if (true === \Includes\Option\setting('shortcode_widget')) {
        \register_widget('\Includes\Widget\shortcode');
    }
}
