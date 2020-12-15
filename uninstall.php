<?php

    defined('WP_UNINSTALL_PLUGIN') or die();

    delete_option('wp_nox_lr_enabled');
    delete_option('wp_nox_lr_rest_enabled');
    delete_option('wp_nox_lr_custom_html');
    delete_option('wp_nox_lr_custom_html_contents');
