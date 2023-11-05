<?php
/**
 * Plugin Name: Amelia Support plugin by Pilar
 * Plugin URI:
 * Description:
 * Version: 1.0.0
 * Author: Pilar Dev
 * Author URI:
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: amelia_support_pilar
 */

// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

/**
 * Require All CSS Files Here
 */
function wc_ws_bf_enqueue_style() {
    wp_enqueue_style('customized-style', plugin_dir_url(__FILE__) . 'assets/custom.css', false, time(), 'all');
}
add_action('wp_enqueue_scripts', 'wc_ws_bf_enqueue_style');

/**
 * Require All JS Files Here
 */
function wc_ws_bf_enqueue_scripts() {
    wp_enqueue_script('jquery-script', 'https://code.jquery.com/jquery-3.7.1.min.js', array('jquery'), time(), true);
    wp_enqueue_script('calendar-script', plugin_dir_url(__FILE__) . 'assets/jquery.bs.calendar.js', array('jquery'), time(), true);
    wp_enqueue_script('customed-script', plugin_dir_url(__FILE__) . 'assets/custom.js', array('jquery'), time(), true);

    // Ajax Request URL
    wp_localize_script('customed-script', 'bookAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wc_ws_bf_enqueue_scripts');

/**
 * Require All Include Files Here
 */
require_once plugin_dir_path(__FILE__) . 'shortcode/employee-show.php';
require_once plugin_dir_path(__FILE__) . 'shortcode/employee-show-calendar-ajax.php';

/**
 * WooCommerce booking product add to cart with additional data
 */
function process_to_booking_cart() {
    session_start();

    if (isset($_POST['pilar_booking_cart'])) {

        $wc_product_id = $_POST['wc_product_id'];
        $service_name = $_POST['service_name'];
        $doctor_name = $_POST['doctor_name'];
        $time_date = $_POST['time_date'];

        $cart_item_data = array(
            'APPOINTMENT INFO' => '',
            'time_date' => $time_date,
            'service_name' => $service_name,
            'doctor_name' => $doctor_name,
        );

        WC()->cart->add_to_cart($wc_product_id, 1, 0, array(), $cart_item_data);

        // Set data to session
        $_SESSION['pilar_booking_start'] = $_POST['pilar_booking_start'];
        $_SESSION['pilar_booking_end'] = $_POST['pilar_booking_end'];
        $_SESSION['pilar_service_id'] = $_POST['pilar_service_id'];
        $_SESSION['pilar_provider_id'] = $_POST['pilar_provider_id'];
        $_SESSION['pilar_booking_price'] = $_POST['pilar_booking_price'];
        $_SESSION['pilar_current_user_id'] = $_POST['pilar_current_user_id'];

        // Redirect to checkout
        $checkout_url = wc_get_checkout_url();
        wp_redirect($checkout_url);
        exit;
    }
}
add_action('template_redirect', 'process_to_booking_cart');

// Display custom field
function display_custom_product_field_on_cart($cart_item_data, $cart_item) {
    if (isset($cart_item['time_date'])) {
        $cart_item_data[] = array(
            'name' => 'LOCAL TIME',
            'value' => $cart_item['time_date'],
        );
    }

    if (isset($cart_item['service_name'])) {
        $cart_item_data[] = array(
            'name' => 'PALVELU',
            'value' => $cart_item['service_name'],
        );
    }

    if (isset($cart_item['doctor_name'])) {
        $cart_item_data[] = array(
            'name' => 'KARDIOLOGI',
            'value' => $cart_item['doctor_name'],
        );
    }

    return $cart_item_data;
}
add_filter('woocommerce_get_item_data', 'display_custom_product_field_on_cart', 10, 2);

/**
 * Order confirm to set appointment
 */
add_action('woocommerce_thankyou', 'custom_woocommerce_thankyou_message');

function custom_woocommerce_thankyou_message($order_id) {
    session_start();

    // Check if this is a valid order
    if (!$order_id) {
        return;
    }

    // Get the order object
    $order = wc_get_order($order_id);

    global $wpdb;

    // Insert data into the 'amelia_appointments' table
    $table_name_appointments = $wpdb->prefix . 'amelia_appointments';

    $data_appointments = array(
        'status' => 'approved',
        'bookingStart' => $_SESSION['pilar_booking_start'],
        'bookingEnd' => $_SESSION['pilar_booking_end'],
        'notifyParticipants' => 1,
        'serviceId' => $_SESSION['pilar_service_id'],
        'providerId' => $_SESSION['pilar_provider_id'],
    );

    $wpdb->insert($table_name_appointments, $data_appointments);

    // Get the ID of the inserted row
    $appointment_id = $wpdb->insert_id;

    // Insert data into the 'wp_amelia_customer_bookings' table
    $table_name_customer_bookings = $wpdb->prefix . 'amelia_customer_bookings';

    $data_customer_bookings = array(
        'appointmentId' => $appointment_id,
        'customerId' => $_SESSION['pilar_current_user_id'],
        'status' => 'approved',
        'price' => $_SESSION['pilar_booking_price'],
        'persons' => 1
    );

    $wpdb->insert($table_name_customer_bookings, $data_customer_bookings);

    echo '<script>sessionStorage.removeItem("date_set_click");</script>';
    session_destroy();
}