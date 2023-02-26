<?php
/**
 * Private admin area function.
 */

namespace Includes\PluginAdmin\Posts;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Maybe update plugin settings, then return user back to plugin admin area.
 */
function actions(): void
{
    // Required security check.
    \Includes\PluginAdmin\securityCheck();

    // Default to update failed.
    $status = 'error';

    // Filtered but not sanitized post object.
    $postObject = \Includes\PluginAdmin\postObject();

    // Update plugin settings based on selections.
    if ('update' === $postObject['action']) {
        $status = \Includes\PluginAdmin\Posts\update($postObject);
    }

    // Delete all plugin settings.
    if ('delete' === $postObject['action'] && 'delete' === $postObject['confirm']) {
        $status = \Includes\PluginAdmin\Posts\delete();
    }

    // Redirect user back to plugin admin area.
    \Includes\PluginAdmin\postRedirect($status);
}
