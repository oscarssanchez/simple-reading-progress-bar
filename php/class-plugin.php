<?php
/**
 * The main plugin class.
 *
 * @package SimpleReadingProgressBar
 */

namespace SimpleReadingProgressBar;

/**
 * Instantiates and initializes the plugin classes.
 *
 * @package SimpleReadingProgressBar
 */
class Plugin {

	/**
	 * The current plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.1';

	/**
	 * The plugin instance.
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Instantiated plugin classes.
	 *
	 * @var object
	 */
	public $components;

	/**
	 * Plugin initializer.
	 */
	public function init() {
		$this->load_files();
		$this->load_classes();
	}

	/**
	 * Initialize the main plugin class.
	 *
	 * @return Plugin
	 */
	public static function get_instance() {
		if ( ! self::$instance instanceof Plugin ) {
			self::$instance = new Plugin();
		}
		return self::$instance;
	}

	/**
	 * Loads and instantiates the plugin classes
	 */
	public function load_classes() {
		$this->components        = new \stdClass();
		$this->components->admin = new Admin();
		$this->components->admin->init();
		$this->components->bar = new Bar( $this );
		$this->components->bar->init_bar();
	}

	/**
	 * Loads the plugin files.
	 */
	public function load_files() {
		require_once dirname( __FILE__ ) . '/class-admin.php';
		require_once dirname( __FILE__ ) . '/class-bar.php';
	}
}
