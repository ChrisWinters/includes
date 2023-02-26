<?php
/**
 * Public function.
 */

namespace Includes\PluginAdmin\PostType;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update columns displayed for the includes post type.
 *
 * @param array $columns An associative array of column headings.
 */
function modifyColumns(array $columns): array
{
    $title = $columns['title'];
    $author = $columns['author'];
    $date = $columns['date'];

    // Remove columns.
    unset($columns['title']);
    unset($columns['author']);
    unset($columns['date']);

    // Add columns.
    $columns['title'] = $title;
    $columns['shortcode'] = __('Shortcode', 'includes');
    $columns['category'] = __('Categories', 'includes');
    $columns['author'] = $author;
    $columns['date'] = $date;

    return $columns;
}
