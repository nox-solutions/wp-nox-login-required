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
                        $this->prefix('general'),
                        __('General Settings', 'wp-nox-login-required'),
                        static function () {
                            echo '<p>'.__('Here you can manage if and when the functionality is available.', 'wp-nox-login-required').'</p>';
                        },
                        $this->plugin_options_page_slug
                    );

                    // region General Settings

                    // region Pluin Enabled?

                    $setting_name = $this->prefix('enabled');

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
                        $this->prefix('general')
                    );

                    register_setting(
                        $this->plugin_options_page_slug,
                        $setting_name
                    );

                    // endregion

                    // region REST Enabled?

                    $setting_name = $this->prefix('rest_enabled');

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
                        $this->prefix('general')
                    );

                    register_setting(
                        $this->plugin_options_page_slug,
                        $setting_name
                    );

                    // endregion

                    // endregion

                    // region Custom HTML Settings

                    add_settings_section(
                        $this->prefix('html'),
                        __('Custom HTML Settings', 'wp-nox-login-required'),
                        static function () {
                            echo '<p>'.__('Here you can manage if the site will display a custom HTML content if the Login Required is enabled.', 'wp-nox-login-required').'</p>';
                        },
                        $this->plugin_options_page_slug
                    );

                    // region Display Temporary HTML?

                    $setting_name = $this->prefix('custom_html');

                    add_settings_field(
                        $setting_name,
                        __('Display Temporary HTML?', 'wp-nox-login-required'),
                        static function () use ($setting_name) {
                            /** @noinspection HtmlUnknownAttribute */
                            echo sprintf(
                                '<label for="%s"><input name="%s" id="%s" type="checkbox" value="1" class="code" %s /> %s</label>',
                                $setting_name,
                                $setting_name,
                                $setting_name,
                                checked(1, get_option($setting_name), false),
                                __('Disables the default login redirect and displays a custom HTML to unauthenticated users.', 'wp-nox-login-required')
                            );
                        },
                        $this->plugin_options_page_slug,
                        $this->prefix('html')
                    );

                    register_setting(
                        $this->plugin_options_page_slug,
                        $setting_name
                    );

                    // endregion

                    // region Custom HTML Contents

                    $setting_name = $this->prefix('custom_html_contents');

                    add_settings_field(
                        $setting_name,
                        __('Custom HTML Contents', 'wp-nox-login-required'),
                        function () use ($setting_name) {
                            $value = get_option($setting_name);

                            if (empty($value)) {
                                $value = $this->default_custom_html();
                            }

                            /** @noinspection HtmlUnknownAttribute */
                            echo sprintf(
                                '<textarea name="%s" id="%s" rows="15" class="large-text code">%s</textarea>',
                                $setting_name,
                                $setting_name,
                                $value
                            );
                        },
                        $this->plugin_options_page_slug,
                        $this->prefix('html')
                    );

                    register_setting(
                        $this->plugin_options_page_slug,
                        $setting_name
                    );

                    // endregion

                    // endregion
                }
            );
        }

        /**
         * @return string
         */
        protected function default_custom_html()
        {
            $title   = get_bloginfo('name');
            $charset = get_bloginfo('charset');
            $lang    = get_language_attributes();
            $text    = __('Under construction', 'wp-nox-login-required');

            return <<<HTML
<!DOCTYPE html>
<html {$lang}>
    <head>
        <meta charset="{$charset}" />
        <meta http-equiv="Content-Type" content="text/html;charset={$charset}" />
        <title>{$title}</title>
    </head>
    <body>
       <h1>{$title}</h1>
       <p>{$text}</p>
    </body>
</html>
HTML;
        }
    }
