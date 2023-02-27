<?php
/**
 * Global function.
 */

namespace Includes\Option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get WordPress option data, with empty default value.
 *
 * @param string $appendOptionName optional string to add to the option name
 */
function get(
    string $appendOptionName = ''
): string|array|bool {
    $appendOptionName = (true !== empty($appendOptionName)) ? '-'.$appendOptionName : '';

    return \maybe_unserialize(\get_option('includes'.$appendOptionName, ''));
}
