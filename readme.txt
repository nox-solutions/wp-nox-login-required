=== Login Required ===
Contributors: noxwp
Requires at least: 5.4.1
Tested up to: 5.6.0
Requires PHP: 5.6.0
Stable tag: 1.0.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Login Required by NOX. The plugin's main goal is to provide a safe way to prevent public access to the WordPress public site.

== Description ==

Login Required is a WordPress plugin maintained by NOX. The plugin's main goal is to provide a safe way to prevent public access to the WordPress public site.
If the visitor access the site, he will be redirected to the WordPress Login Page.

## REST API

Login Required also applies rules to the WordPress **public** API, but you can choose if you want or not to apply those settings.

## HTML Page

You can use the plugin to provide an HTML page to the unauthenticated users instead of the basic login redirect feature.
The plugin provides a basic page, and you can personalize the base text and use or not the Login button. You can also create your own
by adding the file login-required.php file to your theme root path.

The plugin loads the Bootstrap CSS automatically, but you can configure it to prevent this behavior.

## A note on Security

If you choose to redirect all unauthenticated users to the WordPress login, you must remove the default "admin" user, and you are advised to install and configure a Security plugin.

== Installation ==

1. Download the admin-menu-editor.zip file to your computer.
2. Unzip the file.
3. Upload the `wp-nox-login-required` directory to your `/wp-content/plugins/` directory.
4. Activate the plugin through the 'Plugins' menu in WordPress.

That's it. You can access the the menu editor by going to *Settings -> Login Required*. The plugin will automatically load your current menu configuration the first time you run it.

== Screenshots ==

1. The settings page of the Login Redirect Plugin.
2. The public HTML page of the Login Redirect Plugin.

== Changelog ==
= 1.0.0 =

  * Initial release
