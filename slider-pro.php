<?php
/*
 * Plugin Name: Slider Pro
 * Version: 1.0.0
 * Description: Create awesome sliders in WordPress.
 * Author: Esaia Gaprindashvili
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

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
    include_once plugin_dir_path(__FILE__) . 'templates/index.php';
}
