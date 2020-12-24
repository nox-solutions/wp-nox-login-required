<?php
/**
 * Login Required admin class.
 *
 * @package wp-nox-login-required
 */

namespace noxwp\lr\admin;

use noxwp\lr\base\Login_Required_Base;

/**
 * Login Required Admin
 */
class Login_Required_Admin extends Login_Required_Base {
	/**
	 * Run all the required admin actions.
	 */
	public function run() {
		parent::run();

		$this->register_menu();
		$this->register_settings();
	}

	/**
	 * Option Page Menu Registration
	 */
	protected function register_menu() {
		add_action(
			'admin_menu',
			function () {
				add_options_page(
					__( 'Login Required', 'wp-nox-login-required' ),
					__( 'Login Required', 'wp-nox-login-required' ),
					'manage_options',
					$this->plugin_options_page_slug,
					function () {
						$this->render_view( 'settings' );
					}
				);
			}
		);
	}

	/**
	 * Options Page Settings Registration
	 */
	protected function register_settings() {
		add_action(
			'admin_init',
			function () {
				add_settings_section(
					$this->prefix( 'general' ),
					__( 'General Settings', 'wp-nox-login-required' ),
					static function () {
						echo '<p>' . esc_html( __( 'Here you can manage if and when the functionality is available.', 'wp-nox-login-required' ) ) . '</p>';
					},
					$this->plugin_options_page_slug
				);

				$setting_name = $this->prefix( 'enabled' );

				add_settings_field(
					$setting_name,
					__( 'Require Login on Frontend?', 'wp-nox-login-required' ),
					static function () use ( $setting_name ) {
						/**
						 * Disables HtmlUnknownAttribute inspection.
						 *
						 * @noinspection HtmlUnknownAttribute
						 */
						echo sprintf(
							'<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							checked( 1, get_option( $setting_name ), false ),
							esc_attr( __( 'Access to the blog will be made only by authenticated users.', 'wp-nox-login-required' ) )
						);
					},
					$this->plugin_options_page_slug,
					$this->prefix( 'general' )
				);

				register_setting(
					$this->plugin_options_page_slug,
					$setting_name
				);

				$setting_name = $this->prefix( 'rest_enabled' );

				add_settings_field(
					$setting_name,
					__( 'Enable REST Access?', 'wp-nox-login-required' ),
					static function () use ( $setting_name ) {
						/**
						 * Disables HtmlUnknownAttribute inspection.
						 *
						 * @noinspection HtmlUnknownAttribute
						 */
						echo sprintf(
							'<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							checked( 1, get_option( $setting_name ), false ),
							esc_attr( __( 'Enable unauthenticated access to public REST endpoints.', 'wp-nox-login-required' ) )
						);
					},
					$this->plugin_options_page_slug,
					$this->prefix( 'general' )
				);

				register_setting(
					$this->plugin_options_page_slug,
					$setting_name
				);

				add_settings_section(
					$this->prefix( 'html' ),
					__( 'Custom HTML Settings', 'wp-nox-login-required' ),
					static function () {
						echo '<p>' . esc_html( __( 'Here you can manage if the site will display a custom HTML content if the Login Required is enabled.', 'wp-nox-login-required' ) ) . '</p>';
					},
					$this->plugin_options_page_slug
				);

				$setting_name = $this->prefix( 'custom_html' );

				add_settings_field(
					$setting_name,
					__( 'Enable Temporary HTML?', 'wp-nox-login-required' ),
					static function () use ( $setting_name ) {
						$file = '<code>login-required.php</code>';

						/* translators: %s: The template file name. */
						$help = sprintf( __( 'Disables the default login redirect and displays a custom HTML to unauthenticated users. You can override the default template by adding a %s template file to your theme root path.', 'wp-nox-login-required' ), $file );
						/**
						 * Disables HtmlUnknownAttribute inspection.
						 *
						 * @noinspection HtmlUnknownAttribute
						 */
						echo sprintf(
							'<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							checked( 1, get_option( $setting_name ), false ),
							wp_kses( $help, 'code' )
						);
					},
					$this->plugin_options_page_slug,
					$this->prefix( 'html' )
				);

				register_setting(
					$this->plugin_options_page_slug,
					$setting_name
				);

				$setting_name = $this->prefix( 'custom_html_contents' );

				add_settings_field(
					$setting_name,
					__( 'Subtitle Text', 'wp-nox-login-required' ),
					static function () use ( $setting_name ) {
						$value = get_option( $setting_name );

						if ( empty( $value ) ) {
							$value = __( 'We are under construction...', 'wp-nox-login-required' );
						}

						echo sprintf(
							'<input type="text" name="%s" id="%s" value="%s"/>',
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							esc_html( $value )
						);
					},
					$this->plugin_options_page_slug,
					$this->prefix( 'html' )
				);

				register_setting(
					$this->plugin_options_page_slug,
					$setting_name
				);

				$setting_name = $this->prefix( 'custom_html_bootstrap_disabled' );

				add_settings_field(
					$setting_name,
					__( 'Disable Bootstrap loading?', 'wp-nox-login-required' ),
					static function () use ( $setting_name ) {
						/**
						 * Disables HtmlUnknownAttribute inspection.
						 *
						 * @noinspection HtmlUnknownAttribute
						 */
						echo sprintf(
							'<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							checked( 1, get_option( $setting_name ), false ),
							esc_attr( __( 'Disables the Bootstrap assets loading.', 'wp-nox-login-required' ) )
						);
					},
					$this->plugin_options_page_slug,
					$this->prefix( 'html' )
				);

				register_setting(
					$this->plugin_options_page_slug,
					$setting_name
				);

				$setting_name = $this->prefix( 'custom_html_login_btn_disabled' );

				add_settings_field(
					$setting_name,
					__( 'Hide Login Button?', 'wp-nox-login-required' ),
					static function () use ( $setting_name ) {
						/**
						 * Disables HtmlUnknownAttribute inspection.
						 *
						 * @noinspection HtmlUnknownAttribute
						 */
						echo sprintf(
							'<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							esc_attr( $setting_name ),
							checked( 1, get_option( $setting_name ), false ),
							esc_attr( __( 'Hides the login button used to go to the WordPress authentication page. This option is used only if you are not using the custom template page.', 'wp-nox-login-required' ) )
						);
					},
					$this->plugin_options_page_slug,
					$this->prefix( 'html' )
				);

				register_setting(
					$this->plugin_options_page_slug,
					$setting_name
				);
			}
		);
	}
}
