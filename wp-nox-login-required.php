<?php

    use noxwp\lr\admin\Login_Required_Admin;
    use noxwp\lr\plugin\Login_Required_Plugin;

    /**
     * Plugin Name: Login Required by NOX
     * Description: Lock down the whole WordPress site to prevent public access.
     *              Only logged-in users can view the site or the content of the REST API if this plugin is activated.
     * Plugin URI:  https://github.com/nox-wp/wp-nox-login-required
     * Author:      NOX
     * Author URI:  https://github.com/nox-wp
     * License:     GNU General Public License v2 or later
     * License URI: http://www.gnu.org/licenses/gpl-2.0.html
     * Text Domain: wp-nox-login-required
     * Domain Path: /languages
     * Version:     1.0.0
     */

    defined('WPINC') or die();

    require(__DIR__.'/base/Login_Required_Base.php');
    require(__DIR__.'/admin/Login_Required_Admin.php');
    require(__DIR__.'/plugin/Login_Required_Plugin.php');

    /**
     * NOX Plugin Runner
     */
    function run_wp_nox_login_required()
    {
        $plugin_name        = __('Login Required by NOX', 'wp-nox-login-required');
        $plugin_version     = '1.0.0';
        $plugin_prefix      = 'wp_nox_lr';
        $plugin_slug        = 'wp-nox-login-required';
        $settings_page_slug = "{$plugin_slug}-settings";

        $admin = new Login_Required_Admin($plugin_name, $plugin_version, $plugin_slug, $plugin_prefix, $settings_page_slug);

        $admin->run();
        $admin->load_text_domain();

        $plugin = new Login_Required_Plugin($plugin_name, $plugin_version, $plugin_slug, $plugin_prefix, $settings_page_slug);

        $plugin->run();
    }

    run_wp_nox_login_required();
