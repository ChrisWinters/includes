<?php
/**
 * Global function.
 */

namespace Includes\Query;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Corrects search query for includes post type.
 *
 * @param object The WP_Query instance (passed by reference).
 */
function adminSearch(\WP_Query $query): object
{
    // Only within includes post type admin pages.
    if ('includes' !== \Includes\queryString('post_type')) {
        return $query;
    }

    // Get search query.
    $search = filter_input(
        INPUT_GET,
        's',
        FILTER_UNSAFE_RAW
    );

    // Empty search, redirect to Includes listing.
    if (true === isset($search) && true === empty($search)) {
        \wp_redirect(
            \admin_url(
                'edit.php?post_type=includes'
            )
        );

        exit;
    }

    // Correct search query.
    unset($GLOBALS['wp_query']->query['includes_code']);
    unset($GLOBALS['wp_query']->query['includes']);
    unset($GLOBALS['wp_query']->query['name']);
    unset($GLOBALS['wp_query']->query_vars['includes_code']);
    unset($GLOBALS['wp_query']->query_vars['includes']);
    unset($GLOBALS['wp_query']->query_vars['name']);

    return $query;
}
