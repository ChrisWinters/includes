<?php
/**
 * Global function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Registers the includes taxonomy with predefined args.
 */
function taxonomy(): void
{
    \register_taxonomy(
        'includes',
        [
            'includes',
        ],
        [
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => false,
            'rewrite' => [
                'slug' => 'includes',
            ],
            'labels' => [
                'name' => __('Categories', 'includes'),
                'singular_name' => __('Category', 'includes'),
                'search_items' => __('Search categories', 'includes'),
                'all_items' => __('All categories', 'includes'),
                'parent_item' => __('Parent category', 'includes'),
                'parent_item_colon' => __('Parent category:', 'includes'),
                'edit_item' => __('Edit category', 'includes'),
                'update_item' => __('Update category', 'includes'),
                'add_new_item' => __('Add new category', 'includes'),
                'new_item_name' => __('New category name', 'includes'),
                'menu_name' => __('Categories', 'includes'),
            ],
        ]
    );
}
