<?php
/**
 * Plugin Name: Amelia Support plugin by pilar
 * Plugin URI: 
 * Description: 
 * Version: 1.0.0
 * Author: Pilar Dev
 * Author URI: 
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: amelia_support
 */


// Prevent direct access to the plugin file
defined( 'ABSPATH' ) || exit;

/**
 * 
 * Require All Css Files Here
 * 
 */
function wc_ws_bf_enqueue_style() {
    wp_enqueue_style( 'customeed-style', plugin_dir_url( __FILE__ ) . 'assets/custom.css', false, time(), 'all' );
}
add_action( 'wp_enqueue_scripts', 'wc_ws_bf_enqueue_style' );


/**
 * 
 * Require All Js Files Here
 * 
 */
function wc_ws_bf_enqueue_scripts() {
    wp_enqueue_script( 'jquery-script', 'https://code.jquery.com/jquery-3.7.1.min.js', array( 'jquery' ), time(), true );
    wp_enqueue_script( 'customeed-script', plugin_dir_url( __FILE__ ) . 'assets/custom.js', array( 'jquery' ), time(), true );
}
add_action( 'wp_enqueue_scripts', 'wc_ws_bf_enqueue_scripts' );



/**
 * 
 * Require All Includes Files Here
 * 
 */
require_once plugin_dir_path( __FILE__ ) . 'shortcode/employee-show.php';



/**
 * 
 * woocommerce booking product add to cart with additional data 
 * 
 */
function process_to_booking_cart() {
    if(isset($_POST['pilar_booking_cart'])){
        
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

        // redirect to checkout 
        $checkout_url = wc_get_checkout_url();
        wp_redirect($checkout_url);
        exit;

}
}
add_action('template_redirect', 'process_to_booking_cart');

// display custom field 
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