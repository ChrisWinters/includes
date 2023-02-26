<?php
/**
 * Public function.
 */

namespace Includes\Query\Args;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Sets the sort order for posts within an includes category.
 *
 * @param string $orderby Sort retrieved posts by parameter.
 * @param array  $wpQuery WordPress query object.
 */
function orderby(string $orderby, array $wpQuery): array
{
    if (
        true === in_array(
            (string) $orderby,
            [
                'none',
                'ID',
                'date',
                'title',
                'slug',
                'rand',
                'modified',
            ],
            true
        )
    ) {
        unset($wpQuery['orderby']);

        $wpQuery = array_merge(
            $wpQuery,
            [
                'orderby' => (string) $orderby,
            ]
        );
    }

    return $wpQuery;
}
