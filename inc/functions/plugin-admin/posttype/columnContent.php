<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\PostType;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Inject custom column content into new columns.
 *
 * @param string $column  The column slug to target.
 * @param int    $post_id The current post id.
 */
function columnContent(string $column, int $post_id): void
{
    if ('category' === $column) {
        \Includes\Admin\PostType\columnCategory($post_id);
    }

    if ('shortcode' === $column) {
        global $post;

        \Includes\Admin\PostType\columnShortcode($post_id, $post->post_name);
    }
}
