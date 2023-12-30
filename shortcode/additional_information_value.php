<?php

function additional_information() {
    global $wpdb;

    $bookings_table = $wpdb->prefix . 'amelia_customer_bookings';
    $appointments_table = $wpdb->prefix . 'amelia_appointments';

    $results = $wpdb->get_results(
        "SELECT cb.booking_additional_text, cb.booking_additional_uploaded_image, ap.id AS appointment_id, ap.zoomMeeting
        FROM $bookings_table cb
        LEFT JOIN $appointments_table ap ON cb.appointmentId = ap.id
        WHERE cb.booking_additional_text IS NOT NULL"
    );

    if ($results) {
        $output = '<table class="info_linking_table"><tbody>';

        foreach ($results as $result) {
            $zoomMeeting = json_decode($result->zoomMeeting);
            $joinUrl = isset($zoomMeeting->joinUrl) ? $zoomMeeting->joinUrl : 'N/A';

            // Unserialize the data and create image tags for each URL
            $image_data = json_decode($result->booking_additional_uploaded_image, true);
            $images = '';

            if (is_array($image_data)) {
                foreach ($image_data as $id => $url) {
                    $images .= '<span><input type="hidden" class="uploaded_image_id" value="' . $id. '" name="uploaded_image_id[]"/><input type="hidden" value="' . esc_url($url) . '" name="uploaded_image[]"/><a href="' . esc_url($url) . '" target="_blank"><img src="' . esc_url($url) . '"></a><button class="remove_image_upload">x</button></span>';
                }
            }

            // Adjust the output to include the additional image data
            $output .= '<tr><td class="relation_text">' . $result->booking_additional_text . '</td><td class="relation_link">' . $joinUrl . '</td><td class="uploaded_image_column">' . $images . '</td></tr>';
        }

        $output .= '</tbody></table>';
    }

    return $output;
}

add_shortcode( 'additional_info', 'additional_information' );