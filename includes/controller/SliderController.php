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
        add_action('wp_ajax_sldp_get_sliders', [$this, 'get_Sliders']);
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

    private function map_slider_data($item)
    {
        $item = (array)$item;

        if (!empty($item['slides'])) {
            $item['slides'] = json_decode($item['slides'], true);
        } else {
            $item['slides'] = [];
        }

        return $item;
    }

    public function create_slider()
    {

        $this->verify_request();

        $data = $this->validate_slider_data();

        $insertedId = $this->wpdb->insert('wp_sldp_sliders', $data);

        wp_send_json_success('success ' . $insertedId);
    }

    public function get_Sliders()
    {
        $this->verify_request();

        $page = absint($_POST['page'] ?? 1);
        $perPage = absint($_POST['perPage'] ?? 1);
        $offset = ($page - 1) * $perPage;


        $count = $this->wpdb->get_var("SELECT count(*) FROM wp_sldp_sliders");

        $data = $this->wpdb->get_results("SELECT * FROM wp_sldp_sliders LIMIT $perPage OFFSET $offset");


        $data = array_map([$this, 'map_slider_data'], $data);

        $data = [
            'data'           => $data,
            'total'          => (int)$count,
            'per_page'       => $perPage,
            'page'           => $page,
            'total_pages'    => ceil($count / $perPage),
        ];

        wp_send_json_success($data);
    }
}


if (is_admin() || wp_doing_ajax()) {
    new SldpSliderAjaxHandler();
}
