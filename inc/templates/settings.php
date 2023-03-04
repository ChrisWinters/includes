<?php
/**
 * Plugin admin template: settings|default tab.
 *
 * @include /inc/functions/plugin-admin/view/includeTemplates.php
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<section>
	<h2 class="h3"><?php \esc_html_e('Optional plugin settings', 'includes'); ?></h2>

<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
	<?php
\wp_nonce_field(
    'includes_action',
    'includes_nonce'
);
?>
<input type="hidden" name="action" value="update" />
	<ul class="list-group p-0">
		<li class="list-group-item my-3">
			<input class="form-check-input me-1" name="shortcode_code" type="checkbox" value="1" id="shortcode"<?php checked((bool) 1, \Includes\Option\setting('shortcode_code')); ?>>
			<label class="form-check-label fw-bold" for="shortcode">
				<?php \esc_html_e('Enable code editor and allow the Includes shortcode to render saved code', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Only use if needed', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_terms" type="checkbox" value="1" id="terms"<?php checked((bool) 1, \Includes\Option\setting('shortcode_terms')); ?>>
			<label class="form-check-label fw-bold" for="terms">
				<?php \esc_html_e('Enable includes shortcode field(s) on category term pages', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Helpful if you use categories', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_posts_pages" type="checkbox" value="1" id="posts_pages"<?php checked((bool) 1, \Includes\Option\setting('shortcode_posts_pages')); ?>>
			<label class="form-check-label fw-bold" for="posts_pages">
				<?php \esc_html_e('Allow "slugs" from posts and pages to be used by the Includes shortcode', 'includes'); ?>
				<span class="description"><?php \esc_html_e('If used, test to ensure content works as expected', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_post_titles" type="checkbox" value="1" id="post_titles"<?php checked((bool) 1, \Includes\Option\setting('shortcode_post_titles')); ?>>
			<label class="form-check-label fw-bold" for="post_titles">
				<?php \esc_html_e('Allow post and page titles to render shortcodes', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Only enable if needed, requires extra resources', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_menus" type="checkbox" value="1" id="menus"<?php checked((bool) 1, \Includes\Option\setting('shortcode_menus')); ?>>
			<label class="form-check-label fw-bold" for="menus">
				<?php \esc_html_e('Allow menus to render shortcodes', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Only enable if needed, requires extra resources', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_widget_titles" type="checkbox" value="1" id="widgets"<?php checked((bool) 1, \Includes\Option\setting('shortcode_widget_titles')); ?>>
			<label class="form-check-label fw-bold" for="widgets">
				<?php \esc_html_e('Allow widgets to render shortcodes', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Only enable if needed, requires extra resources', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="disable_viewer" type="checkbox" value="1" id="viewer"<?php checked((bool) 1, \Includes\Option\setting('disable_viewer')); ?>>
			<label class="form-check-label fw-bold" for="viewer">
				<?php \esc_html_e('Disable shortcode viewer: Use theme template files to view saved shortcode data', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Enable/disable as needed', 'includes'); ?></span>
			</label>
		</li>
	</ul>
	<p class="submit"><input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php \esc_html_e('save settings', 'includes'); ?>"></p>
</form>
</section>
