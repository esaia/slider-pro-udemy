<?php


if (!defined('ABSPATH')) {
    exit;
}


class SldpSliderAjaxHandler
{
    public function __construct()
    {

        add_action('wp_ajax_foobar', [$this, 'my_ajax_foobar_handler']);
    }


    private function verify_request($action = 'slider_pro_nonce')
    {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', $action)) {
            wp_send_json_error('Security check failed', 403);
        }

        return true;
    }

    public function my_ajax_foobar_handler()
    {

        $this->verify_request();

        wp_send_json_success('success');
    }
}


if (is_admin() || wp_doing_ajax()) {
    new SldpSliderAjaxHandler();
}
