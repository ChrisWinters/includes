<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\MetaBox;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Display MetaBox for Includes shortcode.
 *
 * @param object $post Current post object.
 */
function shortcode(object $post): void
{
    if (true === empty($post) || true === empty($post->post_name)) {
        return;
    }

    $dashIcon = '<span class="dashicons dashicons-visibility" style="margin-top:4px;"></span>';
    $permalink = \get_permalink($post->ID);
    $slugShortCode = htmlentities('[includes slug="'.$post->post_name.'"]', ENT_QUOTES);

    // Display slug shortcode.
    echo '<p><a href="'.$permalink.'" target="_blank" style="text-decoration:none;">'.$dashIcon.'</a> <input type="text" name="shortcode" value="'.$slugShortCode.'" size="24" autocomplete="off" onclick="this.focus();this.select()" /></p>';

    // Display code shortcode.
    if ((bool) 1 === \Includes\Option\setting('shortcode_code')) {
        $codeView = ('publish' === $post->post_status) ? '?type=code' : '&type=code';
        $codeShortcode = htmlentities('[includes code slug="'.$post->post_name.'"]', ENT_QUOTES);

        echo '<p><a href="'.$permalink.$codeView.'" target="_blank" style="text-decoration:none;">'.$dashIcon.'</a> <input type="text" name="shortcode" value="'.$codeShortcode.'" size="24" autocomplete="off" onclick="this.focus();this.select()" /></p>';
    }
}
