<?php
/**
 * Global function.
 */

namespace Includes\Filter;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Inject shortcode viewer into template include path.
 */
function template(): void
{
    \add_filter(
        'template_include',
        function (string $template) {
            if (true === \is_singular('includes')) {
                $template = \Includes\settings('template_path').'/viewer.php';
            }

            return $template;
        },
        99
    );
}
