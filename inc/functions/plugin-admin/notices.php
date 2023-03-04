<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Display admin area notice.
 */
function notices(): void
{
    $currentPage = \Includes\Admin\queryString('page');

    if ('includes' !== (string) $currentPage) {
        return;
    }

    $status = \Includes\Admin\queryString('status');

    if (true === empty($status)) {
        return;
    }

    // Get notice marker.
    $notice = \Includes\option\get('notice');

    if (true === empty($notice)) {
        return;
    }

    $noticeType = ('error' === $status) ? 'error' : 'success';

    // Delete notice marker.
    \Includes\option\delete('notice');

    $message = \Includes\settings($notice.'_message');

    // Display notice.
    echo '<div class="notice notice-'.$noticeType.' is-dismissible"><p>'.$message.'</p></div>';
}
