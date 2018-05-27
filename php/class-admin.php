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
	 * Admin initializer. Hooks necessary admin functions.
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'init', array( $this, 'textdomain' ) );
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
		echo 'HELLO PLUGIN';
	}
}
