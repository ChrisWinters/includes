<?php
/**
 * Private post type template viewer.
 */
if (false === defined('ABSPATH')) {
    exit;
}

// Logged in and administrators only.
if (
    true !== \is_user_logged_in() ||
    true !== \current_user_can('administrator')
) {
    \wp_safe_redirect(\get_bloginfo('url'));
    exit;
}

$postID = \get_the_ID();
?>
<!DOCTYPE html>
<html <?php \language_attributes(); ?> class="no-js no-svg">
<head>
<title></title>
<meta charset="<?php \bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php \wp_head(); ?>
</head>
<body <?php \body_class('includes'); ?>>
<?php
// Plugin hook before Include content.
do_action('includes_before_posttype_content');

if ('code' === filter_input(INPUT_GET, 'type')) {
    $content = \get_post_meta($postID, 'includes_code', true);

    try {
        eval('?>'.html_entity_decode($content, ENT_QUOTES | ENT_XML1, 'UTF-8'));
    } catch (Throwable $t) {
        $content = null;
    }
} else {
    $content = \apply_filters(
        'the_content',
        \get_post_field(
            'post_content',
            $postID
        )
    );

    echo \wp_kses_post($content);
}

// Plugin hook after Include content.
do_action('includes_after_posttype_content');

\wp_footer();
?>
</body>
</html>
