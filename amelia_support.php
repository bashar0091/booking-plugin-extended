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
    wp_enqueue_script('calendar-script', plugin_dir_url(__FILE__) . 'assets/jquery.bs.calendar.js', array('jquery'), time(), true);
    wp_enqueue_script('customed-script', plugin_dir_url(__FILE__) . 'assets/custom.js', array('jquery'), time(), true);

    // Ajax Request URL
    wp_localize_script('customed-script', 'bookAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wc_ws_bf_enqueue_scripts');

/**
 * Require All JS Files Here for admin panel
 */
function wc_ws_bf_enqueue_scripts_admin() {
    wp_enqueue_style('customized-admin-style', plugin_dir_url(__FILE__) . 'assets/custom-admin.css', false, time(), 'all');

    wp_enqueue_script('html2pdf-admin-script', plugin_dir_url(__FILE__) . 'assets/html2pdf.bundle.min.js', array('jquery'), time(), true);
    wp_enqueue_script('customed-admin-script', plugin_dir_url(__FILE__) . 'assets/custom-admin.js', array('jquery'), time(), true);

    // Ajax Request URL
    wp_localize_script('customed-admin-script', 'adminAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_localize_script('customed-admin-script', 'shortcodeData', array(
        'additionalInfo' => do_shortcode('[additional_info]'),
    ));
}
add_action('admin_enqueue_scripts', 'wc_ws_bf_enqueue_scripts_admin');

/**
 * Require All Include Files Here
 */
require_once plugin_dir_path(__FILE__) . 'shortcode/employee-show.php';
require_once plugin_dir_path(__FILE__) . 'shortcode/employee-show-calendar-ajax.php';
require_once plugin_dir_path(__FILE__) . 'shortcode/additional_information_value.php';
require_once plugin_dir_path(__FILE__) . 'controller/additional-note-added-query.php';
require_once plugin_dir_path(__FILE__) . 'controller/make-table-column.php';
require_once plugin_dir_path(__FILE__) . 'controller/filer_uploader_ajax.php';
require_once plugin_dir_path(__FILE__) . 'controller/get_hourly_rate_ajax.php';

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
        $_SESSION['pilar_service_duration'] = $_POST['pilar_service_duration'];

        $_SESSION['user_first_name'] = $_POST['given-name'];
        $_SESSION['user_last_name'] = $_POST['family-name'];
        $_SESSION['user_email_add'] = $_POST['email'];
        $_SESSION['user_telephone'] = $_POST['tel'];

        $_SESSION['pilar_service_name'] = $_POST['pilar_service_name'];
        $_SESSION['pilar_zoom_user_id'] = $_POST['pilar_zoom_user_id'];



        // Redirect to checkout
        $checkout_url = wc_get_checkout_url();
        wp_redirect($checkout_url);
        exit;
    }
}
add_action('template_redirect', 'process_to_booking_cart');

// update woocommerce checkout 
function modify_checkout_fields($fields) {

    session_start();

    $user_first_name = isset($_SESSION['user_first_name']) ? $_SESSION['user_first_name'] : '';
    $user_last_name = isset($_SESSION['user_last_name']) ? $_SESSION['user_last_name'] : '';
    $user_email_add = isset($_SESSION['user_email_add']) ? $_SESSION['user_email_add'] : '';
    $user_telephone = isset($_SESSION['user_telephone']) ? $_SESSION['user_telephone'] : '';

    $fields['billing']['billing_first_name']['default'] = $user_first_name;
    $fields['billing']['billing_last_name']['default'] = $user_last_name;
    $fields['billing']['billing_email']['default'] = $user_email_add;
    $fields['billing']['billing_phone']['default'] = $user_telephone;

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'modify_checkout_fields');

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

function display_custom_product_field_on_checkout($item, $cart_item_key, $values, $order) {

    if (isset($values['time_date'])) {
        $item->add_meta_data('LOCAL TIME', $values['time_date'], true);
    }

    if (isset($values['service_name'])) {
        $item->add_meta_data('PALVELU', $values['service_name'], true);
    }

    if (isset($values['doctor_name'])) {
        $item->add_meta_data('KARDIOLOGI', $values['doctor_name'], true);
    }

    return $item;
}
add_filter('woocommerce_checkout_create_order_line_item', 'display_custom_product_field_on_checkout', 10, 4);


/**
 * Order confirm to set appointment
 */
add_action('woocommerce_thankyou', 'wc_after_order_action', 10, 1 );

