<?php
/**
 * Global function.
 */

namespace Includes\Option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Delete a WordPress option.
 *
 * @param string $append optional string to add to the option name
 */
function delete(
    string $append = ''
): void {
    $append = (true !== empty($append)) ? '-'.$append : '';

    \delete_option('includes'.$append);
}
