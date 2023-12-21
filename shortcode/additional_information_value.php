<?php

function additional_information() {

    global $wpdb;

    $bookings_table = $wpdb->prefix . 'amelia_customer_bookings';
    $appointments_table = $wpdb->prefix . 'amelia_appointments';

    $results = $wpdb->get_results(
        "SELECT cb.booking_additional_text, ap.id AS appointment_id, ap.zoomMeeting
        FROM $bookings_table cb
        LEFT JOIN $appointments_table ap ON cb.appointmentId = ap.id
        WHERE cb.booking_additional_text IS NOT NULL"
    );

    if ($results) {
        $output = '<table class="info_linking_table"><tbody>';

        foreach ($results as $result) {
            $zoomMeeting = json_decode($result->zoomMeeting);
            $joinUrl = isset($zoomMeeting->joinUrl) ? $zoomMeeting->joinUrl : 'N/A';

            $output .= '<tr><td class="relation_text">' . $result->booking_additional_text . '</td><td class="relation_link">' . $joinUrl . '</td></tr>';
        }

        $output .= '</tbody></table>';
    }

    return $output;

}

add_shortcode( 'additional_info', 'additional_information' );