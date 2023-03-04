<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\Post;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Builds filtered post object array.
 */
function object(): array
{
    // Required default inputs.
    $defaultInputs = [
        'action' => FILTER_UNSAFE_RAW,
        '_wp_http_referer' => FILTER_UNSAFE_RAW,
        'includes_nonce' => FILTER_UNSAFE_RAW,
    ];

    // Combine with allowed inputs and filters from settings.
    $allowedInputs = array_merge(
        $defaultInputs,
        \Includes\settings('allowed_inputs')
    );

    // Only allow inputs and filters defined in settings.
    $filteredObject = filter_input_array(INPUT_POST, $allowedInputs);

    // Remove empty items from the post object.
    $postObject = array_filter($filteredObject);

    // Data required or bail.
    if (
        true === empty($postObject['_wp_http_referer']) ||
        true === empty($postObject['includes_nonce'])
    ) {
        return [];
    }

    // Clean object.
    unset($postObject['_wp_http_referer']);
    unset($postObject['includes_nonce']);

    // The post object should at least have an action.
    if (true === empty($postObject)) {
        return [];
    }

    return $postObject;
}
