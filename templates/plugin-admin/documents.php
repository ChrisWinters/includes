<?php
/**
 * Plugin Admin Template
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Escaping for HTML blocks.
 * https://developer.wordpress.org/reference/functions/esc_html/
 *
 * Checks and cleans a URL.
 * https://developer.wordpress.org/reference/functions/esc_url/
 *
 * Display translated text.
 * https://developer.wordpress.org/reference/functions/_e/
 */
?>
<div class="text-dark font-weight-bold p-0 m-0 h2"><?php esc_html_e( 'Plugin Documentation', 'includes' ); ?></div>

<p><?php esc_html_e( 'WordPress Plugin - Includes for WordPress - Include Content Anywhere!', 'includes' ); ?>
</p>

<hr class="hr" />

<h3 class="text-center"><?php esc_html_e( 'Table of Contents', 'includes' ); ?></h3>

<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<p class="text-center">[<a href="#basics"><?php esc_html_e( 'Basics', 'includes' ); ?></a>] [<a href="#atts"><?php esc_html_e( 'Shortcode Attributes', 'includes' ); ?></a>] [<a href="#settings"><?php esc_html_e( 'Plugin Settings', 'includes' ); ?></a>] [<a href="#code"><?php esc_html_e( 'Code Shortcode', 'includes' ); ?></a>] [<a href="#includes"><?php esc_html_e( 'Includes within Includes', 'includes' ); ?></a>] [<a href="#examples"><?php esc_html_e( 'Example Uses', 'includes' ); ?></a>] [<a href="#importexport"><?php esc_html_e( 'Import/Export', 'includes' ); ?></a>] [<a href="#template"><?php esc_html_e( 'Post Type Template', 'includes' ); ?></a>] [<a href="#hooks"><?php esc_html_e( 'Action Hooks', 'includes' ); ?></a>] [<a href="#bodyclass"><?php esc_html_e( 'Body Class', 'includes' ); ?></a>]</p>
<?php } else { ?>
	<p class="text-center">[<a href="#basics"><?php esc_html_e( 'Basics', 'includes' ); ?></a>] [<a href="#settings"><?php esc_html_e( 'Plugin Settings', 'includes' ); ?></a>] [<a href="#includes"><?php esc_html_e( 'Includes within Includes', 'includes' ); ?></a>] [<a href="#examples"><?php esc_html_e( 'Example Uses', 'includes' ); ?></a>] [<a href="#template"><?php esc_html_e( 'Post Type Template', 'includes' ); ?></a>] [<a href="#hooks"><?php esc_html_e( 'Action Hooks', 'includes' ); ?></a>] [<a href="#bodyclass"><?php esc_html_e( 'Body Class', 'includes' ); ?></a>]</p>
<?php } ?>


<hr class="mb-4 w-75" id="basics" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'The Basics', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<?php
if ( ! includes_fs()->is_premium() ) {
	?>
		<p><?php esc_html_e( 'Once activated the plugin creates a custom post type, taxonomy, and shortcodes; All other plugin related settings are inactive by default.', 'includes' ); ?>
</p>
	<?php
}

if ( ( includes_fs()->can_use_premium_code() ) ) {
	?>
		<p><?php esc_html_e( 'Once activated the plugin creates a custom post type, taxonomy, and customizable shortcodes; All other plugin related settings are inactive by default.', 'includes' ); ?>
</p>
	<?php
}
?>

