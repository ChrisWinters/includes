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
	<h3><?php \esc_html_e('Includes Help', 'includes'); ?></h3>
	<div class="inside" style="clear:both;padding-top:1px;">
		<div class="para">
			<ul class="list-group list-group-flush p-0">
				<li class="list-group-item"><a href="#" target="_blank"><?php \esc_html_e('Pending...', 'includes'); ?></a></li>
			</ul>
		</div>
	</div>
</aside>
