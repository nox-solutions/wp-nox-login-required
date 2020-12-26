![PHPCS](https://github.com/nox-wp/wp-nox-login-required/workflows/PHP%20CS/badge.svg)
![Codeception](https://github.com/nox-wp/wp-nox-login-required/workflows/Codeception%20Tests/badge.svg)

# Login Required by NOX for WordPress

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

## Support

This is a developer's portal for **Required Login** and should not be used for support. Please visit the
[support forums](https://wordpress.org/support/plugin/wp-nox-login-required).

## Reporting bugs

If you find an issue, [let us know here](https://github.com/nox-wp/wp-nox-login-required/issues/new)!

It may help us a lot if you can provide a backtrace of the error encountered. You can use [code in this gist](https://gist.github.com/jrfnl/5925642) to enable the backtrace in your website's configuration.

## Contributions

Anyone is welcome to contribute to Required Plugin by NOX.

There are various ways you can contribute:

* [Report an issue](https://github.com/nox-wp/wp-nox-login-required/issues) on GitHub.
* Send us a Pull Request with your bug fixes and/or new features.
* [Translate Required Login into different languages](https://translate.wordpress.org/projects/wp-plugins/wp-nox-login-required/).
* Provide feedback and [suggestions on enhancements](https://github.com/nox-wp/wp-nox-login-required/issues?direction=desc&labels=Enhancement&page=1&sort=created&state=open).

## Running PHPCS and Codeception Tests

We provide an initialization script (`./init 5.6`, you need to pass the version you want to install) to configure a WordPress installation inside the folder `/tests/_data/wp`. 
The script will use the `/tests/_config/testing.php` file to load the available variables and create the required environment files.

The configuration file should not be altered in your local environment. To override the basic configuration, you can create a configuration file named `/tests/_config/testing-local.php`.

After the initialization process, you can use both PHPCS and Codeception to test your project's additions.

Note: in the configuration files, you may use the {DB} param to indicate the schema name. This param will be replaced by the correct schema name based on the WordPress version indicated in the initialization script.

### Initialization script call examples

The plugin requires at least WordPress 4.9.0 and PHP 5.6. All the tests run in major WordPress and PHP releases. To reproduce in your local environment the base NOX WordPress installations, you can run the following commands:

```bash

./init 4.9
./init 5.0
./init 5.1
./init 5.2
./init 5.3
./init 5.4
./init 5.5
./init 5.6

```

Important note: the variable `WP_ROOT_FOLDER` should have your Virtual Host real path (like `/var/www/html`). The initialization script will try to remove it and create a symbolic link to the internal WordPress configured. 
Example: if you run `./init 5.6` the internal path will be `/tests/_data/wp/nox_wp_56` and the html folder will link to it. For this behavior to work, you must have write access to the mentioned folders.

Note about the database: the initialization script will try to connect to your local database and create the necessary schemas. The name pattern is `nox_wp<VERSION>` (for WordPress 5.6, the name will be nox_wp56). 
Important: the script will create and populate the schema, but it will not delete it.

### PHPCS

If you want to collaborate, please make sure your code passes our phpcs checks before creating a pull request. 
Install the project composer dependencies, then run the following command on the root folder:

```bash
./phpcs
```

or

```bash
./vendor/bin/phpcs
```

This should run the basic code sniffer to check your additions and WordPress code style.

### Codeception Tests
