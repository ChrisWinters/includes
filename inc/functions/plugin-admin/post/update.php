<?php
/**
 * Private admin area function.
 */

namespace Includes\Admin\Post;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update plugin settings.
 *
 * @param array $postObject Settings form post array.
 *
 * @return string The status of the task: deleted|updated|error
 */
function update(array $postObject): string
{
    // Required security check.
    \Includes\Admin\securityCheck();

    // Default to error if preset function is not found.
    $status = 'error';

    unset($postObject['action']);
    unset($postObject['submit']);

    // No options saved, delete unused option if it exists.
    if (true === empty($postObject)) {
        $settings = \Includes\option\get();

        if (true !== empty($settings)) {
            \Includes\option\delete();
            \Includes\option\delete('notice');
            $status = 'deleted';
        }
    }

    // Update option data with sanitized post object.
    if (true !== empty($postObject)) {
        \Includes\option\update($postObject);
        $status = 'updated';
    }

    return $status;
}
