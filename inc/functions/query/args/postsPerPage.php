<?php
/**
 * Global function.
 */

namespace Includes\Query\Args;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Set the number of posts to query within an includes category.
 *
 * @param int   $postsPerPage Number of post to show per page.
 * @param array $wpQuery      WordPress query object.
 */
function postsPerPage(int $postsPerPage, array $wpQuery): array
{
    unset($wpQuery['nopaging']);

    return array_merge(
        $wpQuery,
        [
            'posts_per_page' => (int) $postsPerPage,
        ]
    );
}
