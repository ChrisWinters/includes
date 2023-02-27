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
 * @param string $appendOptionName optional string to add to the option name
 */
function delete(
    string $appendOptionName = ''
): void {
    $appendOptionName = (true !== empty($appendOptionName)) ? '-'.$appendOptionName : '';

    \delete_option('includes'.$appendOptionName);
}
