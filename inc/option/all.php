<?php
/**
 * Private function.
 */

namespace Includes\Option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get all options and check for includes string.
 * Used for plugin development. Add &all=anything to view.
 */
function all(): array
{
    // Clear object.
    $results = [];

    if (
        false === \is_admin() ||
        'includes' !== \Includes\queryString('page') ||
        true === empty(\Includes\queryString('all')) ||
        false === \current_user_can('manage_options')
    ) {
        return $results;
    }

    // Get all saved options.
    $allOptions = (array) \wp_load_alloptions();

    // Loop through all saved WordPress options.
    // Build an array of options with the slug includes.
    foreach ($allOptions as $slug => $values) {
        if (true === str_contains($slug, 'includes')) {
            $results[$slug] = $values;
        }
    }

    return $results;
}
