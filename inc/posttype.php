<?php
/**
 * Global function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/*
 * WordPress PostType args.
 */
function postType(): array
{
    // Maybe get plugin menu position.
    $getPosition = \Includes\Option\setting('menu_position');
    $menuPosition = (true !== empty($getPosition)) ? (int) $getPosition : 80;

    return [
        'public' => true,
        'show_in_nav_menus' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => false,
        'map_meta_cap' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'rest_base' => false,
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => $menuPosition,
        'capability_type' => 'page',
        'menu_icon' => 'dashicons-info',
        'taxonomies' => [
            'includes',
        ],
        'supports' => [
            'title',
            'editor',
            'author',
            'revisions',
        ],
        'rewrite' => [
            'slug' => '',
        ],
        'labels' => [
            'name' => __('Includes', 'includes'),
            'singular_name' => __('Include', 'includes'),
            'menu_name' => __('Includes', 'includes'),
            'name_admin_bar' => __('Includes', 'includes'),
            'add_new' => __('Add new', 'includes'),
            'add_new_item' => __('Add new include', 'includes'),
            'new_item' => __('New include', 'includes'),
            'edit_item' => __('Edit include', 'includes'),
            'view_item' => __('View include', 'includes'),
            'all_items' => __('View Includes', 'includes'),
            'search_items' => __('Search Includes', 'includes'),
            'parent_item_colon' => __('Parent include', 'includes'),
            'not_found' => __('No Includes to display', 'includes'),
            'not_found_in_trash' => __('No Includes found in trash', 'includes'),
            'archives' => __('Includes archives', 'includes'),
            'attributes' => __('Includes attributes', 'includes'),
            'items_list' => __('Includes list', 'includes'),
            'items_list_navigation' => __('Includes list navigation', 'includes'),
            'insert_into_item' => __('Insert into Includes', 'includes'),
            'filter_items_list' => __('Filter Includes', 'includes'),
        ],
    ];
}
