<?php
/**
 * Plugin Name: Includes for WordPress
 * Plugin URI: https://includesforwp.com/
 * Description: Include Content Anywhere!
 * Version: 3.0.0
 * License: GNU GPLv3
 * Copyright ( c ) 2019 Chris W.
 * Author: Chris W.
 * Author URI: https://github.com/ChrisWinters
 * Text Domain: includes
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 *
 */

namespace Includes;

if ( false === defined( 'ABSPATH' ) ) {
	exit;
}

define( 'INCLUDES_DIR', __DIR__ );
define( 'INCLUDES_FILE', __FILE__ );
define( 'INCLUDES_PLUGIN_NAME', 'includes' );
define( 'INCLUDES_SINGULAR_NAME', 'include' );
define( 'INCLUDES_SETTING_PREFIX', 'includes_' );

require_once dirname( __FILE__ ) . '/sdk/includes-fs.php';
require_once dirname( __FILE__ ) . '/inc/autoload-classes.php';
require_once dirname( __FILE__ ) . '/inc/instantiate-public-classes.php';
require_once dirname( __FILE__ ) . '/inc/instantiate-admin-classes.php';
require_once dirname( __FILE__ ) . '/inc/register-plugin-hooks.php';
