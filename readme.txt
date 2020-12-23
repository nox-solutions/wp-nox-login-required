=== Login Required ===
Contributors: noxwp
Requires at least: 5.4.1
Tested up to: 5.4.1
Requires PHP: 5.6.0
Stable tag: 1.0.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Login Required by NOX. The plugin's main goal is to provide a safe way to prevent public access to the WordPress public site.

== Description ==

Login Required is a WordPress plugin maintained by NOX. The plugin's main goal is to provide a safe way to prevent public access to the WordPress public site.
If the visitor access the site, he will be redirected to the WordPress Login Page. Additionally, you can provide an HTML page to present to unauthenticated users.

## REST API

Login Required also applies rules to the WordPress **public** API, but you can choose if you want or not to apply those settings.

## A note on Security

If you choose to redirect all unauthenticated users to the WordPress login, you must remove the default "admin" user, and you are advised to install and configure a Security plugin.

== Installation ==

1. Download the admin-menu-editor.zip file to your computer.
2. Unzip the file.
3. Upload the `wp-nox-login-required` directory to your `/wp-content/plugins/` directory.
4. Activate the plugin through the 'Plugins' menu in WordPress.

That's it. You can access the the menu editor by going to *Settings -> Login Required*. The plugin will automatically load your current menu configuration the first time you run it.

== Screenshots ==

1. The settings page.

== Changelog ==
= 1.0.0 =

  * Initial release
