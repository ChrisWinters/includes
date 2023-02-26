<?php
/**
 * Backend function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Validate user can register plugin and prepare plugin for use.
 */
function registerPlugin(): void
{
    global $pagenow;

    if (
        false === \is_admin() ||
        'plugins.php' !== $pagenow ||
        false === \current_user_can('manage_options')
    ) {
        \wp_die(\Includes\settings('security_message'));
    }

    // Flush rules for new post type and taxonomy.
    flush_rewrite_rules();
}
