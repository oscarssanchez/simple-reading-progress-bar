<?php
/**
 * The admin page template.
 *
 * @package simple-reading-progress-bar
 */

defined( 'WPINC' ) or die;
?>
<div class="wrap">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_color']['label'] ); ?></label></th>
				<td><input name="<?php echo esc_attr( self::OPTION ); ?>[bar_color]" type="text" id="color-<?php echo esc_attr( $this->settings['bar_color']['value'] ); ?>" value="<?php echo esc_attr( $this->settings['bar_color']['value'] ); ?>" class="colorpicker" autocomplete="off" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_height']['label'] ); ?></label></th>
				<td><input name="<?php echo esc_attr( self::OPTION ); ?>[bar_height]" type="number" class="barheight" value="<?php echo esc_attr( $this->settings['bar_height']['value'] ); ?>"> px</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_position']['label'] ); ?></label></th>
				<td><select name="<?php echo esc_attr( self::OPTION ); ?>[bar_position]">
						<option value="top" <?php selected( $this->settings['bar_position']['value'], 'top' ); ?>><?php esc_html_e( 'Top', 'simple-reading-progress-bar' ); ?></option>
						<option value="bottom" <?php selected( $this->settings['bar_position']['value'], 'bottom' ); ?>><?php esc_html_e( 'Bottom', 'simple-reading-progress-bar' ); ?></option>
					</select>
				</td>
			</tr>
		</table>
</div>
