<?php
/**
 * The admin page template.
 *
 * @package simple-reading-progress-bar
 */

defined( 'WPINC' ) or die;
?>
<fieldset>
	<p class="srpb-input">
		<label><?php echo esc_html( $this->settings['bar_color']['label'] ); ?></label>
		<input name="<?php echo esc_attr( self::OPTION ); ?>[bar_color]" type="text" id="color-<?php echo esc_attr( $this->settings['bar_color']['value'] ); ?>" value="<?php echo esc_attr( $this->settings['bar_color']['value'] ); ?>" class="colorpicker" autocomplete="off" />
	</p>
	<p class="srpb-input">
		<label><?php echo esc_html( $this->settings['bar_height']['label'] ); ?></label>
		<input name="<?php echo esc_attr( self::OPTION ); ?>[bar_height]" type="number" class="barheight" value="<?php echo esc_attr( $this->settings['bar_height']['value'] ); ?>"> px
	</p>
	<p class="srpb-input">
		<label><?php echo esc_html( $this->settings['bar_position']['label'] ); ?></label>
		<select name="<?php echo esc_attr( self::OPTION ); ?>[bar_position]">
			<option value="top" <?php selected( $this->settings['bar_position']['value'], 'top' ); ?>><?php esc_html_e( 'Top', 'simple-reading-progress-bar' ); ?></option>
			<option value="bottom" <?php selected( $this->settings['bar_position']['value'], 'bottom' ); ?>><?php esc_html_e( 'Bottom', 'simple-reading-progress-bar' ); ?></option>
		</select>
	</p>
	<p class="srpb-input"><label><?php echo esc_html( $this->settings['post_types']['label'] ); ?></label></p>
	<ul class="srpb-post-type-list srpb-input">
		<?php
		foreach ( get_post_types( array( 'public' => true ) ) as $post_type ) :
			$enabled = $this->settings['post_types']['value'][ $post_type ];
			?>
			<li><?php echo esc_html( ucwords( $post_type ) ); ?>
				<input type="checkbox" value="on" <?php checked( $enabled ); ?> name="<?php echo esc_attr( self::OPTION ); ?>[post_types][<?php echo esc_attr( $post_type ); ?>]">
			</li>
		<?php
		endforeach;
		?>
	</ul>
</fieldset>
