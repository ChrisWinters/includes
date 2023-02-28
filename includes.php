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

// Require plugin settings.
require_once __DIR__.'/inc/settings.php';

// Require allowed plugin files.
foreach ((array) \Includes\settings('files') as $file) {
    require_once __DIR__.'/inc/'.$file;
}

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
