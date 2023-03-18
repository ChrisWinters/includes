<?php
/**
 * Private function.
 */

namespace Includes\Register;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Validate user can register plugin and prepare plugin for use.
 */
function activation(): void
{
    global $pagenow;

    if (
        false === \is_admin() ||
        'plugins.php' !== $pagenow ||
        false === \current_user_can('manage_options')
    ) {
        \wp_die(\Includes\settings('security_message'));
    }

    // Get activated flag.
    $activated = \Includes\Option\setting('activated');

    if (true === empty($activated)) {
        // Set plugin defaults.
        \Includes\Option\update(
            [
                'activated' => 1,
                'shortcode_viewer' => 1,
                'shortcode_fields' => 1,
            ]
        );
    }

    // Flush rules for new post type and taxonomy.
    flush_rewrite_rules();
}
