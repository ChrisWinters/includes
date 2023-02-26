<?php
/**
 * Private admin area function.
 */

namespace Includes\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Validate form posts are authorized.
 *
 * - Defaults to failed security check.
 * - Checks if user is allowed to manage settings
 * - Checks if user has proper referral and security nonce
 */
function securityCheck(): void
{
    $securityStatus = false;
    $securityMessage = \Includes\settings('security_message');

    // Check if user is allowed to manage settings.
    if (
        true === \current_user_can('manage_options')
    ) {
        $securityStatus = true;
    }

    // Check if user has proper referral and security nonce
    if (
        true === \check_admin_referer('includes_action', 'includes_nonce') &&
        true === $securityStatus
    ) {
        $securityStatus = true;
    }

    if (false === $securityStatus) {
        \wp_die(\esc_html($securityMessage));
    }
}
