<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\MetaBox;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Display MetaBox for Code editor.
 *
 * @param object $post Current post object.
 */
function editor(object $post): void
{
    // Get MetaBox fields.
    $fields = (array) \get_post_custom($post->ID);

    // No content saved.
    $content = '';

    // Get saved code.
    if (true === isset($fields['includes_code'])) {
        $content = html_entity_decode(htmlentities($fields['includes_code'][0]), ENT_QUOTES | ENT_XML1, 'UTF-8');
    }

    // Nonce security.
    \wp_nonce_field('includes_action', 'includes_nonce');

    // Display content.
    echo '<textarea style="height:300px;width:100%;" autocomplete="off" name="includes_code">';
    echo filter_var($content, FILTER_UNSAFE_RAW, FILTER_FLAG_NO_ENCODE_QUOTES);
    echo '</textarea>';
}
