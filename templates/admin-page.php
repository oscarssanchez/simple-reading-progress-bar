<?php
/**
 * The admin page template.
 *
 * @package simple-reading-progress-bar
 */

defined( 'WPINC' ) or die;
?>
<div class="wrap">
	<?php $name_value = array_keys( $this->settings ); ?>
	<h2><?php echo esc_html( $GLOBALS['title'] ); ?></h2>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="simple-reading-progress-bar-form postbox">
		<input type="hidden" name="action" value="simple-reading-progress-bar-save">
		<?php wp_nonce_field( self::NONCE_ACTION, self::NONCE_NAME ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_color']['label'] ); ?></label></th>
				<td><input name="<?php echo esc_attr( $name_value[0] ); ?>" type="text" id="color-<?php echo esc_attr( $this->settings['bar_color']['value'] ); ?>" value="<?php echo esc_attr( $this->settings['bar_color']['value'] ); ?>" class="colorpicker" autocomplete="off" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_height']['label'] ); ?></label></th>
				<td><input name="<?php echo esc_attr( $name_value[1] ); ?>" type="number" class="barheight" value="<?php echo esc_attr( $this->settings['bar_height']['value'] ); ?>"> px</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_position']['label'] ); ?></label></th>
				<td><select name="<?php echo esc_attr( $name_value[2] ); ?>">
						<option value="top" <?php selected( $this->settings['bar_position']['value'], 'top' ); ?>><?php esc_html_e( 'Top', 'simple-reading-progress-bar' ); ?></option>
						<option value="bottom" <?php selected( $this->settings['bar_position']['value'], 'bottom' ); ?>><?php esc_html_e( 'Bottom', 'simple-reading-progress-bar' ); ?></option>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
