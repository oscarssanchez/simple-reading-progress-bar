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
		$this->settings = $this->get_settings();

		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'admin_post_simple-reading-progress-bar-save', array( $this, 'save_settings' ) );
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

	/**
	 * Processes and saves the Bar settings.
	 */
	public function save_settings() {
		if ( isset( $_POST[ self::NONCE_NAME ] ) && wp_verify_nonce( sanitize_key( wp_unslash( $_POST[ self::NONCE_NAME ] ) ), self::NONCE_ACTION ) ) {
			update_option( self::OPTION, $this->set_option() );
			wp_safe_redirect( $this->admin_url() . '&updated=true' );
			exit;
		}
	}

	/**
	 * Gets the bar settings
	 */
	public function get_settings() {
		$value = get_option( SELF::OPTION );
		return array(
			'bar_color' => array(
				'label' => __( 'Bar Color', 'simple-reading-progress-bar' ),
				'value' => $value['bar_color']
			),
			'bar_height' => array(
				'label' => __( 'Bar Height', 'simple-reading-progress-bar' ),
				'value' => $value['bar_height']
			),
			'bar_position' => array(
				'label' => __( 'Bar Position', 'simple-reading-progress-bar' ),
				'value' => $value['bar_position']
			),
		);
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
			'bar_color'    =>  ! empty( $_POST['bar_color'] ) ? sanitize_hex_color( $_POST['bar_color'] ) : '#eeee22',
			'bar_height'   =>  ( ! empty( $_POST['bar_height'] ) || 0 === $_POST['bar_height'] ) ? intval( $_POST['bar_height'] ) : '10',
			'bar_position' =>  ! empty( $_POST['bar_position'] ) ? sanitize_text_field( $_POST['bar_position'] ) : 'top'
		);
	}
}