<p>
	<?php
	echo sprintf(
		/* Translators: %1$s Open link. %2$s Close link. */
		esc_html__( 'To use the plugin; publish an Includes post ( Includes menu > %1$sAdd New%2$s link ). Then use the provided shortcode to display the content within other Includes, posts, pages, widgets, menus, templates, etc.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'post-new.php?post_type=includes' ) ) . '" target="_blank">',
		'</a>'
	);
	?>
</p>

<?php
if ( ! includes_fs()->is_premium() ) {
	?>
<p>
	<?php
	echo sprintf(
		/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
		esc_html__( 'The Includes shortcode looks like %1$spost-slug%2$s. The \'slug\' relates to the post slug for the published Include.', 'includes' ),
		'<code>[includes slug="',
		'"]</code>'
	);
	?>
</p>
	<?php
}
?>

<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
			esc_html__( 'The default shortcode looks like %1$spost-slug%2$s and the default category shortcode looks like %1$scategory-slug%2$s. Both the post and category slugs relate to posts/categories published under the Includes post type.', 'includes' ),
			'<code>[includes slug="',
			'"]</code>',
			'<code>[includes category="',
			'"]</code>'
		);
		?>
	</p>

	<hr class="my-4 w-75" id="atts" />

	<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Shortcode Attributes', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s Shortcode Example. %2$s Shortcode Example. %3$s Shortcode Example. %4$s Shortcode Example. */
			esc_html__( 'The %1$s shortcode ( and if enabled the %2$s shortcode ) requires either the %3$s or %4$s attributes for the shortcode to function property.', 'includes' ),
			'<code>[includes]</code>',
			'<code>[code]</code>',
			'<code>slug</code>',
			'<code>category</code>'
		);
		?>
	</p>

	<p><?php esc_html_e( 'Default shortcodes', 'includes' ); ?>:<br />
		<?php
			echo sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$spost-slug%2$s', 'includes' ),
				'<code>[includes slug="',
				'"]</code>'
			);
		?>

		<br />

		<?php
			echo sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$scategory-slug%2$s', 'includes' ),
				'<code>[includes category="',
				'"]</code>'
			);
		?>
	</p>

	<p><?php esc_html_e( 'If enabled', 'includes' ); ?>:<br />
		<?php
			echo sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$spost-slug%2$s', 'includes' ),
				'<code>[code slug="',
				'"]</code>'
			);
		?>

		<br />

		<?php
			echo sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$scategory-slug%2$s', 'includes' ),
				'<code>[code category="',
				'"]</code>'
			);
		?>
	</p>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
			esc_html__( 'Additionally, when the %1$scategory-slug%2$s shortcode is used two extra attributes can be applied: %3$s and %4$s', 'includes' ),
			'"category" <code>[includes category="',
			'"]</code>',
			'<code>orderby</code>',
			'<code>order</code>'
		);
		?>
	</p>

		<?php
			$includes_docs_combined_attrs = sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$scategory-slug%2$s', 'includes' ),
				'<code>[includes category="',
				'" orderby="date" order="asc"]</code>'
			);
		?>

	<p><b><?php esc_html_e( 'Combined Attributes', 'includes' ); ?></b>: <?php echo wp_kses_post( $includes_docs_combined_attrs ); ?></p>

		<?php
			$includes_docs_orderby = sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$scategory-slug%2$s', 'includes' ),
				'<code>[includes category="',
				'" orderby="rand"]</code>'
			);
		?>

	<p><b><?php esc_html_e( 'Orderby', 'includes' ); ?></b>: <?php echo wp_kses_post( $includes_docs_orderby ); ?> </p>

		<?php
			$includes_docs_no_order = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | No Order', 'includes' ),
				'<code>none</code>'
			);

			$includes_docs_post_id = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Post ID', 'includes' ),
				'<code>ID</code>'
			);

			$includes_docs_published_date = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Published Date', 'includes' ),
				'<code>date</code>'
			);

			$includes_docs_post_title = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Post Title', 'includes' ),
				'<code>title</code>'
			);

			$includes_docs_post_slug = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Post Slug', 'includes' ),
				'<code>slug</code>'
			);

			$includes_docs_randomize_order = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Randomize Order', 'includes' ),
				'<code>rand</code>'
			);

			$includes_docs_post_modified_date = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Post Modified Date', 'includes' ),
				'<code>modified</code>'
			);

		?>

	<ol>
		<li><?php echo wp_kses_post( $includes_docs_no_order ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_post_id ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_published_date ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_post_title ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_post_slug ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_randomize_order ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_post_modified_date ); ?></li>
	</ol>

		<?php
			$includes_docs_order = sprintf(
				/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
				esc_html__( '%1$scategory-slug%2$s', 'includes' ),
				'<code>[includes category="',
				'" order="asc"]</code>'
			);
		?>

	<p><b><?php esc_html_e( 'Order', 'includes' ); ?></b>: <?php echo wp_kses_post( $includes_docs_order ); ?></p>

		<?php
			$includes_docs_decending_order = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Descending order ( default )', 'includes' ),
				'<code>desc</code>'
			);

			$includes_docs_ascending_order = sprintf(
				/* Translators: %1$s Attribute. */
				esc_html__( '%1$s | Ascending Order', 'includes' ),
				'<code>asc</code>'
			);
		?>

	<ol>
		<li><?php echo wp_kses_post( $includes_docs_decending_order ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_ascending_order ); ?></li>
	</ol>

		<?php
			$includes_docs_attribute_note = sprintf(
				/* Translators: %1$s Attribute. %2$s Attribute. %3$s Attribute. %4$s Attribute. */
				esc_html__( 'The %1$s attribute does not use the %2$s, %3$s, or %4$s attributes as it only ever displays the content related to the slug.', 'includes' ),
				'<code>slug</code>',
				'<code>category</code>',
				'<code>orderby</code>',
				'<code>order</code>'
			);
		?>

	<p><b><?php esc_html_e( 'Note', 'includes' ); ?></b>: <?php echo wp_kses_post( $includes_docs_attribute_note ); ?></p>

	<?php
}
?>

