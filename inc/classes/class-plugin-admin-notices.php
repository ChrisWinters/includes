<?php
/**
 * Manager Class
 *
 * @category   WordPress
 * @package    Includes
 * @subpackage Classes
 * @author     Chris Winters <chrisw@null.net>
 * @license    GNU GPLv3
 * @link       /LICENSE
 */

namespace Includes;

/**
 * Plugin Admin Area Notices
 */
final class Plugin_Admin_Notices {
	/**
	 * Plugin Admin Notices.
	 *
	 * @var array
	 */
	public $message = [];


	/**
	 * Set Class Params
	 *
	 * @return void
	 */
	public function __construct() {
		$this->message = [
			'update_success' => __(
				'Settings Updated.',
				'includes'
			),
			'update_error'   => __(
				'Settings Update Failed.',
				'includes'
			),
			'input_error'    => __(
				'A Selection Is Required.',
				'includes'
			),
			'delete_success' => __(
				'Settings Deleted.',
				'includes'
			),
			'delete_fail'    => __(
				'Settings Delete Failed.',
				'includes'
			),
			'import_success' => __(
				'Settings Imported.',
				'includes'
			),
			'import_error'   => __(
				'Settings Import Failed.',
				'includes'
			),
			'email_success'  => __(
				'Email Sent.',
				'includes'
			),
			'email_error'    => __(
				'Email Failed To Send.',
				'includes'
			),
		];
	}//end __construct()


	/**
	 * Update Success Notice
	 */
	public function update_success() {
		echo wp_kses_post( $this->success_message( $this->message['update_success'] ) );
	}//end update_success()


	/**
	 * Update Error Notice
	 */
	public function update_error() {
		echo wp_kses_post( $this->error_message( $this->message['update_error'] ) );
	}//end update_error()


	/**
	 * Invalid Input Error Notice
	 */
	public function input_error() {
		echo wp_kses_post( $this->error_message( $this->message['input_error'] ) );
	}//end input_error()


	/**
	 * Delete Success Notice
	 */
	public function delete_success() {
		echo wp_kses_post( $this->success_message( $this->message['delete_success'] ) );
	}//end delete_success()


	/**
	 * Delete Error Notice
	 */
	public function delete_error() {
		echo wp_kses_post( $this->error_message( $this->message['delete_error'] ) );
	}//end delete_error()


	/**
	 * Import Success Notice
	 */
	public function import_success() {
		echo wp_kses_post( $this->success_message( $this->message['import_success'] ) );
	}//end import_success()


	/**
	 * Import Error Notice
	 */
	public function import_error() {
		echo wp_kses_post( $this->error_message( $this->message['import_error'] ) );
	}//end import_error()


	/**
	 * Email Success Notice
	 */
	public function email_success() {
		echo wp_kses_post( $this->success_message( $this->message['email_success'] ) );
	}//end email_success()


	/**
	 * Email Error Notice
	 */
	public function email_error() {
		echo wp_kses_post( $this->error_message( $this->message['email_error'] ) );
	}//end email_error()


	/**
	 * Success Message HTML
	 *
	 * @param string $message The Notice To Display.
	 *
	 * @return html
	 */
	public function success_message( $message ) {
		return '<div class="notice notice-success is-dismissible"><p>' . $message . '</p></div>';
	}//end success_message()


	/**
	 * Error Message HTML
	 *
	 * @param string $message The Notice To Display.
	 *
	 * @return html
	 */
	public function error_message( $message ) {
		return '<div class="notice notice-error is-dismissible"><p>' . $message . '</p></div>';
	}//end error_message()

}//end class
