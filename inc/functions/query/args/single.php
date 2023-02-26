<?php
/**
 * Public function.
 */

namespace Includes\Query\Args;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * WP Query args for includes post shortcode.
 *
 * @param string $postSlug The include post slug to query.
 */
function single(string $postSlug): array
{
    return [
        'name' => (string) \esc_attr($postSlug),
        'post_type' => 'includes',
        'post_status' => 'publish',
        'numberposts' => 1,
    ];
}
