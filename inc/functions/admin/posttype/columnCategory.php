<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\PostType;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Content for category column.
 *
 * @param int $post_id The includes post id.
 */
function columnCategory(int $post_id): void
{
    $categories = \get_the_terms((int) $post_id, 'includes');

    if (
        true === empty($categories) ||
        (true !== empty($categories) && false === is_array($categories))
    ) {
        return;
    }

    $category_count = count($categories);

    $counter = 0;

    $html = '';

    foreach ((array) $categories as $category) {
        if (0 === $category->count) {
            continue;
        }

        // Comma Count.
        ++$counter;

        // Add Comma.
        $comma = ', ';

        // Clear Comma.
        if ($counter === $category_count) {
            $comma = '';
        }

        $html .= '<a href="edit.php?post_type=includes&'.
        'includes='.\sanitize_key($category->slug).'">'.
        \esc_html($category->name).'</a>'.$comma;
    }

    echo $html;
}