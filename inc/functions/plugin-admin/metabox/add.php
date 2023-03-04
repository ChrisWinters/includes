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
    if ((bool) 1 === \Includes\Option\setting('shortcode_code')) {
        // Includes code editor MetaBox.
        \add_meta_box(
            'includes_code',
            __('Includes code editor (PHP, JavaScript, etc)', 'includes'),
            '\Includes\Admin\MetaBox\editor',
            'includes',
            'normal',
            'high',
            null
        );
    }

    // Includes shortcode MetaBox.
    \add_meta_box(
        'includes_shortcode',
        __('Includes shortcode', 'includes'),
        '\Includes\Admin\MetaBox\shortcode',
        'includes',
        'side',
        'low',
        null
    );
}
