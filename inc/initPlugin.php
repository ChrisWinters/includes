<?php
/**
 * Global function.
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Init global plugin features.
 */
function initPlugin(): void
{
    // Register includes post type.
    \register_post_type(
        'includes',
        \Includes\Args\postType()
    );

    // Register includes taxonomy.
    \register_taxonomy(
        'includes',
        [
            'includes',
        ],
        \Includes\Args\taxonomy()
    );

    // Shortcode: [includes]
    // Shortcode: [includes code=true]
    \add_shortcode(
        'includes',
        '\Includes\Shortcode\includes'
    );

    // Legacy shortcode: [code]
    \add_shortcode(
        'includes',
        '\Includes\Shortcode\code'
    );

    // Inject viewer into template include path.
    \Includes\Filter\template();

    // Allow includes shortcode in featured areas.
    \Includes\Filter\menuItems();
    \Includes\Filter\postTitles();
    \Includes\Filter\widgetText();
    \Includes\Filter\widgetTitles();

    // Remove includes post type from frontend search query.
    \add_action(
        'pre_get_posts',
        '\Includes\Query\siteSearch'
    );
}