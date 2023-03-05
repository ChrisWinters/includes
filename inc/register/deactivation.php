<?php
/**
 * Public function.
 */

namespace Includes\Register;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Flush rules for old post type and taxonomy.
 */
function deactivation(): void
{
    \flush_rewrite_rules();
}
