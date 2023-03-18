<?php

/**
 * Plugin Name: Includes
 * Plugin URI: https://github.com/ChrisWinters/includes
 * Description: Includes for WordPress - Include Content Anywhere!
 * Version: 4.1.1
 * License: GNU GPLv3
 * Author: Chris Winters
 * Text Domain: includes
 * Author URI: https://github.com/ChrisWinters
 * Copyright ( c ) 2014-2023 Chris Winters.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

define('INCLUDES_FILE', __FILE__);

/**
 * Require allowed files.
 */
function requiredFiles(): void
{
    // Require plugin settings.
    require_once __DIR__.'/inc/settings.php';

    // Require allowed plugin files.
    foreach ((array) \Includes\settings('files') as $file) {
        require_once __DIR__.'/inc/'.(string) $file;
    }
}

\Includes\requiredFiles();

// Init backend plugin features.
\add_action(
    'plugins_loaded',
    '\Includes\loadBackend'
);

// Init global plugin features.
\add_action(
    'init',
    '\Includes\initPlugin'
);

// Maybe add default settings & flush rewrite rules.
\register_activation_hook(
    INCLUDES_FILE,
    '\Includes\Register\activation'
);

// Garbage cleanup & flush rewrite rules.
\register_deactivation_hook(
    INCLUDES_FILE,
    '\Includes\Register\deactivation'
);

// Uninstall plugin.
\register_uninstall_hook(
    INCLUDES_FILE,
    '\Includes\Register\uninstall'
);
