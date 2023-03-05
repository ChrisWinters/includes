<?php
/**
 * Global function.
 */

namespace Includes\Filter;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe allow shortcodes in post titles.
 */
function postTitles(): void
{
    if (1 === (bool) \Includes\Option\setting('shortcode_post_titles')) {
        if (false === \has_filter('the_title', 'do_shortcode')) {
            \add_filter('the_title', 'do_shortcode');
        }
    }
}
