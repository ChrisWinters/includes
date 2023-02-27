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
$postType = \get_post_type($postID);

if ('includes' !== $postType) {
    \wp_safe_redirect(\get_bloginfo('url'));
    exit;
}

// Removes admin bar.
\add_filter('show_admin_bar', '__return_false');
\show_admin_bar(false);

// Replaces double line-breaks with paragraph elements.
\remove_filter('the_content', 'wpautop');
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
	<body <?php \body_class(); ?>>
<?php
if (filter_input(INPUT_GET, 'type') === 'code') {
    $content = \get_post_meta($postID, 'code', true);

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

\wp_footer();
?>
</body>
</html>
