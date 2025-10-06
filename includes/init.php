<?php


if (!defined('ABSPATH')) {
    exit;
}



function sldp_add_admin_menu()
{
    add_menu_page(
        'Slider Pro',
        'Slider Pro',
        'manage_options',
        'slider-pro',
        'sldp_render_page',
        'dashicons-slides',
        100
    );
}

add_action('admin_menu', 'sldp_add_admin_menu');


function sldp_render_page()
{
    include_once plugin_dir_path(SLDP_PLUGIN_PATH) . 'templates/index.php';
}


function sldp_enque_scripts($hook)
{

    if ($hook !== 'toplevel_page_slider-pro' || wp_script_is('sldp-vue-js', 'enqueued')) return;


    wp_enqueue_media();

    wp_enqueue_script(
        'sldp-vue-js',
        plugin_dir_url(SLDP_PLUGIN_PATH) . 'dist/assets/index.js',
        [],
        null,
        true
    );

    wp_enqueue_style(
        'sldp-vue-styles',
        plugin_dir_url(SLDP_PLUGIN_PATH) . 'dist/assets/index.css'
    );

    wp_localize_script('sldp-vue-js', 'sliderPro', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}

add_action('admin_enqueue_scripts', 'sldp_enque_scripts', 5);


function sldp_force_module_type_attribute($tag, $handle)
{

    if ($handle === 'sldp-vue-js') {
        $script_url = plugin_dir_url(SLDP_PLUGIN_PATH) . 'dist/assets/index.js';

        return '<script type="module" defer src="' . esc_url($script_url) . '" id="' . $handle . '-js" ></script>';
    }

    return $tag;
}

add_filter('script_loader_tag', 'sldp_force_module_type_attribute', 10, 2);
