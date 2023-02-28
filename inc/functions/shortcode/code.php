<?php
/**
 * Global function.
 */

namespace Includes\Shortcode;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Legacy code shortcode hooked into includes shortcode.
 *
 * @param array $atts Shortcode attributes.
 */
function code(array $atts = []): void
{
    \Includes\Shortcode\includes(
        array_merge(
            $atts,
            [
                'code' => true,
            ]
        )
    );
}
