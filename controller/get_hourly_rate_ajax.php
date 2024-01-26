<?php

// show hourly rate value 
function get_hourly_rate_value_callback() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'amelia_users';
    $column_name = 'hourly_rate';
    $id = $_POST['numeric_id'];

    $hourly_rate = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT $column_name FROM $table_name WHERE id = %d",
            $id
        )
    );

    echo json_encode(
        array(
            'hourly_rate_data' => $hourly_rate,
        )
    );

    wp_die();

}

add_action('wp_ajax_get_hourly_rate_value', 'get_hourly_rate_value_callback');
add_action('wp_ajax_nopriv_get_hourly_rate_value', 'get_hourly_rate_value_callback');


// update_hourly rate value 
function update_hourly_rate_value_callback() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'amelia_users';
    $column_name = 'hourly_rate';
    $id = $_POST['numeric_id'];
    $new_hourly_rate = isset($_POST['new_hourly_rate']) ? floatval($_POST['new_hourly_rate']) : 0.0;

    $wpdb->update(
        $table_name,
        array($column_name => $new_hourly_rate),
        array('id' => $id),
        array('%f'),
        array('%d')
    );

    echo json_encode(
        array(
            'hourly_rate_data' => $hourly_rate,
        )
    );

    wp_die();

}

add_action('wp_ajax_update_hourly_rate_value', 'update_hourly_rate_value_callback');
add_action('wp_ajax_nopriv_update_hourly_rate_value', 'update_hourly_rate_value_callback');