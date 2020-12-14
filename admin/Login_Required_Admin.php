<?php

    namespace noxwp\lr\admin;

    use noxwp\lr\base\Login_Required_Base;

    /**
     * Login Required Admin
     */
    class Login_Required_Admin extends Login_Required_Base
    {
        /**
         * Run all the required admin actions.
         */
        public function run()
        {
            parent::run();

            $this->register_menu();
            $this->register_settings();
        }

        /**
         * Option Page Menu Registration
         */
        protected function register_menu()
        {
            add_action(
                'admin_menu',
                function () {
                    add_options_page(
                        __('Login Required', 'wp-nox-login-required'),
                        __('Login Required', 'wp-nox-login-required'),
                        'manage_options',
                        $this->plugin_options_page_slug,
                        function () {
                            $this->render_view('settings');
                        }
                    );
                }
            );
        }

        /**
         * Options Page Settings Registration
         */
        protected function register_settings()
        {
            add_action(
                'admin_init',
                function () {
                    add_settings_section(
                        $this->prefix('section'),
                        'Example settings section in reading',
                        static function () {
                            echo '<p>Intro text for our settings section</p>';
                        },
                        $this->plugin_options_page_slug
                    );

                    $setting_name = $this->prefix('setting_enabled');

                    add_settings_field(
                        $setting_name,
                        __('Require Login on Frontend?', 'wp-nox-login-required'),
                        static function () use ($setting_name) {
                            /** @noinspection HtmlUnknownAttribute */
                            echo sprintf(
                                '<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
                                $setting_name,
                                $setting_name,
                                $setting_name,
                                checked(1, get_option($setting_name), false),
                                __('Access to the blog will be made only by authenticated users.', 'wp-nox-login-required')
                            );
                        },
                        $this->plugin_options_page_slug,
                        $this->prefix('section')
                    );

                    register_setting(
                        $this->plugin_options_page_slug,
                        $setting_name
                    );

                    $setting_name = $this->prefix('setting_rest_enabled');

                    add_settings_field(
                        $setting_name,
                        __('Enable REST Access?', 'wp-nox-login-required'),
                        static function () use ($setting_name) {
                            /** @noinspection HtmlUnknownAttribute */
                            echo sprintf(
                                '<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
                                $setting_name,
                                $setting_name,
                                $setting_name,
                                checked(1, get_option($setting_name), false),
                                __('Enable unauthenticated access to public REST endpoints.', 'wp-nox-login-required')
                            );
                        },
                        $this->plugin_options_page_slug,
                        $this->prefix('section')
                    );

                    register_setting(
                        $this->plugin_options_page_slug,
                        $setting_name
                    );
                }
            );
        }
    }
