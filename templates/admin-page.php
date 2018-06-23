<?php
/**
 * The admin page template.
 *
 * @package simple-reading-progress-bar
 */

defined( 'WPINC' ) or die;
?>
<div class="wrap">
	<?php $value = array_keys( $this->settings ); ?>
	<h2><?php echo esc_html( $GLOBALS['title'] ); ?></h2>
	<form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" class="simple-reading-progress-bar-form postbox">
		<input type="hidden" name="action" value="simple-reading-progress-bar-save">
		<?php wp_nonce_field( self::NONCE_ACTION, self::NONCE_NAME ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_color'] ); ?></label></th>
				<td><input name="<?php echo esc_attr( $value[0] ); ?>" type="text" id="color-<?php echo $value[0]; ?>" value="<?php echo esc_attr( $value[0] ); ?>" class="colorpicker" autocomplete="off" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_height'] ); ?></label></th>
				<td><input name="<?php echo esc_attr( $value[1] ); ?>" type="number" class="barheight" value="<?php echo esc_attr( $value[1] ); ?>"> px</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php echo esc_html( $this->settings['bar_position'] ); ?></label></th>
				<td><select name="<?php echo esc_attr( $value[2] ); ?>">
						<option value="<?php esc_attr( 'top' ); ?>"><?php esc_html_e( 'Top', 'simple-reading-progress-bar' ); ?></option>
						<option value="<?php esc_attr( 'bottom' ); ?>"><?php esc_html_e( 'Bottom', 'simple-reading-progress-bar' ); ?></option>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
