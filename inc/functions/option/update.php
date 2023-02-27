<?php
/**
 * Global function.
 */

namespace Includes\Option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update setting WordPress option with new data.
 *
 * @param mixed  $optionData the data to save
 * @param string $append     optional string to add to the option name
 */
function update(
    mixed $optionData,
    string $append = ''
): void {
    $append = (true !== empty($append)) ? '-'.$append : '';

    \update_option(
        'includes'.$append,
        \maybe_serialize($optionData)
    );
}
