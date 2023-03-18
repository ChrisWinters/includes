<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\Column;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Inject custom column content into new columns.
 *
 * @param string $column  The column slug to target.
 * @param int    $post_id The current post id.
 */
function content(string $column, int $post_id): void
{
    // Disable if viewing post trash.
    if ('trash' === (string) \Includes\queryString('post_status')) {
        return;
    }

    // Show selected categories content.
    if ('category' === $column) {
        \Includes\Admin\Column\category($post_id);
    }

    // Display shortcode input(s).
    // Plugin setting: True displays shortcode column.
    if (
        'shortcode' === $column &&
        true === (bool) \Includes\Option\setting('shortcode_fields')
    ) {
        global $post;

        \Includes\Admin\Column\shortcodes($post_id, $post->post_name);
    }
}
