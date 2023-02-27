<?php
/**
 * Global function.
 */

namespace Includes\Filter;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe allow shortcodes in menus.
 */
function menuItems(): void
{
    if ('1' === \Includes\Option\setting('shortcode_menus')) {
        if (false === \has_filter('wp_nav_menu_items', 'do_shortcode')) {
            \add_filter('wp_nav_menu_items', 'do_shortcode');
        }
    }
}
