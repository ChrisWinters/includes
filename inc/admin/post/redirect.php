<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\Post;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Return to plugin admin area with status message flag.
 */
function redirect(
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