<hr class="my-4 w-75" id="settings" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Plugin Settings', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<p>
	<?php
	echo sprintf(
		/* Translators: %1$s Open link. %2$s Close link. */
		esc_html__( 'Click the %1$sSettings Tab%2$s to adjust optional plugin settings.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'edit.php?page=includes&tab=settings&post_type=includes' ) ) . '" target="_blank">',
		'</a>'
	);
	?>
</p>

<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
			esc_html__( 'While optional, it is recommended you enable "Display Shortcodes on Category Term Pages" to display the %1$scategory-slug%2$s shortcode on category term pages. Once enabled you can view the shortcode by opening ( Includes menu > Categories menu link ) then click the edit link for a category. The shortcode input box( es ) will display at the bottom of the form list.', 'includes' ),
			'<code>[includes category="',
			'"]</code>'
		);
		?>
	</p>


	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'PHP Memory Limits', 'includes' ); ?></h4>

	<p><?php esc_html_e( 'Other than the mentioned setting above, all other settings will consume more PHP memory, while minor it is still more. The more features that get enabled, the more memory that PHP will use. If your hosting provider, theme or other plugins sometimes reach PHP memory limits, then you should avoid using the other features or at least use them sparingly.', 'includes' ); ?>
	</p>

	<hr class="my-4 w-75" id="code" />

	<?php
		$includes_docs_code_shortcode = sprintf(
			/* Translators: %1$s Shortcode Example. */
			esc_html__( 'The %1$s Shortcode', 'includes' ),
			'<code>[code]</code>'
		);
	?>

	<h3 class="text-secondary font-weight-bold h3"><?php echo wp_kses_post( $includes_docs_code_shortcode ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

	<p><?php esc_html_e( 'Only enable this feature if you are actively using it - Super Admins Only!', 'includes' ); ?>
	</p>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s Shortcode Example. */
			esc_html__( 'If enabled, the custom shortcode  %1$s can be used with the same attributes as the Includes plugin with the added benefit of using code/scripts, etc rather than only allowed HTML. A new metabox will appear under the main editor box named "Includes code ( php, jquery, etc )." where the custom content can be added. As well, if enabled, a new input box with the  %1$s shortcode will display on both the Includes listing page( s ) and the category meta page.', 'includes' ),
			'<code>[code]</code>'
		);
		?>
	</p>

	<p><b><?php esc_html_e( 'WARNING', 'includes' ); ?></b>: <?php esc_html_e( 'The code you enter into "code" editor is raw unfiltered data for both input and output!!!', 'includes' ); ?>
	</p>


	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Inline JavaScript', 'includes' ); ?></h4>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s JavaScript Attribute. %2$s JavaScript Attribute. */
			esc_html__( 'Inline JavaScript will parse in its location before the rest of the page below it loads. This issue can be solved with the %1$s attribute, however the %2$s attribute also needs to be present, which inline JavaScript does not have. You can solve this issue by base64 encoding the JavaScript code ( not the opening and closing script tags ) and then sourcing the encoded text with the %1$s attribute.', 'includes' ),
			'<code>defer</code>',
			'<code>src</code>'
		);
		?>
	</p>

	<p>&bull; 
		<?php
		echo sprintf(
			/* Translators: %1$s Open Link. %1$s Close Link. */
			esc_html__( 'Use the online tool %1$sBase64Code%2$s to encode your scripts.', 'includes' ),
			'<a href="' . esc_url( 'https://www.base64code.com/encode' ) . '" target="_blank">',
			'</a>'
		);
		?>
	</p>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s JavaScript Example. */
			esc_html__( 'Using the example below, ignore the opening and closing script tags and encode the JavaScript parts: %1$s', 'includes' ),
			'<code>alert( \'boo!\' );</code>'
		);
		?>
	</p>

	<p><code><?php echo esc_html( '<script>' ); ?></code><br />
	<b><code><?php echo esc_html( 'alert( \'boo!\' );' ); ?></code></b><br />
	<code><?php echo esc_html( '</script>' ); ?></code></p>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s JavaScript Example. %2$s Encoded String Example. */
			esc_html__( 'Once encoded, %1$s encodes to %2$s', 'includes' ),
			'<code>alert( \'boo!\' );</code>',
			'<code>YWxlcnQoJ2JvbyEnKTs=</code>'
		);
		?>
	</p>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s Encoded String Example. %2$s JavaScript Attributes.  */
			esc_html__( 'The encoded text %1$s is then added to the %2$s attribute. In the example below replace ENCODED-JAVASCRIPT with the proper encoded text.', 'includes' ),
			'<code>YWxlcnQoJ2JvbyEnKTs=</code>',
			'<code>' . esc_html( '<script>' ) . '</code> <code>src</code>'
		);
		?>
	</p>

	<p>
		<?php
		echo sprintf(
			/* Translators: %1$s JavaScript Open Tag. %2$s JavaScript Close Tag.  */
			esc_html__( htmlentities( '%1$sENCODED-JAVASCRIPT%2$s' ), 'includes' ),
			esc_html( '<code><script src="data:text/javascript;base64,' ),
			esc_html( '" defer></script></code>' )
		);
		?>
	</p>

	<p><?php esc_html_e( 'Using the alert example the script line becomes', 'includes' ); ?>:</p>

	<p><code><?php echo esc_html( htmlentities( '<script src="data:text/javascript;base64,YWxlcnQoJ2JvbyEnKTs=" defer></script>' ) ); ?></code></p>

	<p><?php esc_html_e( 'Both snips will function the same ( an alert box will pop saying boo! ) the only difference is the defer tag which will allow the page to fully load before the script runs.', 'includes' ); ?></p>
