<?php
/**
 * The admin page class.
 *
 * @package SimpleReadingProgressBar
 */

namespace SimpleReadingProgressBar;

/**
 * Class Admin.
 *
 * @package SimpleReadingProgressBar
 */
class Admin {
	/**
	 * SimpleReadingProgressBar slug.
	 *
	 * @var string
	 */
	const SLUG = 'simple-reading-progress-bar';

	/**
	 * The nonce name.
	 *
	 * @var string
	 */
	const NONCE_NAME = 'simple-reading-progress-bar-nonce';

	/**
	 * The nonce action
	 *
	 * @var string
	 */
	const NONCE_ACTION = 'simple-reading-progress-bar-update';

	/**
	 * Admin initializer. Hooks necessary admin functions.
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'init', array( $this, 'textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Creates the plugin's settings page in the settings menu.
	 */
	public function admin_menus() {
		add_options_page(
			__( 'Simple Reading Progress Bar', 'simple-reading-progress-bar' ),
			__( 'Simple Reading Progress Bar', 'simple-reading-progress-bar' ),
			'manage_options',
			'simple-reading-progress-bar',
			array( $this, 'render_options_page' )
		);
	}

	/**
	 * Loads the plugin textdomain, enables plugin translation.
	 */
	public function textdomain() {
		load_plugin_textdomain( self::SLUG );
	}

	/**
	 * Renders the plugin's settings page.
	 */
	public function render_options_page() {
		include( dirname( __FILE__ ) . '/../templates/admin-page.php' );
	}

	/**
	 * Enqueues the scripts and styles needed for the admin page.
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'simple-progress-reading-bar', plugins_url( '/js/admin-simple-progress-reading-bar.js', dirname( __FILE__ ) ), array( 'wp-color-picker' ), Plugin::VERSION, true );
		wp_enqueue_style( 'simple-progress-reading-bar', plugins_url( '/css/admin-simple-progress-reading-bar.css', dirname( __FILE__ ) ), array( 'wp-color-picker' ), Plugin::VERSION );
	}
}
