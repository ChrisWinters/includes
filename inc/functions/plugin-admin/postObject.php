<?php
/**
 * Public admin area function.
 */

namespace Includes\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Builds filtered post object array.
 */
function postObject(): array
{
    $allowedInputs = [
        'action' => FILTER_UNSAFE_RAW,
        'submit' => FILTER_UNSAFE_RAW,
        '_wp_http_referer' => FILTER_UNSAFE_RAW,
        'includes_nonce' => FILTER_UNSAFE_RAW,
        'shortcode_code' => FILTER_VALIDATE_BOOL,
        'shortcode_terms' => FILTER_VALIDATE_BOOL,
        'shortcode_posts_pages' => FILTER_VALIDATE_BOOL,
        'shortcode_post_titles' => FILTER_VALIDATE_BOOL,
        'shortcode_menus' => FILTER_VALIDATE_BOOL,
        'shortcode_widget_titles' => FILTER_VALIDATE_BOOL,
    ];

    $filteredObject = filter_input_array(INPUT_POST, $allowedInputs);
    $postObject = array_filter($filteredObject);

    if (
        true === empty($postObject['_wp_http_referer']) ||
        true === empty($postObject['includes_nonce'])
    ) {
        return [];
    }

    unset($postObject['_wp_http_referer']);
    unset($postObject['includes_nonce']);

    if (true === empty($postObject)) {
        return [];
    }

    return $postObject;
}
