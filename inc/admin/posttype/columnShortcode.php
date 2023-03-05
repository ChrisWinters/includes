<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\PostType;

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
    $slugShortcode = htmlentities('[includes slug="'.\esc_attr($post_slug).'"]', ENT_QUOTES);
    $title = \__('Preview shortcode', 'includes');

    $html = "<input type=\"text\" name=\"includes\" value=\"{$slugShortcode}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" /> <a href=\"{$permalink}\" target=\"_blank\" title=\"{$title}\">{$dashIcon}</a>";

    if ((bool) 1 === \Includes\Option\setting('shortcode_code')) {
        $codeShortcode = htmlentities('[includes type="code" slug="'.\esc_attr($post_slug).'"]', ENT_QUOTES);
        $html .= "<br /><input type=\"text\" name=\"includes_codes\" value=\"{$codeShortcode}\" style=\"width:80%\" onclick=\"this.focus();this.select()\" /> <a href=\"{$permalink}?type=code\" target=\"_blank\" title=\"{$title}\">{$dashIcon}</a>";
    }

    echo $html;
}
