<?php

// Define a function to add the column
function add_custom_columns_on_activation() {
    global $wpdb;

    // Define the table name and new column names
    $table_name = $wpdb->prefix . 'amelia_customer_bookings'; // Replace 'wp_' with your WordPress table prefix if different
    $new_column_name_1 = 'booking_additional_text'; // Replace with your desired column name
    $new_column_name_2 = 'booking_additional_uploaded_image'; // New column for JSON encoded data

    // Check if the columns exist in the table
    $column_exists_1 = $wpdb->get_var("SHOW COLUMNS FROM $table_name LIKE '$new_column_name_1'");
    $column_exists_2 = $wpdb->get_var("SHOW COLUMNS FROM $table_name LIKE '$new_column_name_2'");

    if (!$column_exists_1) {
        // Column 1 doesn't exist, so add it as a LONGTEXT
        $wpdb->query("ALTER TABLE $table_name ADD COLUMN $new_column_name_1 LONGTEXT AFTER actionsCompleted");
    } else {
        // Column 1 already exists
        echo "Column '$new_column_name_1' already exists in the table.";
    }

    if (!$column_exists_2) {
        // Column 2 doesn't exist, so add it as a LONGTEXT for JSON encoded data
        $wpdb->query("ALTER TABLE $table_name ADD COLUMN $new_column_name_2 LONGTEXT AFTER $new_column_name_1");
    } else {
        // Column 2 already exists
        echo "Column '$new_column_name_2' already exists in the table.";
    }


    // wp_amelia_users new column added name will be hourly_rate
    $table_name_amelia_users = $wpdb->prefix . 'amelia_users';
    $new_column_name_3 = 'hourly_rate';
    $column_exists_3 = $wpdb->get_var("SHOW COLUMNS FROM $table_name_amelia_users LIKE '$new_column_name_3'");
    if (!$column_exists_3) {
        // Column 1 doesn't exist, so add it as a LONGTEXT
        $wpdb->query("ALTER TABLE $table_name_amelia_users ADD COLUMN $new_column_name_3 int AFTER badgeId	");
    }

}
// Hook the function to plugin activation
register_activation_hook(__FILE__, 'add_custom_columns_on_activation');



