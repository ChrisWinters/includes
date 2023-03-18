<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\Taxonomy;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Taxonomy form field for includes shortcode.
 *
 * @param object $termObject WordPress term object.
 */
function formField(object $termObject): void
{
    if ('includes' !== \Includes\queryString('taxonomy')) {
        return;
    }

    if (true === empty($termObject->slug)) {
        return;
    }

    if (true !== (bool) \Includes\Option\setting('shortcode_terms')) {
        return;
    }

    $slugShortcode = htmlentities('[includes category="'.esc_attr($termObject->slug).'"]', ENT_QUOTES);
    $codeShortcode = htmlentities('[includes type="code" category="'.esc_attr($termObject->slug).'"]', ENT_QUOTES);
    $pluginDocsUrl = get_bloginfo('url').'/wp-admin/edit.php?post_type=includes&page=includes&tab=documents#atts';
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label><?php esc_html_e('Includes shortcode', 'includes'); ?></label>
        </th>
        <td>
            <p><input type="text" name="" value="<?php echo esc_html($slugShortcode); ?>" /></p>
            <?php if ((bool) 1 === \Includes\Option\setting('shortcode_code')) { ?>
                <p><input type="text" name="" value="<?php echo esc_html($codeShortcode); ?>" /></p>
            <?php } ?>
            <p class="description">&bull; <a href="<?php echo esc_url($pluginDocsUrl); ?>"><?php esc_html_e('Shortcode Attributes', 'includes'); ?></a></p>
        </td>
    </tr>
    <?php
}
