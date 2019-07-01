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
<div class="text-dark font-weight-bold p-0 m-0 h2"><?php 
esc_html_e( 'Plugin Documentation', 'includes' );
?></div>

<p><?php 
esc_html_e( 'WordPress Plugin - Includes for WordPress - Include Content Anywhere!', 'includes' );
?>
</p>

<hr class="hr" />

<h3 class="text-center"><?php 
esc_html_e( 'Table of Contents', 'includes' );
?></h3>

<?php 
?>
	<p class="text-center">[<a href="#basics"><?php 
esc_html_e( 'Basics', 'includes' );
?></a>] [<a href="#settings"><?php 
esc_html_e( 'Plugin Settings', 'includes' );
?></a>] [<a href="#includes"><?php 
esc_html_e( 'Includes within Includes', 'includes' );
?></a>] [<a href="#examples"><?php 
esc_html_e( 'Example Uses', 'includes' );
?></a>]</p>
<?php 
?>


<hr class="mb-4 w-75" id="basics" />

<h3 class="text-secondary font-weight-bold h3"><?php 
esc_html_e( 'The Basics', 'includes' );
?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<?php 

if ( !includes_fs()->is_premium() ) {
    ?>
		<p><?php 
    esc_html_e( 'Once activated the plugin creates a custom post type, taxonomy, and shortcodes; All other plugin related settings are inactive by default.', 'includes' );
    ?>
</p>
	<?php 
}

?>

<p>
	<?php 
echo  sprintf(
    /* Translators: %1$s Open link. %2$s Close link. */
    esc_html__( 'To use the plugin; publish an Includes post ( Includes menu > %1$sAdd New%2$s link ). Then use the provided shortcode to display the content within other Includes, posts, pages, widgets, menus, templates, etc.', 'includes' ),
    '<a href="' . esc_url( admin_url( 'post-new.php?post_type=includes' ) ) . '" target="_blank">',
    '</a>'
) ;
?>
</p>

<?php 

if ( !includes_fs()->is_premium() ) {
    ?>
<p>
	<?php 
    echo  sprintf(
        /* Translators: %1$s Open Shortcode. %2$s Close Shortcode. */
        esc_html__( 'The Includes shortcode looks like %1$spost-slug%2$s. The \'slug\' relates to the post slug for the published Include.', 'includes' ),
        '<code>[includes slug="',
        '"]</code>'
    ) ;
    ?>
</p>
	<?php 
}

?>

<?php 
?>

<hr class="my-4 w-75" id="settings" />

<h3 class="text-secondary font-weight-bold h3"><?php 
esc_html_e( 'Plugin Settings', 'includes' );
?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<p>
	<?php 
echo  sprintf(
    /* Translators: %1$s Open link. %2$s Close link. */
    esc_html__( 'Click the %1$sSettings Tab%2$s to adjust optional plugin settings.', 'includes' ),
    '<a href="' . esc_url( admin_url( 'edit.php?page=includes&tab=settings&post_type=includes' ) ) . '" target="_blank">',
    '</a>'
) ;
?>
</p>

<?php 
?>

<hr class="my-4 w-75" id="includes" />

<h3 class="text-secondary font-weight-bold h3"><?php 
esc_html_e( 'Includes within Includes', 'includes' );
?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

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

<h3 class="text-secondary font-weight-bold h3"><?php 
esc_html_e( 'Includes Usage Examples', 'includes' );
?><a href="#top"><span class="dashicons-before dashicons-arrow-up"></span></a></h3>

<p<?php 
esc_html_e( '>Use an Include anytime you repeat blocks of duplicate content across different pages, widgets, menus or come up with your own specialized needs.', 'includes' );
?></p>

<?php 
?>

<h4 class="text-black-50 font-weight-bold h5"><?php 
esc_html_e( 'Other Possible Uses', 'includes' );
?></h4>

<ol>
	<li><?php 
esc_html_e( 'Anytime content is duplicated on posts, pages, other post types, etc. Common duplicate content includes custom Author Cards/Bio\'s and Real Estate Disclosure Statements.', 'includes' );
?></li>
<?php 
?>
	<li><?php 
esc_html_e( 'Create Includes to store all Text/Html Widgets as Includes for easier backup & restore ability.', 'includes' );
?></li>
<?php 
?>
	<li><?php 
esc_html_e( 'Centralize Store Policies That Repeat On Various Product / Store Pages.', 'includes' );
?></li>
	<li><?php 
esc_html_e( 'Centralize Store F.A.Q .\'s That Repeat On Various Product / Store Pages.', 'includes' );
?></li>
	<li><?php 
esc_html_e( 'Centralize Advertisement Management For Blog Posts And Pages, Reducing The Need JavaScript.', 'includes' );
?></li>
<?php 
?>
</ol>

<?php 
?>

<h4 class="text-black-50 font-weight-bold h5"><?php 
esc_html_e( 'Delete All Settings', 'includes' );
?></h4>

<p><?php 
esc_html_e( 'No plugin settings/posts, etc will be deleted if the plugin is deactivated/uninstalled - all settings/posts must be manually deleted.', 'includes' );
?>
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
<?php 
?>
	<li><?php 
esc_html_e( 'To delete all plugin settings: scroll down to the bottom of the settings page and click the "delete all settings" button, then click the popup Ok button to confirm your selection.', 'includes' );
?></li>
<?php 
?>
	<li><?php 
echo  wp_kses_post( $includes_docs_to_delete ) ;
?></li>
</ol>
<?php 