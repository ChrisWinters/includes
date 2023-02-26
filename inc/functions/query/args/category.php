<?php
/**
 * Public function.
 */

namespace Includes\Query\Args;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * WP Query args for includes category shortcode.
 *
 * @param string $categorySlug The category slug to query
 */
function category(string $categorySlug): array
{
    return [
        'post_type' => 'includes',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'nopaging' => false,
        'no_found_rows' => true,
        'tax_query' => [
            'taxonomy' => 'includes',
            'field' => 'slug',
            'terms' => (string) \esc_attr($categorySlug),
            'include_children' => true,
        ],
    ];
}
