<?php
/**
 * Login Required base class.
 *
 * @package wp-nox-login-required
 */

namespace noxwp\lr\base;

/**
 * Login Required Base Class
 */
class Login_Required_Base {
	/**
	 * Plugin name
	 *
	 * @var string
	 */
	protected $plugin_name;

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	protected $plugin_version;

	/**
	 * Plugin slug (same as the directory)
	 *
	 * @var string
	 */
	protected $plugin_slug;

	/**
	 * Plugin prefix
	 *
	 * @var string
	 */
	protected $plugin_prefix;

	/**
	 * Plugin domain
	 *
	 * @var string
	 */
	protected $plugin_domain;

	/**
	 * Plugin options page slug
	 *
	 * @var string
	 */
	protected $plugin_options_page_slug;

	/**
	 * Login_Required_Admin constructor.
	 *
	 * @param string $plugin_name Plugin name.
	 * @param string $plugin_version Plugin version.
	 * @param string $plugin_slug Plugin slug.
	 * @param string $plugin_prefix Plugin prefix.
	 * @param string $plugin_options_page_slug Plugin options page slug.
	 * @param bool   $load_text_domain Load text domain.
	 */
	public function __construct( $plugin_name, $plugin_version, $plugin_slug, $plugin_prefix, $plugin_options_page_slug, $load_text_domain = false ) {
		$this->plugin_name              = $plugin_name;
		$this->plugin_version           = $plugin_version;
		$this->plugin_slug              = $plugin_slug;
		$this->plugin_domain            = $this->plugin_slug;
		$this->plugin_prefix            = $plugin_prefix;
		$this->plugin_options_page_slug = $plugin_options_page_slug;

		if ( $load_text_domain ) {
			$this->load_text_domain();
		}
	}

	/**
	 * Run all the required admin actions.
	 */
	public function run() {
	}

	/**
	 * Loads the internationalization
	 */
	public function load_text_domain() {
		add_action(
			'plugins_loaded',
			function () {
				load_plugin_textdomain(
					$this->plugin_slug,
					false,
					"/{$this->plugin_slug}/languages/"
				);
			}
		);
	}

	/**
	 * Returns the name prefixed by the plugin_prefix property.
	 *
	 * @param string $name The name to be preffixed.
	 *
	 * @return string
	 */
	protected function prefix( $name ) {
		return "{$this->plugin_prefix}_{$name}";
	}

	/**
	 * Renders a view
	 *
	 * @param string $name The name of the view.
	 * @param string $base The name of the base directory.
	 * @param array  $vars Additional variables to pass to the view.
	 *
	 * @noinspection PhpIncludeInspection
	 */
	protected function render_view( $name, $base = 'admin', $vars = array() ) {
		$dir  = dirname( __DIR__ );
		$path = "{$dir}/{$base}/views/{$name}.php";

		if ( is_array( $vars ) && ! empty( $vars ) ) {
			foreach ( $vars as $k => $v ) {
				$$k = $v;
			}
		}

		if ( is_file( $path ) ) {
			require $path;
		}
	}
}
