<?php
/**
 * Private admin area function.
 */

namespace Includes\Admin\Post;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe update plugin settings, then return user back to plugin admin area.
 */
function actions(): void
{
    // Required security check.
    \Includes\Admin\securityCheck();

    // Default to update failed.
    $status = 'error';

    // Filtered but not sanitized post object.
    $postObject = \Includes\Admin\Post\object();

    // Update plugin settings based on selections.
    if ('update' === $postObject['action']) {
        $status = \Includes\Admin\Post\update($postObject);
    }

    // Delete all plugin settings.
    if ('delete' === $postObject['action'] && 'delete' === $postObject['confirm']) {
        $status = \Includes\Admin\Post\delete();
    }

    // Redirect user back to plugin admin area.
    \Includes\Admin\Post\redirect($status);
}
