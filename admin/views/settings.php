<?php
/**
 * Login Required settings page.
 *
 * @var Login_Required_Admin $this
 *
 * @package wp-nox-login-required
 */

use noxwp\lr\admin\Login_Required_Admin;

?>
<div class="wrap">
	<h1><?php echo esc_html( __( 'Login Required by NOX', 'wp-nox-login-required' ) ); ?></h1>

	<form action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>" method="post">

		<?php settings_fields( $this->plugin_options_page_slug ); ?>

		<?php do_settings_sections( $this->plugin_options_page_slug ); ?>

		<?php submit_button(); ?>

	</form>
</div>
