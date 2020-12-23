<?php
/**
 * Login Required uninstall page.
 *
 * @package wp-nox-login-required
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || die();

delete_option( 'wp_nox_lr_enabled' );
delete_option( 'wp_nox_lr_rest_enabled' );
delete_option( 'wp_nox_lr_custom_html' );
delete_option( 'wp_nox_lr_custom_html_contents' );
