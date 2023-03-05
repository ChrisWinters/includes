<?php
/**
 * Plugin admin template part.
 *
 * @include /inc/templates/footer.php
 */

namespace Includes;

if (false === defined('ABSPATH')) {
    exit;
}
?>
<aside class="postbox">
	<h3><?php echo \esc_html(\Includes\settings('plugin_name')); ?></h3>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul class="list-group list-group-flush p-0">
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/includes" target="_blank"><?php \esc_html_e('Plugin Home Page', 'includes'); ?></a></li>
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/includes/issues" target="_blank"><?php \esc_html_e('Bugs & Feature Request', 'includes'); ?></a></li>
			</ul>
		</div>
	</div>
</aside>

<aside class="postbox">
	<h3><?php \esc_html_e('Documentation', 'includes'); ?></h3>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul class="list-group list-group-flush p-0">
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/includes/wiki/1-Shortcode-and-attributes" target="_blank"><?php \esc_html_e('Shortcode and attributes', 'includes'); ?></a></li>
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/includes/wiki/2-Plugin-settings" target="_blank"><?php \esc_html_e('Plugin settings', 'includes'); ?></a></li>
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/includes/wiki/3-Usage-examples" target="_blank"><?php \esc_html_e('Usage examples', 'includes'); ?></a></li>
				<li class="list-group-item"><a href="https://github.com/ChrisWinters/includes/wiki/4-Preview-template" target="_blank"><?php \esc_html_e('Preview template', 'includes'); ?></a></li>
			</ul>
		</div>
	</div>
</aside>
