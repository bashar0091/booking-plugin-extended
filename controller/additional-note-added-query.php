<?php

if( isset($_POST['add_info']) ){

    global $wpdb;

    $appointments_table = $wpdb->prefix . 'amelia_appointments';
    $bookings_table = $wpdb->prefix . 'amelia_customer_bookings';
    
    $zoom_meeting_url = $_POST['zoom_link_val'];
    
    // Fetch rows containing the JSON field
    $rows = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $appointments_table WHERE zoomMeeting IS NOT NULL"
        ),
        ARRAY_A
    );
    
    if ($rows) {
        foreach ($rows as $row) {
            // Decode JSON data from the 'zoomMeeting' column
            $zoom_data = json_decode($row['zoomMeeting'], true);
    
            // Check if the 'joinUrl' field exists and matches the provided URL
            if (isset($zoom_data['joinUrl']) && $zoom_data['joinUrl'] === $zoom_meeting_url) {
    
                $appointment_id = $row['id']; // Assuming 'id' is the appointment ID in appointments table
    
                // Update booking_additional_text in customer bookings table based on appointment ID
                $wpdb->update(
                    $bookings_table,
                    array('booking_additional_text' => $_POST['additiona_info_text']),
                    array('appointmentId' => $appointment_id)
                );

                if(isset($_POST['uploaded_image'])) {
                    $combined_images = array_combine($_POST['uploaded_image_id'], $_POST['uploaded_image']);
                    $wpdb->update(
                        $bookings_table,
                        array('booking_additional_uploaded_image' => json_encode($combined_images)),
                        array('appointmentId' => $appointment_id)
                    );
                } else {
                    $wpdb->update(
                        $bookings_table,
                        array('booking_additional_uploaded_image' => null),
                        array('appointmentId' => $appointment_id)
                    );
                }
                
            }
        }
    }

}