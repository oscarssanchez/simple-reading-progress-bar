<?php
/**
 * The admin page template.
 *
 * @package simple-reading-progress-bar
 */

defined( 'WPINC' ) or die;
?>
<div class="wrap">
	<h2><?php echo esc_html( $GLOBALS['title'] ); ?></h2>
	<form method="post" action="<?php admin_url( 'admin-post.php' ); ?>" class="simple-reading-progress-bar-form postbox">
		<input type="hidden" name="action" value="simple-reading-progress-bar-save">
		<?php wp_nonce_field( self::NONCE_ACTION, self::NONCE_NAME ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label>Bar Color</label></th>
				<td><input type="text" class="colorpicker"></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label>Bar Height</label></th>
				<td><input type="number" class="barheight"> px</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label>Bar Position</label></th>
				<td><select>
						<option>Top</option>
						<option>Bottom</option>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
