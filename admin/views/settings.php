<?php

    use noxwp\lr\admin\Login_Required_Admin;

    /**
     * @var Login_Required_Admin $this
     */

?>
<div class="wrap">
    <h1><?= __('Login Required by NOX', $this->plugin_domain); ?></h1>

    <form action="<?= admin_url('options.php'); ?>" method="post">

        <?php settings_fields($this->plugin_options_page_slug); ?>

        <?php do_settings_sections($this->plugin_options_page_slug); ?>

        <?php submit_button(); ?>

    </form>
</div>
