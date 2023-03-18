<?php

/**
 * Plugin Name: Includes
 * Plugin URI: https://github.com/ChrisWinters/includes
 * Description: Includes for WordPress - Include Content Anywhere!
 * Version: 5.0.0
 * License: GNU GPLv3
 * Author: Chris W.
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

// Plugin update checker
if (true === file_exists(dirname(__FILE__).'/puc/plugin-update-checker.php')) {
    require_once dirname(__FILE__).'/puc/plugin-update-checker.php';

    $includesPuc = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
        'https://raw.githubusercontent.com/ChrisWinters/includes/master/updates.json',
        __FILE__,
        'includes'
    );
}