<?php } ?>

<hr class="my-4 w-75" id="includes" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Includes within Includes', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<p>
	<?php
	esc_html_e( 'Includes within Includes works when stacking one level deep in direct line ( parent -> child or child -> parent ). In rare cases, stacking Includes can cause issues with some themes and may consume more memory than your host provides - stack only when needed!', 'includes' );
	?>
</p>

<p>
	<?php
	esc_html_e( 'A typical use case would be injecting html blocks into to a page to complete the document. For example, Includes for an opt-in form ( the child ), is included within a homepage Include ( the parent ). The parents Includes shortcode is then added to the actual published homepage post - and not another Include. This is a simple child -> parent stack.', 'includes' );
	?>
</p>

<p>
	<?php
	esc_html_e( 'Keeping the example in mind above, an incorrect usage example would be adding another child Include inside the opt-in form Include. Stacked together this would create child->child->parent, which the Plugin will not render.', 'includes' );
	?>
<p>

<p>
	<?php
	esc_html_e( 'The parent Include can include multiple child Includes, as long as the child Includes are not stacked within each other.', 'includes' );
	?>
</p>

<hr class="my-4 w-75" id="examples" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Includes Usage Examples', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<p><?php esc_html_e( '>Use an Include anytime you repeat blocks of duplicate content across different pages, widgets, menus or come up with your own specialized needs.', 'includes' ); ?></p>



