<?php
/**
 * Public function.
 */

namespace Includes\PluginAdmin\PostType;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Content for shortcode column.
 *
 * @param int    $post_id   The includes post id.
 * @param string $post_slug The includes post slug.
 */
function columnShortcode(int $post_id, string $post_slug): void
{
    $permalink = \get_post_permalink($post_id);

    $dashIcon = '<span class="dashicons dashicons-visibility" style="margin-top:4px;"></span>';

    $shortCode = htmlentities('[includes slug="'.$post_slug.'"]', ENT_QUOTES);
    $html = "<a href=\"{$permalink}\" target=\"_blank\">{$dashIcon}</a> <input type=\"text\" name=\"includes\" value=\"{$shortCode}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" />";

    if ((bool) 1 === \Includes\Option\setting('shortcode_code')) {
        $shortCode = htmlentities('[code slug="'.$post_slug.'"]', ENT_QUOTES);
        $html .= "<br /><a href=\"{$permalink}&type=code\" target=\"_blank\">{$dashIcon}</a> <input type=\"text\" name=\"includes_codes\" value=\"{$shortCode}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" />";
    }

    echo $html;
}
