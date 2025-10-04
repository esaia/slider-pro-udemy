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

define('SLDP_PLUGIN_PATH', __FILE__);


function dd($data)
{

    error_log(print_r($data, true));
    die();
}


require_once plugin_dir_path(SLDP_PLUGIN_PATH) . 'includes/migrations.php';
require_once plugin_dir_path(SLDP_PLUGIN_PATH) . 'includes/init.php';