<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Content Rotation', 'includes' ); ?></h4>

	<p><?php esc_html_e( 'Includes within categories can be rotated using both the category and orderby attributes together.', 'includes' ); ?></p>

	<strong><p><?php esc_html_e( 'Example Shortcode', 'includes' ); ?></strong>: [includes category="category-slug" orderby="rand"]</p>

	<?php
		$includes_docs_content_rotation = sprintf(
			/* Translators: %1$s Open link. %2$s Close link. */
			esc_html__( 'Create %1$snew Includes%2$s that will each contain the content to be rotated, assinging each to the same category.', 'includes' ),
			'<a href="' . esc_url( admin_url( 'post-new.php?post_type=includes' ) ) . '" target="_blank">',
			'</a>'
		);
	?>

	<ul>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_content_rotation ); ?>
		<ol>
			<li><?php esc_html_e( 'Set the title to something helpful: "Footer Widget Links - Group 1" or any format you would like to follow.', 'includes' ); ?></li>
			<li><?php esc_html_e( 'Under the Categories Metabox, click + Add New Category and create a custom category to group related items into. Group them based on the location they will be Included at, ie: Sidebar, Footer Right Widget, etc.', 'includes' ); ?></li>
		</ol>
		</li>
	</ul>

	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Automatically Updating/Changing Homepage', 'includes' ); ?></h4>

	<?php
	echo sprintf(
		/* Translators: %1$s Html. %2$s Html. */
		esc_html__( 'This requires %1$sgrouping related homepage Includes into the same category%2$s, %1$sscheduling the Includes for future release%2$s, and using the %1$sIncludes category shortcode%2$s to display the newest homepage Include.', 'includes' ),
		'<i>',
		'</i>'
	);
	?>

	<p><b><?php esc_html_e( 'Step 1', 'includes' ); ?>:</b></p>

		<?php
			$includes_docs_homepage_step_one_a = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Create %1$snew Includes%2$s that will each contain the guts/body of the homepage content, creating unique variations for different promotions, holidays, visual changes, split tests, etc.', 'includes' ),
				'<a href="' . esc_url( admin_url( 'post-new.php?post_type=includes' ) ) . '" target="_blank">',
				'</a>'
			);

			$includes_docs_homepage_step_one_b = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Duplicate the above step( s ) for each new homepage variation. Use the %1$sWordPress.org hosted plugin%2$s to easily Duplicate Posts of any type.', 'includes' ),
				'<a href="' . esc_url( admin_url( 'plugin-install.php?s=duplicate-poste&tab=search&type=term' ) ) . '" target="_blank">',
				'</a>'
			);

			$includes_docs_homepage_step_one_c = sprintf(
				/* Translators: %1$s HTML. %2$s HTML. */
				esc_html__( '%1$sSchedule future updates%2$s for page variations as you would any other post/page. You can also schedule the child Includes to update/change.', 'includes' ),
				'<b>',
				'</b>'
			);


		?>

	<ul>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_homepage_step_one_a ); ?>
			<ol>
				<li><?php esc_html_e( 'Set the title to something helpful: "Homepage - Date | Promo X" or any format you would like to follow.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Modify the post Permalink slug to something short and relevant: promo-x.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Under the Categories Metabox, click + Add New Category and create a custom homepage category to group related homepages into.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Build the page / add some content; temporary text will work for now or copy over your current homepage Page if you already have one.', 'includes' ); ?></li>
			</ol>
		</li>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_homepage_step_one_b ); ?>
			<ol>
				<li><?php esc_html_e( 'Group related custom homepages into the same category.', 'includes' ); ?></li>
				<li><?php echo wp_kses_post( $includes_docs_homepage_step_one_c ); ?></li>
			</ol>
		</li>
	</ul>


	<p><b><?php esc_html_e( 'Step 2', 'includes' ); ?>:</b></p>

		<?php
			$includes_docs_homepage_step_two_a = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Edit your current homepage Page or %1$screate a new homepage Page%2$s that use the Includes category shortcode. Depending on how your homepage setup works, your homepage Page may have HTML ( like containers, etc ) within it or the Includes may contain all of the HTML.', 'includes' ),
				'<a href="' . esc_url( admin_url( 'post-new.php?post_type=page' ) ) . '" target="_blank">',
				'</a>'
			);

			$includes_docs_homepage_step_two_b = sprintf(
				/* Translators: %1$s . %2$s Close link. */
				esc_html__( 'Add the %1$syour-category-slug%2$s to the page body. If you are using the Classic editor click the "Text" tab to paste the shortcode. If you\'re using the Gutenberg editor, click the + icon to Write your story, with the dialog box open select the Widgets panel, then click the Shortcode icon and enter the entire Includes category shortcode into the input box.', 'includes' ),
				'<code>[includes category="',
				'" orderby="date"]</code>'
			);

		?>

	<ul>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_homepage_step_two_a ); ?>
			<ol>
				<li><?php esc_html_e( 'Set the title to "Homepage" and the Permalink slug to lowercase version "homepage."', 'includes' ); ?></li>
				<li><?php echo wp_kses_post( $includes_docs_homepage_step_two_b ); ?>/li>
			</ol>
		</li>
	</ul>


	<p><b><?php esc_html_e( 'Step 3', 'includes' ); ?>:</b></p>

		<?php
			$includes_docs_homepage_step_three_a = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Open %1$sSettings > Reading%2$s.', 'includes' ),
				'<a href="' . esc_url( admin_url( 'options-reading.php' ) ) . '" target="_blank">',
				'</a>'
			);
		?>

	<ul>
		<li>&bull; <?php esc_html_e( 'Set the websites Homepage to use the new Homepage Page.', 'includes' ); ?>
			<ol>
				<li><?php echo wp_kses_post( $includes_docs_homepage_step_three_a ); ?></li>
				<li><?php esc_html_e( 'Under the "Your homepage displays" section, select the "A static page" option, then in the Homepage dropdown select the "Homepage" Page template.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Click the Save Changes button.', 'includes' ); ?></li>
			</ol>
		</li>
	</ul>

	<p><b><?php esc_html_e( 'Step 4', 'includes' ); ?>:</b></p>

	<ul>
		<li>&bull; <?php esc_html_e( 'Validate your Website', 'includes' ); ?>
			<ol>
				<li><?php esc_html_e( 'Check that the homepage is using the Homepage Page template and displaying the Homepage Include.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Inspect the homepage for any unexpected issues; typical issues include wrong sidebar or non-full width template.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Test that the homepage updates by duplicating the current Include Homepage ( Promo X ). Make a minor change ( reword a link/button ), then schedule the modified Include to publish a minute later. Wait a minute, refresh the homepage, and validate the page changed.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'If the page does not update, chances are a cache-plugin is not refreshing when new content is published.', 'includes' ); ?></li>
			</ol>
		</li>
	</ul>

	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Advertisement Rotation', 'includes' ); ?></h4>

	<p><b><?php esc_html_e( 'Step 1', 'includes' ); ?>:</b></p>

		<?php
			$includes_docs_ads_step_one_a = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Create multiple %1$snew Includes%2$s that each contain matching advertisement layouts/formats.', 'includes' ),
				'<a href="' . esc_url( admin_url( 'post-new.php?post_type=includes' ) ) . '" target="_blank">',
				'</a>'
			);

			$includes_docs_ads_step_one_b = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Duplicate the above step( s ) for each new homepage variation. Use the %1$sWordPress.org hosted plugin%2$s to easily Duplicate Posts of any type.', 'includes' ),
				'<a href="' . esc_url( 'https://wordpress.org/plugins/duplicate-post/' ) . '" target="_blank">',
				'</a>'
			);

		?>

	<ul>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_ads_step_one_a ); ?>
			<ol>
				<li><?php esc_html_e( 'Set the title to something helpful: "Sponsor Name - 125x125" or any format you would like to follow.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Modify the post Permalink slug to something short and relevant: sponsor-name-125x125.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Under the Categories Metabox, click + Add New Category and create a custom advertisement category to group related promotions into. Group them based on the location they will be Included at, ie: Sidebar, Footer Right Widget, etc.', 'includes' ); ?></li>
			</ol>
		</li>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_ads_step_one_b ); ?>
			<ol>
				<li><?php esc_html_e( 'Remember to group related advertisements into the same category.', 'includes' ); ?></li>
			</ol>
		</li>
	</ul>

	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Split Testing', 'includes' ); ?></h4>

	<p><?php esc_html_e( 'You are ready to split test if a page/website has enough unique visitors ( naturally via seo, ad buys, social campaigns, etc ) to create sustained sales ( leads, opt-ins, etc ) which are consistent enough to calculate both short and longterm conversion ratios.', 'includes' ); ?></p>

	<p><?php esc_html_e( 'Split tests should either target a single change that repeats ( like all call to action buttons at once ) or the entire page should change in some major way, like a different design, totally new copy, or some other major change.', 'includes' ); ?></p>

	<p><?php esc_html_e( 'For the best split test results the "change" should be above the fold of the page, within the first 560 pixels if possible or at least the first 710 pixels - or the change should repeat throughout the page like a sales call to action button. This is extremely important with lower traffic. For websites with long form copies, more traffic ( 10,000+ daily ) is required properly test such changes and typically more time, but that depends on the total traffic and sales.', 'includes' ); ?>

	<p><?php esc_html_e( 'For SEO driven tests, wait a few days to make sure the change does not fluctuate the listings, if you do get a traffic spike let the page settle for a few days/week( s ) before starting the test.', 'includes' ); ?></p>

	<p><b><?php esc_html_e( 'Step 1', 'includes' ); ?>:</b></p>

		<?php
			$includes_docs_testing_step_one_a = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Create 2+ %1$sIncludes%2$s, each of which will contain a unique copy to split test.', 'includes' ),
				'<a href="' . esc_url( admin_url( 'post-new.php?post_type=includes' ) ) . '" target="_blank">',
				'</a>'
			);

			$includes_docs_testing_step_two_b = sprintf(
				/* Translators: %1$s Open link. %2$s Close link. */
				esc_html__( 'Duplicate the above step( s ) for each new homepage variation. Use the %1$sWordPress.org hosted plugin%2$s to easily Duplicate Posts of any type.', 'includes' ),
				'<a href="' . esc_url( 'https://wordpress.org/plugins/duplicate-post/' ) . '" target="_blank">',
				'</a>'
			);
		?>

	<ul>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_testing_step_one_a ); ?>
			<ol>
				<li><?php esc_html_e( 'Set the title to something helpful: "Promo X - Version 1" or any format you would like to follow.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'If needed, modify the post Permalink slug to something short and relevant: promo-x-version-1.', 'includes' ); ?></li>
				<li><?php esc_html_e( 'Under the Categories Metabox, click + Add New Category and create a custom split test category or a unique category for this test.', 'includes' ); ?></li>
			</ol>
		</li>
		<li>&bull; <?php echo wp_kses_post( $includes_docs_testing_step_two_b ); ?>
			<ol>
				<li><?php esc_html_e( 'Remember to group related split tests into the same category.', 'includes' ); ?></li>
			</ol>
		</li>
	</ul>

	<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Opt-in Form Management and Rotation', 'includes' ); ?></h4>

	<p><?php esc_html_e( 'Using Includes to manage opt-in forms is incredibility helpful. Even simply pasting the opt-in HTML into an Include, and then adding the Include to a widget will allow you to use the full editor to manage the design/html, rather than a small widget.', 'includes' ); ?></p>

	<p><?php esc_html_e( 'However, grouping related opt-in forms into categories will allow you to rotate/update opt-in forms, even split test various form layouts, colors, or promotional messages. Which means means many different opt-in form styles, layouts, etc will need to be created to get the most out of this feature.', 'includes' ); ?></p>

	<p><?php esc_html_e( 'Most variations are simple enough to make, however at some point all of us start to run dry on ideas so below is a few ideas that you can use to help add a few extra forms to the rotation.', 'includes' ); ?></p>

	<ol>
		<li><?php esc_html_e( 'Pre-holiday ( week before ) & and holiday ( week of ) design changes.', 'includes' ); ?></li>
		<li><?php esc_html_e( 'National holiday recognition, ie: national pizza day, bake a cake day, etc.', 'includes' ); ?></li>
		<li><?php esc_html_e( 'Major upcoming sales/promotions, like Black Friday or spring clearance sales.', 'includes' ); ?></li>
		<li><?php esc_html_e( 'Opt-in to get access/download, etc lead generators that are not full time promotions.', 'includes' ); ?></li>
	</ol>

	<?php esc_html_e( 'Forms in different locations ( ie footer vs. sidebar ) should be unique from each other; mix up the promotional hook, the look, design/color, make them unique. While forms within the same category or display location ( ie footer left widget ) might only slightly change; everything is the same other than the labels are inside the form inputs rather than above each input.', 'includes' ); ?></p>
<?php } ?>

