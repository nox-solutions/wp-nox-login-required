<?php

    namespace noxwp\lr\plugin;

    use noxwp\lr\base\Login_Required_Base;

    /**
     * Login Required Admin
     */
    class Login_Required_Plugin extends Login_Required_Base
    {
        /**
         * Run all the required admin actions.
         */
        public function run()
        {
            $enabled = (bool)get_option($this->prefix('setting_enabled'));

            if ($enabled) {
                $this->apply_general_actions();
                $this->apply_rest_actions();
            }
        }

        protected function apply_general_actions()
        {
            add_action(
                'template_redirect',
                function () {
                    if (!is_user_logged_in()) {
                        $canRedirect = (bool)get_option($this->prefix('setting_can_redirect'));

                        if (!$canRedirect) {
                            $htmlFilePath = get_option($this->prefix('setting_file_patth'));

                            if (is_file($htmlFilePath)) {
                                $html = file_get_contents($htmlFilePath);

                                echo $html;

                                http_response_code(200);

                                exit;
                            }

                            $canRedirect = true;
                        }

                        if ($canRedirect) {
                            auth_redirect();
                        }
                    }
                }
            );

            add_action(
                'plugins_loaded',
                static function () {
                    remove_filter('lostpassword_url', 'wc_lostpassword_url');
                }
            );
        }

        protected function apply_rest_actions()
        {
            $enable_rest = (bool)get_option($this->prefix('setting_rest_enabled'));

            if (!$enable_rest) {
                add_filter(
                    'rest_authentication_errors',
                    function ($result) {
                        if (!empty($result)) {
                            return $result;
                        }

                        if (!is_user_logged_in()) {
                            return new \WP_Error('rest_not_logged_in', 'API Requests are only supported for authenticated requests.', ['status' => 401]);
                        }

                        return $result;
                    }
                );
            }
        }
    }
