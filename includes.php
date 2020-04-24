<?php
/**
 * Plugin Name: Includes
 * Plugin URI: https://github.com/ChrisWinters/includes
 * Description: Includes for WordPress - Include Content Anywhere!
 * Version: 4.0.0
 * License: GNU GPLv3
 * Copyright ( c ) 2019-2020 Chris Winters
 * Author: Chris W.
 * Author URI: https://github.com/ChrisWinters
 * Text Domain: includes
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

define( 'INCLUDES_DIR', __DIR__ );
define( 'INCLUDES_FILE', __FILE__ );
define( 'INCLUDES_VERSION', '4.0.0' );
define( 'INCLUDES_PLUGIN_NAME', 'includes' );
define( 'INCLUDES_SINGULAR_NAME', 'include' );
define( 'INCLUDES_SETTING_PREFIX', 'includes_' );

require_once dirname( __FILE__ ) . '/inc/sdk/includes-fs.php';
require_once dirname( __FILE__ ) . '/inc/autoload-classes.php';
require_once dirname( __FILE__ ) . '/inc/instantiate-public-classes.php';
require_once dirname( __FILE__ ) . '/inc/instantiate-admin-classes.php';
require_once dirname( __FILE__ ) . '/inc/register-plugin-hooks.php';

// Plugin Update Checker.
if ( false === class_exists( 'Puc_v4p4_Autoloader' ) ) {
	require_once dirname( __FILE__ ) . '/inc/puc/plugin-update-checker.php';

	$includes_puc = \Puc_v4_Factory::buildUpdateChecker(
		'https://raw.githubusercontent.com/ChrisWinters/includes/master/updates.json',
		INCLUDES_FILE,
		INCLUDES_PLUGIN_NAME
	);
}
