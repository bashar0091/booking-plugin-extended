<?php

// Define a function to add the column
function add_custom_column_on_activation() {
    global $wpdb;

    // Define the table name and new column name
    $table_name = $wpdb->prefix . 'amelia_customer_bookings'; // Replace 'wp_' with your WordPress table prefix if different
    $new_column_name = 'booking_additional_text'; // Replace with your desired column name

    // Check if the column exists in the table
    $column_exists = $wpdb->get_var("SHOW COLUMNS FROM $table_name LIKE '$new_column_name'");

    if (!$column_exists) {
        // Column doesn't exist, so add it as a LONGTEXT
        $wpdb->query("ALTER TABLE $table_name ADD COLUMN $new_column_name LONGTEXT AFTER actionsCompleted");
    } else {
        // Column already exists, perform any alternative actions or skip
        echo "Column '$new_column_name' already exists in the table.";
    }
}

// Hook the function to plugin activation
register_activation_hook(__FILE__, 'add_custom_column_on_activation');