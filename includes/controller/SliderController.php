<?php


if (!defined('ABSPATH')) {
    exit;
}


class SldpSliderAjaxHandler
{

    private $wpdb;
    private $sliders_table;
    private $slider_metas_table;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->sliders_table = $wpdb->prefix . 'sldp_sliders';
        $this->slider_metas_table = $wpdb->prefix . 'sldp_slider_metas';

        add_action('wp_ajax_sldp_create_slider', [$this, 'create_slider']);
        add_action('wp_ajax_sldp_delete_slider', [$this, 'delete_Sliders']);
        add_action('wp_ajax_sldp_get_sliders', [$this, 'get_Sliders']);
    }

    private function send_error($message, $code = 400)
    {
        wp_send_json_error(['message' => $message], $code);
    }

    private function send_success($data)
    {
        wp_send_json_success($data);
    }


    private function verify_request($action = 'slider_pro_nonce')
    {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', $action)) {
            $this->send_error('Security check failed', 403);
        }

        return true;
    }

    private function validate_slider_data()
    {

        $title = sanitize_text_field($_POST['title'] ?? '');
        $slides = wp_unslash($_POST['slides'] ?? []);

        if (empty($title)) {
            $this->send_error('Title is required');
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

        $this->wpdb->insert($this->sliders_table, $data);

        $this->send_success('Slider created successfully');
    }

    public function delete_Sliders()
    {
        $slider_id = absint($_POST['id'] ?? 0);

        if (empty($slider_id)) {
            $this->send_error('Slider id is required');
        }

        $this->wpdb->delete($this->sliders_table, ['id' => $slider_id]);

        $this->send_success('Slider deleted successfully');
    }


    public function get_Sliders()
    {
        $this->verify_request();

        $page = absint($_POST['page'] ?? 1);
        $perPage = absint($_POST['perPage'] ?? 1);
        $offset = ($page - 1) * $perPage;


        $params = [$perPage, $offset];

        $count = $this->wpdb->get_var("SELECT count(*) FROM $this->sliders_table");

        $query = "SELECT * FROM wp_sldp_sliders LIMIT %d OFFSET %d";

        $data = $this->wpdb->get_results($this->wpdb->prepare($query, ...$params));


        $data = $this->wpdb->get_results("SELECT * FROM wp_sldp_sliders ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");


        $data = array_map([$this, 'map_slider_data'], $data);

        $data = [
            'data'           => $data,
            'total'          => (int) $count,
            'per_page'       => $perPage,
            'page'           => $page,
            'total_pages'    => ceil($count / $perPage),
        ];

        $this->send_success($data);
    }
}


if (is_admin() || wp_doing_ajax()) {
    new SldpSliderAjaxHandler();
}
