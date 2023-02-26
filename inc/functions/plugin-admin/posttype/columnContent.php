<?php
/**
 * Public function.
 */

namespace Includes\PluginAdmin\PostType;

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
        \Includes\PluginAdmin\PostType\columnCategory($post_id);
    }

    if ('shortcode' === $column) {
        global $post;

        \Includes\PluginAdmin\PostType\columnShortcode($post_id, $post->post_name);
    }
}
