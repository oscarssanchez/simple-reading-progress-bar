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
	 * The bar settings
	 *
	 * @var array
	 */
	public $settings;

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
	 * The option name
	 */
	const OPTION = 'simple-reading-progress-bar';

	/**
	 * Admin initializer.
	 *
	 * Hooks necessary admin functions and sets bar settings.
	 */
	public function init() {
		$this->settings = array(
			'bar_color'    => __( 'Bar Color', 'simple-reading-progress-bar' ),
			'bar_height'   => __( 'Bar Height', 'simple-reading-progress-bar' ),
			'bar_position' => __( 'Bar Position', 'simple-reading-progress-bar' ),
		);

		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_post_simple-reading-progress-bar-save', array( $this, 'save_settings' ) );
		add_action( 'init', array( $this, 'textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		if ( isset( $_GET['empty_fields'] ) ) {
			add_action( 'admin_notices', array( $this, 'empty_fields_notice' ) );
		}
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
	 * Displays an admin notice if a field is left empty.
	 */
	public function empty_fields_notice() {
			include( ( dirname( __FILE__ ) . '/../templates/empty-fields.php' ) );
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

	/**
	 * Processes and saves the Bar settings.
	 */
	public function save_settings() {
		$keys   = array_keys( $this->settings );
		$verify = (
			! empty( $_POST[ $keys[0] ] )
			&&
			! empty( $_POST[ $keys[1] ] )
			&&
			isset( $_POST[ $keys[2] ], $_POST[ self::NONCE_NAME ] )
			&&
			wp_verify_nonce( sanitize_key( wp_unslash( $_POST[ self::NONCE_NAME ] ) ), self::NONCE_ACTION )
		);

		if ( $verify ) {
			update_option( self::OPTION, $this->set_option() );
			wp_redirect( $this->admin_url() . '&updated=true' );
			exit;
		} else {
			wp_redirect( $this->admin_url() . '&empty_fields=true' );
			exit;
		}
	}

	/**
	 * Returns the admin url of the plugin.
	 */
	public function admin_url() {
		return admin_url( 'options-general.php?page=simple-reading-progress-bar' );
	}

	/**
	 * Prepares the options to be saved
	 */
	public function set_option() {
		return array(
			'bar_color'    => $_POST['bar_color'],
			'bar_height'   => $_POST['bar_height'],
			'bar_position' => $_POST['bar_position'],
		);
	}
}
