<?php


if (!defined('ABSPATH')) {
    exit;
}


class SldpSliderAjaxHandler
{

    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        add_action('wp_ajax_sldp_create_slider', [$this, 'create_slider']);
    }


    private function verify_request($action = 'slider_pro_nonce')
    {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', $action)) {
            wp_send_json_error('Security check failed', 403);
        }

        return true;
    }

    private function validate_slider_data()
    {

        $title = sanitize_text_field($_POST['title'] ?? '');
        $slides = wp_unslash($_POST['slides'] ?? []);

        if (empty($title)) {
            wp_send_json_error('Title is required');
        }

        $slides = wp_json_encode($slides);

        return compact('title', 'slides');
    }

    public function create_slider()
    {

        $this->verify_request();

        $data = $this->validate_slider_data();

        $insertedId = $this->wpdb->insert('wp_sldp_sliders', $data);

        wp_send_json_success('success ' . $insertedId);
    }
}


if (is_admin() || wp_doing_ajax()) {
    new SldpSliderAjaxHandler();
}
