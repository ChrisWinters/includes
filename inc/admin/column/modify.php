<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\Column;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Update columns displayed for the includes post type.
 *
 * @param array $columns An associative array of column headings.
 */
function modify(array $columns): array
{
    // Disable if viewing post trash.
    if ('trash' === (string) \Includes\queryString('post_status')) {
        return $columns;
    }

    $title = $columns['title'];
    $author = $columns['author'];
    $date = $columns['date'];

    // Remove columns.
    unset($columns['title']);
    unset($columns['author']);
    unset($columns['date']);

    // Add columns.
    $columns['title'] = $title;

    // Plugin setting: True displays shortcode column.
    if (true === (bool) \Includes\Option\setting('shortcode_fields')) {
        $columns['shortcode'] = __('Shortcode', 'includes');
    }

    $columns['category'] = __('Categories', 'includes');
    $columns['author'] = $author;
    $columns['date'] = $date;

    return $columns;
}