function wc_after_order_action($order_id) {
    session_start();

    // Check if this is a valid order
    if (!$order_id) {
        return;
    }

    // Get the order object
    $order = wc_get_order($order_id);

    if ( $order && $order->is_paid() ) {
        global $wpdb;

        // make new user , if user is not logged in 
        $table_name_amelia_users = $wpdb->prefix . 'amelia_users';
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->id;
        $first_name = sanitize_text_field($_SESSION['user_first_name']);
        $last_name = sanitize_text_field($_SESSION['user_last_name']);
        $email = sanitize_email($_SESSION['user_email_add']);
        $phone = sanitize_text_field($_SESSION['user_telephone']);

        $wpdb->insert($table_name_amelia_users, array(
            'status' => 'visible',
            'type' => 'customer',
            'externalId' => $current_user_id, // Removed extra space after 'externalId'
            'firstName' => $first_name,
            'lastName' => $last_name,
            'email' => $email,
            'phone' => $phone,
        ), array(
            '%s', '%s', '%d', '%s', '%s', '%s', '%s' // Adjust other '%s' for other columns
        ));  

        // Insert data into the 'amelia_appointments' table
        $table_name_appointments = $wpdb->prefix . 'amelia_appointments';
 
//===================================zoom meeting api work
        $apiKey = 'HhlRutj6Rny9FgB1sTwfZA';
        $apiSecret = '4236FtlvPpMpr8GwlxSnCu2SdcBJw5Wo';
        $accountId = 'ZXzCOJ2QSDeDgoiXXCUSyg';

        $meeting_id = '';
        $start_url = '';
        $join_url = '';

        if (!empty($apiKey) && !empty($apiSecret) && !empty($accountId)) {
            $base64Credentials = base64_encode("$apiKey:$apiSecret");
            $token_url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=$accountId";

            $token_response = wp_remote_post($token_url, array(
                'headers' => array(
                    'Authorization' => "Basic $base64Credentials",
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ),
            ));

            if (!is_wp_error($token_response) && $token_response['response']['code'] == 200) {
                $token_data = json_decode($token_response['body'], true);
                $access_token = $token_data['access_token'];

                $user_id = $_SESSION['pilar_zoom_user_id'];
                $zoom_api_endpoint = "https://api.zoom.us/v2/users/$user_id/meetings";
                $zoom_api_data = array(
                    'topic' => $_SESSION['pilar_service_name'],
                    'type' => 2,
                    'start_time' => date( 'Y-m-d', strtotime( $_SESSION['pilar_booking_start'] ) ).'T'.date( 'H:i:s', strtotime( $_SESSION['pilar_booking_start'] ) ).'Z',
                    'duration' => $_SESSION['pilar_service_duration'] / 60,
                    'settings' => array(
                        'host_video' => true,
                        'participant_video' => true,
                        'join_before_host' => true,
                        'mute_upon_entry' => true,
                        'watermark' => true,
                        'audio' => 'voip',
                        'auto_recording' => 'cloud',
                    ),
                );

                $meeting_response = wp_remote_post($zoom_api_endpoint, array(
                    'headers' => array(
                        'Authorization' => "Bearer $access_token",
                        'Content-Type' => 'application/json',
                    ),
                    'body' => json_encode($zoom_api_data),
                ));

                if (!is_wp_error($meeting_response)) {
                    $meeting_code = $meeting_response['response']['code'];

                    if ($meeting_code == 201) {
                        $meeting_data = json_decode($meeting_response['body'], true);

                        $meeting_id = $meeting_data['id'];
                        $start_url = $meeting_data['start_url'];
                        $join_url = $meeting_data['join_url'];

                    } else {
                        echo 'Meeting creation failed. Error code: ' . $meeting_code;
                    }
                } else {
                    echo 'Failed to create meeting. Error: ' . $meeting_response->get_error_message();
                }
            } else {
                echo 'Failed to get access token.';
            }
        } else {
            echo 'API credentials are missing.';
        }
        $zoom_data = array(
            'id' => $meeting_id,
            'startUrl' => $start_url,
            'joinUrl' => $join_url,
        );
        $zoom_data_jsonData = json_encode($zoom_data);

        $data_appointments = array(
            'status' => 'approved',
            'bookingStart' => $_SESSION['pilar_booking_start'],
            'bookingEnd' => $_SESSION['pilar_booking_end'],
            'notifyParticipants' => 1,
            'serviceId' => $_SESSION['pilar_service_id'],
            'providerId' => $_SESSION['pilar_provider_id'],
            'zoomMeeting' => $zoom_data_jsonData,
        );
    
        $wpdb->insert($table_name_appointments, $data_appointments);
    
        // Get the ID of the inserted row
        $appointment_id = $wpdb->insert_id;
    
        // Insert data into the 'wp_amelia_customer_bookings' table
        $table_name_customer_bookings = $wpdb->prefix . 'amelia_customer_bookings';
        
        $data = array(
            'firstName' => $_SESSION['user_first_name'],
            'lastName' =>$_SESSION['user_last_name'],
            'phone' => $_SESSION['user_telephone'],
            'locale' => 'fi',
            'timeZone' => 'Europe/Helsinki',
            'urlParams' => null
        );
        $info_jsonData = json_encode($data);
    
        //user information get
        $current_user = wp_get_current_user();
        $table_name2 = $wpdb->prefix . 'amelia_users';
        $current_user_id = $current_user->id;
        $query2 = $wpdb->prepare( "SELECT * FROM $table_name2 WHERE externalId = %d", $current_user_id );
        $results2 = $wpdb->get_results( $query2 );

        $data_customer_bookings = array(
            'appointmentId' => $appointment_id,
            'customerId' => $results2[ 0 ]->id,
            'status' => 'approved',
            'price' => $_SESSION['pilar_booking_price'],
            'persons' => 1,
            'actionsCompleted' => 1,
            'info' => $info_jsonData,
            'created' => date( 'Y-m-d, h:i:s' ),
            'duration' => $_SESSION['pilar_service_duration'],
        );
    
        $wpdb->insert($table_name_customer_bookings, $data_customer_bookings);

        // Get the ID of the wp_amelia_customer_bookings
        $booking_id = $wpdb->insert_id;

        // Insert data into the 'wp_amelia_payments' table
        $table_name_amelia_payments = $wpdb->prefix . 'amelia_payments';

        $data_amelia_payments = array(
            'customerBookingId' => $booking_id,
            'amount' => $order->get_total(),
            'dateTime' => date( 'Y-m-d, h:i:s' ),
            'status' => 'paid',
            'gateway' => 'wc',
            'gatewayTitle' => $order->get_payment_method_title(),
            'entity' => 'appointment',
            'created' => date( 'Y-m-d, h:i:s' ),
            'actionsCompleted' => 1,
            'wcOrderId' => $order_id,
        );
        $wpdb->insert($table_name_amelia_payments, $data_amelia_payments);
   
        wp_redirect( home_url() . '/thank-you' );
        exit;
    }
}