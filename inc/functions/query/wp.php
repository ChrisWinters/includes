<?php
/**
 * Global function.
 */

namespace Includes\Query;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Query the WordPress Query class.
 *
 * @param string $queryArgs WP Query Arguments.
 * @param bool   $code      True to enable code
 */
function wp(array $queryArgs, bool $code = false): string
{
    $query = new \WP_Query($queryArgs);

    if (true === $query->have_posts()) {
        ob_start();

        while ($query->have_posts()) {
            $query->the_post();

            if (true === $code) {
                $content = \get_post_meta($query->posts[0]->ID, 'includes-code', true);

                if (true === empty($content)) {
                    return '';
                }

                try {
                    eval('?>'.html_entity_decode($content, ENT_QUOTES | ENT_XML1, 'UTF-8'));
                } catch (\Throwable $t) {
                    return '';
                }
            } else {
                \the_content();
            }
        }

        $query->reset_postdata();

        return ob_get_clean();
    }
}
