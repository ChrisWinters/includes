<?php
/**
 * Global function.
 */

namespace Includes\Option;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Get setting from saved plugin option data.
 *
 * @param string $settingKey the key name to get from the setting option array
 * @param string $append     optional string to add to the option name
 */
function setting(
    string $settingKey,
    string $append = ''
): string|array|bool {
    $option = \Includes\option\get($append);

    if (true !== empty($option[$settingKey])) {
        $setting = $option[$settingKey];
    }

    return (true === isset($setting)) ? $setting : '';
}
