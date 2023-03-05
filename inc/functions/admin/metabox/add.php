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
 */
function add(): void
{
    $editorTitle = __(':: Code editor', 'includes');
    $shortcodeTitle = __(':: Shortcode', 'includes');

    if ((bool) 1 === \Includes\Option\setting('shortcode_code')) {
        $shortcodeTitle = __(':: Shortcodes', 'includes');

        // Includes code editor MetaBox.
        \add_meta_box(
            'includes_code',
            $editorTitle,
            '\Includes\Admin\MetaBox\editor',
            'includes',
            'normal',
            'low',
            null
        );
    }

    // Includes shortcode MetaBox.
    \add_meta_box(
        'includes_shortcode',
        $shortcodeTitle,
        '\Includes\Admin\MetaBox\shortcode',
        'includes',
        'side',
        'high',
        null
    );
}
