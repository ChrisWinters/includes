<?php
/**
 * Public admin area function.
 */

namespace Includes\PluginAdmin\MetaBox;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Save and sanitize code editor MetaBox data.
 *
 * @param int $postID WordPress Post ID for post being saved.
 */
function save(int $postID): void
{
    // Ignore autosave feature.
    if (true === defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Get post action.
    $action = filter_input(INPUT_POST, 'action');

    // Ignore if no/bad action.
    if (
        true === empty($action) ||
        true !== empty($action) && 'editpost' !== $action
    ) {
        return;
    }

    // Validate user level and nonce.
    \Includes\PluginAdmin\securityCheck();

    // Get content from code editor to save.
    $content = trim(filter_input(INPUT_POST, 'includes_code'));

    // Lightly sanitize content and save.
    if (true !== empty($content)) {
        $content = htmlentities(stripslashes($content));
        \update_post_meta((int) $postID, 'includes_code', $content);
    }

    // Delete post meta field if set and content empty.
    if (true === empty($content)) {
        $content = \get_post_meta($postID, 'includes_code');

        if (true !== empty($content)) {
            \delete_post_meta((int) $postID, 'includes_code');
        }
    }
}
