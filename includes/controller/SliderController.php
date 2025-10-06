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

    public function my_ajax_foobar_handler()
    {
        // ADD SLIDER RECORD TO DB
        wp_send_json_success('success');
    }
}


if (is_admin() || wp_doing_ajax()) {
    new SldpSliderAjaxHandler();
}
