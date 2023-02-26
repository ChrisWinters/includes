<?php
/**
 * Public function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Display includes shortcode results.
 *
 * @param array $atts Shortcode attributes.
 */
function shortcode(array $atts = []): string
{
    // Defaults to the_content over code post meta.
    $codeStatus = (
        true === isset($atts['code']) &&
        true === (bool) $atts['code']
    ) ? true : false;

    // Single includes query.
    if (true !== empty($atts['slug'])) {
        $args = \Includes\Query\Args\single($atts['slug']);
    }

    // Category includes query.
    if (true !== empty($atts['category'])) {
        $args = \Includes\Query\Args\category($atts['category']);

        if (true !== empty($atts['posts_per_page'])) {
            $args = \Includes\Query\Args\postsPerPage($atts['posts_per_page'], $args);
        }

        if (true !== empty($atts['orderby'])) {
            $args = \Includes\Query\Args\orderby($atts['orderby'], $args);
        }

        if (true !== empty($atts['order'])) {
            $args = \Includes\Query\Args\order($atts['order'], $args);
        }
    }

    if (true === empty($args)) {
        return '';
    }

    return \Includes\Query\wp($args, $codeStatus);
}
