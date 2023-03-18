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

$menuPosition = \Includes\Option\setting('menu_position');
?>
<section>
<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
	<?php
\wp_nonce_field(
    'includes_action',
    'includes_nonce'
);
?>
<input type="hidden" name="action" value="update" />
	<h3><?php \esc_html_e('User interface features', 'includes'); ?></h3>
	<hr />

	<ul class="list-group p-0">
		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_viewer" type="checkbox" value="1" id="viewer"<?php checked((bool) 1, \Includes\Option\setting('shortcode_viewer')); ?>>
			<label class="form-check-label fw-bold" for="viewer">
				<?php \esc_html_e('Enable shortcode viewer: Uses an empty template to view/test Includes', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Disable to use theme files', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_fields" type="checkbox" value="1" id="post_type"<?php checked((bool) 1, \Includes\Option\setting('shortcode_fields')); ?>>
			<label class="form-check-label fw-bold" for="post_type">
				<?php \esc_html_e('Enable includes shortcode field(s) on Includes post type view', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Helpful for all users', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item mb-3">
			<input class="form-check-input me-1" name="shortcode_terms" type="checkbox" value="1" id="terms"<?php checked((bool) 1, \Includes\Option\setting('shortcode_terms')); ?>>
			<label class="form-check-label fw-bold" for="terms">
				<?php \esc_html_e('Enable includes shortcode field(s) on category term pages', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Helpful if you use categories', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item my-3">
			<input class="form-check-input me-1" name="shortcode_widget" type="checkbox" value="1" id="widget"<?php checked((bool) 1, \Includes\Option\setting('shortcode_widget')); ?>>
			<label class="form-check-label fw-bold" for="widget">
				<?php \esc_html_e('Enable shortcode widget - a custom widget that renders shortcodes', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Add shortcode(s) to classic widgets. Renders shortcode content in block widgets.', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item my-3">
			<input class="form-check-input me-1" name="shortcode_code" type="checkbox" value="1" id="shortcode"<?php checked((bool) 1, \Includes\Option\setting('shortcode_code')); ?>>
			<label class="form-check-label fw-bold" for="shortcode">
				<?php \esc_html_e('Enable code editor and allow the Includes shortcode to render saved code', 'includes'); ?>
				<span class="description"><?php \esc_html_e('Only use if needed - disabled by default', 'includes'); ?></span>
			</label>
		</li>

		<li class="list-group-item my-3">
			<label class="form-check-label fw-bold" for="menu_position">
				<?php \esc_html_e('Includes menu position', 'includes'); ?><br />
				<select name="menu_position" id="menu_position" class="form-select mt-1" aria-label="<?php \esc_html_e('Select a custom menu position', 'includes'); ?>">
					<option selected><?php \esc_html_e('Menu positions', 'includes'); ?></option>
					<option value="1" <?php selected($menuPosition, 1); ?>><?php \esc_html_e('Above Dashboard', 'includes'); ?></option>
					<option value="2" <?php selected($menuPosition, 2); ?>><?php \esc_html_e('Below Dashboard', 'includes'); ?></option>
					<option value="5" <?php selected($menuPosition, 5); ?>><?php \esc_html_e('Below Posts', 'includes'); ?></option>
					<option value="10" <?php selected($menuPosition, 10); ?>><?php \esc_html_e('Below Media', 'includes'); ?></option>
					<option value="20" <?php selected($menuPosition, 20); ?>><?php \esc_html_e('Below Pages', 'includes'); ?></option>
					<option value="25" <?php selected($menuPosition, 25); ?>><?php \esc_html_e('Below comments', 'includes'); ?></option>
					<option value="65" <?php selected($menuPosition, 65); ?>><?php \esc_html_e('Below Plugins', 'includes'); ?></option>
					<option value="70" <?php selected($menuPosition, 70); ?>><?php \esc_html_e('Below Users', 'includes'); ?></option>
					<option value="75" <?php selected($menuPosition, 75); ?>><?php \esc_html_e('Below Tools', 'includes'); ?></option>
					<option value="80" <?php selected($menuPosition, 80); ?>><?php \esc_html_e('Below Settings', 'includes'); ?></option>
				</select>
			</label>
		</li>
	</ul>

	<h3 class="mt-4"><?php \esc_html_e('Enhance WordPress features', 'includes'); ?></h3>
	<hr />

	<ul class="list-group p-0">
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
	</ul>

	<p class="submit"><input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php \esc_html_e('save settings', 'includes'); ?>"></p>
</form>
</section>

<?php
    if (true !== empty(\Includes\queryString('all'))) {
        $allSettings = \Includes\Option\all();
        $countSettings = (true !== empty($allSettings)) ? (int) count($allSettings) + 4 : 0;
        ?>
<section class="mt-5">
	<h3><?php \esc_html_e('All saved plugin settings', 'includes'); ?></h3>
	<hr />

	<div class="form-group">
		<textarea class="form-control form-control-sm" rows="<?php echo $countSettings; ?>"><?php if (true !== empty($allSettings)) {
		    print_r($allSettings);
		}?></textarea>
	</div>
</section>
<?php
    }
