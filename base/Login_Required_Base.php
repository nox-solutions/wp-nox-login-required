<?php

    namespace noxwp\lr\base;

    /**
     * Login Required Base Class
     */
    class Login_Required_Base
    {
        /**
         * @var string
         */
        protected $plugin_name;

        /**
         * @var string
         */
        protected $plugin_version;

        /**
         * @var string
         */
        protected $plugin_slug;

        /**
         * @var string
         */
        protected $plugin_prefix;

        /**
         * @var string
         */
        protected $plugin_domain;

        /**
         * @var string
         */
        protected $plugin_options_page_slug;

        /**
         * Login_Required_Admin constructor.
         *
         * @param string $plugin_name
         * @param string $plugin_version
         * @param string $plugin_slug
         * @param string $plugin_prefix
         * @param string $plugin_options_page_slug
         */
        public function __construct($plugin_name, $plugin_version, $plugin_slug, $plugin_prefix, $plugin_options_page_slug)
        {
            $this->plugin_name              = $plugin_name;
            $this->plugin_version           = $plugin_version;
            $this->plugin_slug              = $plugin_slug;
            $this->plugin_domain            = $this->plugin_slug;
            $this->plugin_prefix            = $plugin_prefix;
            $this->plugin_options_page_slug = $plugin_options_page_slug;
        }

        /**
         * Run all the required admin actions.
         */
        public function run()
        {
        }

        /**
         * Loads the internationalization
         */
        public function load_text_domain()
        {
            add_action(
                'plugins_loaded',
                function () {
                    load_plugin_textdomain('wp-nox-login-required', false, dirname(__DIR__).'/languages/');
                }
            );
        }

        /**
         * @param string $name
         *
         * @return string
         */
        protected function prefix($name)
        {
            return "{$this->plugin_prefix}_{$name}";
        }

        /**
         * @noinspection PhpIncludeInspection
         */
        protected function render_view($name, $base = 'admin', $vars = [])
        {
            $dir  = dirname(__DIR__);
            $path = "{$dir}/{$base}/views/{$name}.php";

            extract($vars, EXTR_OVERWRITE);

            if (is_file($path)) {
                require($path);
            }
        }
    }
