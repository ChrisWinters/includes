<?php
/**
 * Global function.
 */

namespace Includes\Query;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Remove includes post type from frontend search query.
 *
 * @param object The WP_Query instance (passed by reference).
 */
function siteSearch(\WP_Query $query)
{
    // Frontend main query results only.
    if (true === \is_admin() || false === $query->is_main_query()) {
        return $query;
    }

    // If search results.
    if (true === $query->is_search()) {
        // Get searchable post types.
        $searchablePostTypes = get_post_types(
            [
                'exclude_from_search' => false,
            ]
        );

        // Only filter includes post type.
        if (
            true === is_array($searchablePostTypes) &&
            true === in_array('includes', $searchablePostTypes, true)
        ) {
            // Remove post type from being searchable.
            unset($searchablePostTypes['includes']);

            // Research searchable post types.
            $query->set('post_type', $searchablePostTypes);
        }
    }

    return $query;
}
