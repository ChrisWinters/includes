<?php
/**
 * Private admin area function.
 */

namespace Includes\Admin\Post;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Delete all plugin settings.
 *
 * @return string The status of the task: deleted|error
 */
function delete(): string
{
    // Required security check.
    \Includes\Admin\securityCheck();

    // All plugin data should easily be removed.
    $status = 'deleted';

    // Delete all possible option set by the plugin.
    \Includes\option\delete();

    // Get all saved options.
    $allOptions = wp_load_alloptions();

    // Validate plugin data was removed.
    foreach ((array) $allOptions as $slug => $values) {
        // Mostly useful for development.
        if (true === str_contains($slug, 'includes')) {
            $status = 'error';
        }
    }

    return $status;
}
