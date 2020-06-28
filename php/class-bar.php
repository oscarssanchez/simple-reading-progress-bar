<?php
/**
 * The Bar class
 *
 * @package SimpleReadingProgressBar
 */

namespace SimpleReadingProgressBar;

/**
 * Class Bar
 *
 * @package SimpleReadingProgressBar
 */
class Bar {
	/**
	 * Instance of the plugin.
	 *
	 * @var object
	 */
	public $plugin;

	/**
	 * Instantiate this class.
	 *
	 * @param object $plugin Instance of the plugin.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Initialize the Bar
	 */
	public function init_bar() {
		add_action( 'wp_footer', array( $this, 'render_bar' ) );
		add_action( 'wp_head', array( $this, 'bar_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_bar_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_bar_scripts' ) );
	}

	/**
	 * Renders a style tag at the start of the page.
	 *
	 * This is so that the styling can be dynamic without using JS.
	 */
	public function bar_styles() {
		if ( $this->is_bar_active() ) {
			$settings = $this->plugin->components->admin->settings;
			?>
			<style>
				progress {
					position: fixed;
					left: 0;
				<?php echo esc_attr( $settings['bar_position']['value'] ); ?>: 0;
					z-index: 9999999;
					width: 100%;
					height: <?php echo esc_attr( $settings['bar_height']['value'] . 'px' ); ?>;
					border: none;
					background-color: transparent;
					-webkit-appearance: none;
					-moz-appearance: none;
				}

				progress::-webkit-progress-bar {
					background-color: transparent;
				}

				progress::-webkit-progress-value {
					background-color: <?php echo esc_attr( $settings['bar_color']['value'] ); ?>;
				}

				progress::-moz-progress-bar {
					background-color: <?php echo esc_attr( $settings['bar_color']['value'] ); ?>;
				}
			</style>
			<?php
		}
	}

	/**
	 * Renders the html elements needed for the progress bar.
	 */
	public function render_bar() {
		if ( $this->is_bar_active() ) {
			?>
			<progress value="100" id="progressBar">
				<div class="progress-container">
					<span class="progress-bar"></span>
				</div>
			</progress>
			<?php
		}
	}

	/**
	 * Enqueues the bar styles.
	 */
	public function load_bar_styles() {
		if ( $this->is_bar_active() ) {
			wp_enqueue_style( 'srpb', plugins_url( '../css/srpb.css', __FILE__ ), array(), Plugin::VERSION );
		}
	}

	/**
	 * Enqueues the bar script.
	 */
	public function load_bar_scripts() {
		if ( $this->is_bar_active() ) {
			wp_enqueue_script( 'srpb_scripts', plugins_url( '../js/srpb_scripts.js', __FILE__ ), array( 'jquery' ), Plugin::VERSION, true );
		}
	}

	/**
	 * Return whether the bar has been activated for the current post type.
	 *
	 * @return bool
	 */
	public function is_bar_active() {
		$settings  = $this->plugin->components->admin->settings;
		$post_type = get_post_type();

		if ( ! empty( $settings['post_types']['value'][ $post_type ] ) && true === $settings['post_types']['value'][ $post_type ] ) {
			return true;
		} else {
			return false;
		}
	}
}
