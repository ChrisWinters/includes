<?php
/**
 * WordPress Plugin Hooks
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
 * Set the activation hook for a plugin.
 * https://developer.wordpress.org/reference/functions/register_activation_hook/
 */
register_activation_hook(
	INCLUDES_FILE,
	[
		'Includes\Plugin_Activate',
		'init',
	]
);


/*
 * Set the deactivation hook for a plugin.
 * https://developer.wordpress.org/reference/functions/register_deactivation_hook/
 */
register_deactivation_hook(
	INCLUDES_FILE,
	[
		'Includes\Plugin_Deactivate',
		'init',
	]
);


includes_fs()->add_action(
	'after_uninstall',
	'Includes\Plugin_Uninstall::init'
);
