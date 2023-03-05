<?php
/**
 * Global function.
 */

namespace Includes\Query;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Query the WordPress Query class and return results.
 *
 * @param string $queryArgs WP Query Arguments.
 * @param bool   $code      True to enable code
 */
function results(array $queryArgs, bool $code = false): string
{
    $query = new \WP_Query($queryArgs);

    if (true === $query->have_posts()) {
        ob_start();

        while ($query->have_posts()) {
            $query->the_post();

            if (true === $code) {
                // Get includes code content.
                $content = \get_post_meta($query->posts[0]->ID, 'includes_code', true);

                if (true === empty($content)) {
                    return '';
                }

                try {
                    // Display code content from post slug.
                    eval('?>'.html_entity_decode($content, ENT_QUOTES | ENT_XML1, 'UTF-8'));
                } catch (\Throwable $t) {
                    return '';
                }
            } else {
                // Display editor content from post slug.
                \the_content();
            }
        }

        // Clear custom query.
        $query->reset_postdata();

        return ob_get_clean();
    }
}
