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
 * @param string $append optional string to add to the option name
 */
function get(
    string $append = ''
): string|array|bool {
    $append = (true !== empty($append)) ? '-'.$append : '';

    return \maybe_unserialize(\get_option('includes'.$append, ''));
}
