<?php
/**
 * Private function.
 */

namespace Includes\Register;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Uninstall plugin created terms, post meta, posts and options.
 */
function uninstall(): void
{
    $plugin = filter_input(
        INPUT_POST,
        'plugin',
        FILTER_UNSAFE_RAW
    );

    $action = filter_input(
        INPUT_POST,
        'action',
        FILTER_UNSAFE_RAW
    );

    if (
        'includes/includes.php' !== (string) $plugin &&
        'delete-plugin' !== (string) $action &&
        false === \current_user_can('activate_plugins')
    ) {
        return;
    }

    global $wpdb;

    // Get terms.
    $terms = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT t.*, tt.*
            FROM $wpdb->terms
            AS t
            INNER JOIN $wpdb->term_taxonomy
            AS tt
            ON t.term_id = tt.term_id
            WHERE tt.taxonomy
            IN ('%s')",
            'includes'
        )
    );

    // Delete terms.
    if (true !== empty($terms)) {
        foreach ($terms as $term) {
            $wpdb->delete(
                $wpdb->term_taxonomy,
                [
                    'term_taxonomy_id' => $term->term_taxonomy_id,
                ]
            );

            $wpdb->delete(
                $wpdb->terms,
                [
                    'term_id' => $term->term_id,
                ]
            );
        }
    }

    // Delete taxonomy.
    $wpdb->delete(
        $wpdb->term_taxonomy,
        [
            'taxonomy' => 'includes',
        ],
        [
            '%s',
        ]
    );

    // Get posts.
    $includesPosts = (array) get_posts(
        [
            'posts_per_page' => -1,
            'fields' => 'ids',
            'post_type' => 'includes',
            'post_status' => [
                'publish',
                'pending',
                'draft',
                'auto-draft',
                'future',
                'private',
                'inherit',
                'trash',
            ],
        ]
    );

    // Delete post meta and post.
    if (true !== empty($includesPosts)) {
        foreach ($includesPosts as $includesPostID) {
            \delete_post_meta((int) $includesPostID, 'includes_code');
            \wp_delete_post((int) $includesPostID, true);
        }
    }

    // Get all saved options.
    $allOptions = wp_load_alloptions();

    // Delete all possible options.
    foreach ((array) $allOptions as $slug => $values) {
        // Mostly useful for development.
        if (true === str_contains($slug, 'includes')) {
            \delete_option($slug);
        }
    }

    return;
}
