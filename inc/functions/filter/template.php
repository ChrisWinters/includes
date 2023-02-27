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
            $postID = (int) \get_the_ID();
            $postType = (string) \get_post_type($postID);

            if ('includes' === $postType) {
                $template = \Includes\settings('template_path').'/viewer.php';
            }

            return $template;
        },
        99
    );
}
