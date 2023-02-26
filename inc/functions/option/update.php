<?php
/**
 * Private admin area function.
 */

namespace Includes\Option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update setting WordPress option with new data.
 *
 * @param mixed  $optionData       the data to save
 * @param string $appendOptionName optional string to add to the option name
 */
function update(
    mixed $optionData,
    string $appendOptionName = ''
): void {
    $appendOptionName = (true !== empty($appendOptionName)) ? '-'.$appendOptionName : '';

    \update_option(
        'includes'.$appendOptionName,
        \maybe_serialize($optionData)
    );
}
