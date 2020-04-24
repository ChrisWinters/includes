<?php
/**
 * WordPress Class
 *
 * @package    Includes
 * @subpackage Plugin
 * @author     Chris W. <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

/**
 * Deactivation Rules
 */
final class Plugin_Deactivate {
	/**
	 * Init Plugin Deactivation
	 *
	 * @return void
	 */
	public static function init() {
		/*
		 * Remove rewrite rules and then recreate rewrite rules.
		 * https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
		 */
		flush_rewrite_rules();

	}//end init()

}//end class
