<?php
/**
 * Public function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Flush rules for old post type and taxonomy.
 */
function deregisterPlugin(): void
{
    \flush_rewrite_rules();
}
