<?php
/**
 * Login Required public plugin class.
 *
 * @package wp-nox-login-required
 */

namespace noxwp\lr\plugin;

use noxwp\lr\base\Login_Required_Base;
use WP_Error;

/**
 * Login Required Admin
 */
class Login_Required_Plugin extends Login_Required_Base {
	/**
	 * Run all the required admin actions.
	 */
	public function run() {
		$enabled = (bool) get_option( $this->prefix( 'enabled' ) );

		if ( $enabled ) {
			$this->apply_general_actions();
			$this->apply_rest_actions();
		}
	}

	/**
	 * Applies general actions to the WordPress instance.
	 */
	protected function apply_general_actions() {
		add_action(
			'template_redirect',
			function () {
				if ( ! is_user_logged_in() ) {
					$uses_html    = (bool) get_option( $this->prefix( 'custom_html' ) );
					$can_redirect = ! $uses_html;

					if ( $uses_html ) {
						$this->register_assets();

						$theme_template  = get_template_directory() . '/login-required.php';
						$plugin_template = __DIR__ . '/templates/login-required.php';

						if ( is_file( $theme_template ) ) {
							add_filter(
								'template_include',
								static function () use ( $theme_template ) {
									return $theme_template;
								}
							);
						} else {
							add_filter(
								'template_include',
								static function () use ( $plugin_template ) {
									return $plugin_template;
								}
							);
						}

						return;
					}

					if ( $can_redirect ) {
						auth_redirect();
					}
				}
			}
		);

		add_action(
			'plugins_loaded',
			static function () {
				remove_filter( 'lostpassword_url', 'wc_lostpassword_url' );
			}
		);
	}

	/**
	 * Applies REST actions to the WordPress instance.
	 */
	protected function apply_rest_actions() {
		$enable_rest = (bool) get_option( $this->prefix( 'rest_enabled' ) );

		if ( ! $enable_rest ) {
			add_filter(
				'rest_authentication_errors',
				function ( $result ) {
					if ( ! empty( $result ) ) {
						return $result;
					}

					if ( ! is_user_logged_in() ) {
						return new WP_Error(
							'rest_not_logged_in',
							__( 'API Requests are only supported for authenticated requests.', 'wp-nox-login-required' ),
							array( 'status' => 401 )
						);
					}

					return $result;
				}
			);
		}
	}

	/**
	 * Register the Bootstrap Assets
	 */
	protected function register_assets() {
		$setting_name = $this->prefix( 'custom_html_bootstrap_disabled' );

		if ( (int) get_option( $setting_name ) !== 1 ) {
			wp_enqueue_style( "{$this->plugin_slug}-bs-style", 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', array(), $this->plugin_version );
		}
	}
}
