<?php
/**
 * Public function.
 */

namespace Includes\Register;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Flush rules for old post type and taxonomy.
 */
function deactivation(): void
{
    global $pagenow;

    if (
        false === \is_admin() ||
        'plugins.php' !== $pagenow ||
        false === \current_user_can('manage_options')
    ) {
        \wp_die(\Includes\settings('security_message'));
    }

    // Make sure notice flag is removed.
    \Includes\Option\delete('notice');

    // Flush rules for new post type and taxonomy.
    \flush_rewrite_rules();
}