<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Other Possible Uses', 'includes' ); ?></h4>

<ol>
	<li><?php esc_html_e( 'Anytime content is duplicated on posts, pages, other post types, etc. Common duplicate content includes custom Author Cards/Bio\'s and Real Estate Disclosure Statements.', 'includes' ); ?></li>
<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<li><?php esc_html_e( 'Create an Includes Widget Category and store all Text/Html Widgets as Includes for easier backup & restore ability.', 'includes' ); ?></li>
<?php } else { ?>
	<li><?php esc_html_e( 'Create Includes to store all Text/Html Widgets as Includes for easier backup & restore ability.', 'includes' ); ?></li>
<?php } ?>
	<li><?php esc_html_e( 'Centralize Store Policies That Repeat On Various Product / Store Pages.', 'includes' ); ?></li>
	<li><?php esc_html_e( 'Centralize Store F.A.Q .\'s That Repeat On Various Product / Store Pages.', 'includes' ); ?></li>
	<li><?php esc_html_e( 'Centralize Advertisement Management For Blog Posts And Pages, Reducing The Need JavaScript.', 'includes' ); ?></li>
<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<li><?php esc_html_e( 'Centralized Various Tracking Codes Used For Everything; homepage rotations, promotions, opt-in form performance, etc.', 'includes' ); ?></li>
<?php } ?>
</ol>

