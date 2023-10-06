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
    wp_enqueue_style( 'customeed-style', plugin_dir_url( __FILE__ ) . 'assets/custom.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'wc_ws_bf_enqueue_style' );


/**
 * 
 * Require All Js Files Here
 * 
 */
function wc_ws_bf_enqueue_scripts() {
    wp_enqueue_script( 'jquery-script', 'https://code.jquery.com/jquery-3.7.1.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'customeed-script', plugin_dir_url( __FILE__ ) . 'assets/custom.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wc_ws_bf_enqueue_scripts' );



/**
 * 
 * Require All Includes Files Here
 * 
 */
require_once plugin_dir_path( __FILE__ ) . 'shortcode/employee-show.php';
