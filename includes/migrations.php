<?php

if (!defined('ABSPATH')) {
    exit;
}


register_activation_hook(SLDP_PLUGIN_PATH, 'sldp_create_tables');

function sldp_create_tables()
{
    global $wpdb;

    $sliders_table = $wpdb->prefix . 'sldp_sliders';
    $slider_metas_table = $wpdb->prefix . 'sldp_slider_metas';

    $charset_collate = $wpdb->get_charset_collate();

    $sliders_sql = "CREATE TABLE $sliders_table (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        slides JSON,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";


    $slider_metas_sql = "CREATE TABLE $slider_metas_table (
        meta_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        slider_id bigint(20) unsigned NOT NULL,
        meta_key varchar(255) NOT NULL,
        meta_value longtext,
        PRIMARY KEY (meta_id),
        KEY slider_id (slider_id),
        KEY meta_key (meta_key)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sliders_sql);
    dbDelta($slider_metas_sql);
}
