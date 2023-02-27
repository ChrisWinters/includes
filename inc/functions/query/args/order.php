<?php
/**
 * Global function.
 */

namespace Includes\Query\Args;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Order WP Query results.
 *
 * @param string $order   Designates the ascending or descending order.
 * @param array  $wpQuery WordPress query object.
 */
function order(string $order, array $wpQuery): array
{
    if (
        true === in_array(
            (string) $order,
            [
                'DESC',
                'ASC',
            ],
            true
        )
    ) {
        unset($wpQuery['order']);

        $wpQuery = array_merge(
            (array) $wpQuery,
            [
                'order' => (string) strtoupper($order),
            ]
        );
    }

    return $wpQuery;
}
