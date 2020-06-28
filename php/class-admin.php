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
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'init', array( $this, 'textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqueues the scripts and styles needed for the admin page.
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'simple-progress-reading-bar', plugins_url( '/js/admin-simple-progress-reading-bar.js', dirname( __FILE__ ) ), array( 'wp-color-picker' ), Plugin::VERSION, true );
		wp_enqueue_style( 'simple-progress-reading-bar', plugins_url( '/css/admin-simple-progress-reading-bar.css', dirname( __FILE__ ) ), array( 'wp-color-picker' ), Plugin::VERSION );
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
	public function render_settings() {
			include( dirname( __FILE__ ) . '/../templates/admin-page.php' );
		}

	/**
	 * Gets the bar settings
	 */
	public function get_settings() {
		$defaults = array(
			'bar_color'    => '#eeee22',
			'bar_height'   => '10',
			'bar_position' => 'top',
			'post_types'   => array(
				'post' => true
		)
	);

		$value = get_option( self::OPTION, $defaults );

		return array(
			'bar_color' => array(
				'label' => __( 'Bar Color: ', 'simple-reading-progress-bar' ),
				'value' => $value['bar_color']
			),
			'bar_height' => array(
				'label' => __( 'Bar Height: ', 'simple-reading-progress-bar' ),
				'value' => $value['bar_height']
			),
			'bar_position' => array(
				'label' => __( 'Bar Position: ', 'simple-reading-progress-bar' ),
				'value' => $value['bar_position']
			),
			'post_types' => array(
				'label' => __( 'Display on these post types: ', 'simple-reading-progress-bar' ),
				'value' => $value['post_types']
			),
		);
	}

	/**
	 * Callback to sanitize the bar settings.
	 *
	 * @param $settings. Input settings.
	 * @return array. Array of settings.
	 */
	public function sanitize_settings( $settings ) {
		/**
		 * Make this setting actual booleans.
		 */
		foreach ( $settings['post_types'] as $post_type => $enabled ) {
			if( 'on' === $enabled ) {
				$settings['post_types'][ $post_type ] = true;
			}
		}

		$settings['bar_color']    = ! empty( $settings['bar_color'] ) ? sanitize_hex_color( $settings['bar_color'] ) : '#eeee22';
		$settings['bar_height']   = ( ! empty( $settings['bar_height'] ) || 0 === $settings['bar_height'] ) ? intval( $settings['bar_height'] ) : '10';
		$settings['bar_position'] = ! empty( $settings['bar_position'] ) ? sanitize_text_field( $settings['bar_position'] ) : 'top';

		return $settings;
	}

	/**
	 * Registers and adds settings fields on the reading page.
	 */
	public function register_settings() {
		register_setting(
			'reading',
			self::OPTION,
			array( $this, 'sanitize_settings' )
		);

		add_settings_field(
			'simple_reading_progress_bar_settings',
			'Progress Bar Settings',
			array( $this, 'render_settings' ),
			'reading',
			'default'
		);
	}
}
