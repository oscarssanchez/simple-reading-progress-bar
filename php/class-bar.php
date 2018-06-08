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
	 * Initialize the Bar
	 */
	public function init_bar() {
		add_action( 'wp_footer', array( $this, 'render_bar' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_bar_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_bar_scripts' ) );
	}

	/**
	 * Renders the html elements needed for the progress bar.
	 */
	public function render_bar() {
		if ( is_single() ) {
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
		if ( is_single() ) {
			wp_enqueue_style( 'srpb', plugins_url( '../css/srpb.css', __FILE__ ) );
		}
	}

	/**
	 * Enqueues the bar script.
	 */
	public function load_bar_scripts() {
		if ( is_single() ) {
			wp_enqueue_script( 'srpb_scripts', plugins_url( '../js/srpb_scripts.js', __FILE__ ), array( 'jquery' ), Plugin::VERSION, true );
		}
	}
}
