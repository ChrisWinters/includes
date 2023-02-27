<?php
/**
 * Private admin area function.
 */

namespace Includes\PluginAdmin\Post;

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
    $postObject = \Includes\PluginAdmin\Post\object();

    // Update plugin settings based on selections.
    if ('update' === $postObject['action']) {
        $status = \Includes\PluginAdmin\Post\update($postObject);
    }

    // Delete all plugin settings.
    if ('delete' === $postObject['action'] && 'delete' === $postObject['confirm']) {
        $status = \Includes\PluginAdmin\Post\delete();
    }

    // Redirect user back to plugin admin area.
    \Includes\PluginAdmin\postRedirect($status);
}