<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<hr class="my-4 w-75" id="importexport" />

	<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Import & Export Settings', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

	<?php
	$includes_docs_possible_a = sprintf(
		/* Translators: %1$s Open link. %2$s Close link. */
		esc_html__( 'To export plugin settings, click the %1$sImport/Export Tab%2$s to view ( optionally email ) exported data of all currently saved plugin settings. Exported settings are base64 encoded JSON setting key name and the value pairs - and can be shared across installs.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'edit.php?page=includes&tab=importexport&post_type=includes' ) ) . '" target="_blank">',
		'</a>'
	);

	$includes_docs_possible_b = sprintf(
		/* Translators: %1$s Open link. %2$s Close link. */
		esc_html__( 'To export Includes posts, open the %1$sTools > Export%2$s menu link. Select "Includes" then click the blue "Download Export File" button.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'export.php' ) ) . '" target="_blank">',
		'</a>'
	);

	$includes_docs_possible_c = sprintf(
		/* Translators: %1$s Open link. %2$s Close link. */
		esc_html__( 'To import Includes posts, open the %1$sTools > Import%2$s menu link. Click "Run Importer" link under the WordPress section. Exported WordPress files will automatically include and import any found Includes.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'import.php' ) ) . '" target="_blank">',
		'</a>'
	);
	?>

	<ol>
		<li><?php echo wp_kses_post( $includes_docs_possible_a ); ?></li>
		<li><?php esc_html_e( 'To import plugin settings, add the base64 encoded string to the Import Settings textarea then click the blue "import settings" button.', 'includes' ); ?></li>
	</ol>

	<ol>
		<li><?php echo wp_kses_post( $includes_docs_possible_b ); ?></li>
		<li><?php echo wp_kses_post( $includes_docs_possible_c ); ?></li>
	</ol>
<?php } ?>

<h4 class="text-black-50 font-weight-bold h5"><?php esc_html_e( 'Delete All Settings', 'includes' ); ?></h4>

<p><?php esc_html_e( 'No plugin settings/posts, etc will be deleted if the plugin is deactivated/uninstalled - all settings/posts must be manually deleted.', 'includes' ); ?>
</p>

	<?php
	$includes_docs_to_delete = sprintf(
		/* Translators: %1$s Open link. %2$s Close link. %3$s Open link. %4$s Close link. */
		esc_html__( 'To delete all Includes posts: the simplest way is to manually delete the %1$sIncludes%2$s, otherwise download the free plugin %3$sBulk Delete%4$s, activate and access the "Bulk Delete Posts" menu link, then scroll down to the "By Taxonomy" section. Select the Includes post type then click the Bulk Delete button.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'edit.php?post_type=includes' ) ) . '" target="_blank">',
		'</a>',
		'<a href="' . esc_url( admin_url( 'plugin-install.php?s=bulk+delete&tab=search&type=term' ) ) . '" target="_blank">',
		'</a>'
	);
	?>

<ol>
<?php if ( ( includes_fs()->can_use_premium_code() ) ) { ?>
	<li><?php esc_html_e( 'To delete all plugin settings: scroll down to the bottom of the Import/Export page and click the "delete all settings" button, then click the popup Ok button to confirm your selection.', 'includes' ); ?></li>
<?php } else { ?>
	<li><?php esc_html_e( 'To delete all plugin settings: scroll down to the bottom of the settings page and click the "delete all settings" button, then click the popup Ok button to confirm your selection.', 'includes' ); ?></li>
<?php } ?>
	<li><?php echo wp_kses_post( $includes_docs_to_delete ); ?></li>
</ol>


<hr class="my-4 w-75" id="template" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Post Type Template', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<p><?php esc_html_e( 'The custom post type template is viewable only to logged in administrators. The purpose of the template is to show off an internal example of saved Includes to ensure the Include works as expected.', 'includes' ); ?></p>

	<?php
	$includes_template_hierarchy = sprintf(
		/* Translators: %1$s Open link. %2$s Close link. %3$s Open link. %4$s Close link. */
		esc_html__( 'Advanced users can override the default template %1$sposttype-includes.php%2$s by following the WordPress %3$stemplate hierarchy%4$s for themes.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'https://github.com/ChrisWinters/includes/blob/master/templates/posttype-includes.php' ) ) . '" target="_blank">',
		'</a>',
		'<a href="' . esc_url( admin_url( 'https://wphierarchy.com/' ) ) . '" target="_blank">',
		'</a>'
	);
	?>

<p><?php echo wp_kses_post( $includes_template_hierarchy ); ?></p>

<p>** <em><?php esc_html_e( 'Overriding the default template should only be done by advanced users that understand exactly what to do with the limited information above. No support is provided for this feature past coded functionality within the plugin. Override at your own risk.', 'includes' ); ?></em></p>


<hr class="my-4 w-75" id="hooks" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Action Hooks', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

	<?php
	$includes_action_hooks_template = sprintf(
		/* Translators: %1$s Open link. %2$s Close link. %3$s Open link. %4$s Close link. */
		esc_html__( 'The %1$sposttype-includes.php%2$s template has two custom action hooks that can be used to hook your own custom functions to.', 'includes' ),
		'<a href="' . esc_url( admin_url( 'https://github.com/ChrisWinters/includes/blob/master/templates/posttype-includes.php' ) ) . '" target="_blank">',
		'</a>'
	);
	?>

<p><?php echo wp_kses_post( $includes_action_hooks_template ); ?></p>

<ul>
	<li><b>includes_before_posttype_content</b> <?php esc_html_e( 'Before all content (directly after the opened body tag)', 'includes' ); ?></li>
	<li><b>includes_after_posttype_content</b> <?php esc_html_e( 'After all content (directly before the closed body tag)', 'includes' ); ?></li>
</ul>

<p><b><code><?php echo esc_html( 'add_action( \'includes_before_posttype_content\', \'your_first_function_name\' );' ); ?></code></b><br />
<b><code><?php echo esc_html( 'add_action( \'includes_after_posttype_content\', \'your_second_function_name\' );' ); ?></code></b></p>

<p><b><?php esc_html_e( 'Example function', 'includes' ); ?>:</b> <?php esc_html_e( 'Modify as needed and add to your themes function.php file.', 'includes' ); ?></p>

<p><b><code><?php echo esc_html( 'function prefix_before_content() {' ); ?></code></b><br />
<b><code class="pl-4"><?php echo esc_html( 'if ( false === is_admin() || \'includes\' !== filter_input( INPUT_GET, \'post_type\' ) ) { return; }' ); ?></code></b><br />
<b><code class="pl-4"><?php echo esc_html( 'echo wp_kses_post( \'<div class="container">\' );' ); ?></code></b><br />
<b><code><?php echo esc_html( '}' ); ?></code></b><br />
<b><code><?php echo esc_html( 'add_action( \'includes_before_posttype_content\', \'prefix_before_content\' );' ); ?></code></b></p>

<p><b><code><?php echo esc_html( 'function prefix_after_content() {' ); ?></code></b><br />
<b><code class="pl-4"><?php echo esc_html( 'if ( false === is_admin() || \'includes\' !== filter_input( INPUT_GET, \'post_type\' ) ) { return; }' ); ?></code></b><br />
<b><code class="pl-4"><?php echo esc_html( 'echo wp_kses_post( \'</div><!-- .container -->\' );' ); ?></code></b><br />
<b><code><?php echo esc_html( '}' ); ?></code></b><br />
<b><code><?php echo esc_html( 'add_action( \'includes_after_posttype_content\', \'prefix_after_content\' );' ); ?></code></b></p>


<hr class="my-4 w-75" id="bodyclass" />

<h3 class="text-secondary font-weight-bold h3"><?php esc_html_e( 'Body Class', 'includes' ); ?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

	<?php
	$includes_body_classes = sprintf(
		/* Translators: %1$s Open bold/code tag. %2$s Close bold/code tag. %3$s Open link. %4$s Close link. */
		esc_html__( 'Use the css class %1$sincludes-template-default%2$s in your themes custom css file to add styling to the the %3$sposttype-includes.php%4$s template.', 'includes' ),
		'<b><code>',
		'</code></b>',
		'<a href="' . esc_url( admin_url( 'https://github.com/ChrisWinters/includes/blob/master/templates/posttype-includes.php' ) ) . '" target="_blank">',
		'</a>'
	);
	?>

<p><?php echo wp_kses_post( $includes_body_classes ); ?></p>

<hr class="my-4 w-75" />
<p><br /><p><p><br /><p><p><br /><p><p><br /><p><p><br /><p>
<p><br /><p><p><br /><p><p><br /><p><p><br /><p><p><br /><p>
<p><br /><p><p><br /><p><p><br /><p><p><br /><p><p><br /><p>
<em><small><?php esc_html_e( 'The space above is blank on purpose.', 'includes' ); ?></small></em>