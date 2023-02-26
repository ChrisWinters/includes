<?php
/**
 * Public admin area function.
 */

namespace Includes\PluginAdmin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Return to plugin admin area with status message flag.
 */
function postRedirect(
    string $status = 'success'
): void {
    // Set update notice flag.
    \Includes\option\update($status, 'notice');

    \wp_redirect(
        \admin_url(
            'edit.php?post_type=includes&page=includes&status='.$status
        )
    );

    exit;
}
