<?php
/**
 * Manager Class
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

use Includes\Plugin_Admin_Export as PluginAdminExport;
use Includes\Trait_Option_Manager as TraitOptionManager;
use Includes\Trait_Query_String as TraitQueryString;

/**
 * Load WordPress Plugin Admin Area
 */
final class Plugin_Admin {
	use TraitOptionManager;
	use TraitQueryString;

	/**
	 * Admin Area Template Tabs.
	 *
	 * @var array
	 */
	public $admin_tabs = array();

	/**
	 * PluginAdminExport Class.
	 *
	 * @var object
	 */
	public $export;

	/**
	 * Set Class Params
	 *
	 * @return void
	 */
	public function __construct() {
		$this->admin_tabs = [
			'settings'  => esc_html__( 'Settings', 'includes' ),
			'documents' => esc_html__( 'Documentation', 'includes' ),
		];
	}//end __construct()

	/**
	 * Init Admin Display
	 *
	 * @return void
	 */
	public function init() {
		/*
		 * Fires before the administration menu loads in the admin.
		 * https://developer.wordpress.org/reference/hooks/admin_menu/
		 */
		add_action( 'admin_menu', [ $this, 'menu' ] );
		if ( $this->query_string( 'page' ) === INCLUDES_PLUGIN_NAME ) {
			/*
			 * Enqueue Scripts For Plugin Admin
			 * https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
			 */
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
		}
	}//end init()

	/**
	 * Generate Settings Menu
	 *
	 * @return void
	 */
	public function menu() {
		/*
		 * Add Settings Page Options
		 * https://developer.wordpress.org/reference/functions/add_submenu_page/
		 */
		add_submenu_page(
			'edit.php?post_type=' . INCLUDES_PLUGIN_NAME,
			INCLUDES_PLUGIN_NAME,
			__( 'Settings', 'includes' ),
			'manage_options',
			INCLUDES_PLUGIN_NAME,
			[ $this, 'display' ]
		);
	}//end menu()

	/**
	 * Enqueue Stylesheet and jQuery
	 *
	 * @return void
	 */
	public function enqueue() {
		/*
		 * Enqueue a CSS stylesheet.
		 * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		 *
		 * Retrieves a URL within the plugins directory.
		 * https://developer.wordpress.org/reference/functions/plugins_url/
		 */
		wp_enqueue_style(
			INCLUDES_PLUGIN_NAME,
			plugins_url( '/assets/css/style.min.css', INCLUDES_FILE ),
			'',
			date( 'YmdHis', time() ),
			'all'
		);
	}//end enqueue()

	/**
	 * Display Admin Templates
	 *
	 * @return void
	 */
	public function display() {
		$dir = dirname( INCLUDES_FILE );
		$tab = $this->query_string( 'tab' );
		include_once $dir . '/templates/plugin-admin/header.php';

		if ( true === file_exists( $dir . '/templates/plugin-admin/' . $tab . '.php' ) ) {
			include_once $dir . '/templates/plugin-admin/' . $tab . '.php';
		} else {
			include_once $dir . '/templates/plugin-admin/settings.php';
		}

		include_once $dir . '/templates/plugin-admin/footer.php';
	}//end display()

	/**
	 * Display Admin Area Tabs
	 *
	 * @return string $html Tab Display
	 */
	public function tabs() {
		$html = '<h2 class="nav-tab-wrapper">';

		if ( true !== empty( $this->query_string( 'tab' ) ) ) {
			$current_tab = $this->query_string( 'tab' );
		} else {
			$current_tab = key( $this->admin_tabs );
		}

		$pagename = $this->query_string( 'page' );
		$posttype = '';
		if ( INCLUDES_PLUGIN_NAME === $this->query_string( 'post_type' ) ) {
			$posttype = '&post_type=' . $this->query_string( 'post_type' );
		}
		foreach ( $this->admin_tabs as $tab => $name ) {
			$class = '';
			if ( $tab === $current_tab ) {
				$class = ' nav-tab-active';
			}
			$html .= '<a href="?page=' . $pagename . '&tab=' . $tab . $posttype . '" class="nav-tab' . $class . '">' . $name . '</a>';
		}
		$html .= '</h2><br />';
		return $html;
	}//end tabs()
}//end class
