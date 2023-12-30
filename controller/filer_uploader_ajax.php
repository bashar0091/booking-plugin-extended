<?php

function image_upload_handler_callback() {
    if (!empty($_FILES['file']['name'])) {
        $allowed_types = array('image/jpeg', 'image/png', 'application/pdf');
        $file_type = $_FILES['file']['type'];

        if (in_array($file_type, $allowed_types)) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $attachment_id = media_handle_upload('file', 0); // Upload the file to the media library

            if (is_wp_error($attachment_id)) {
                echo json_encode(array('error' => $attachment_id->get_error_message()));
            } else {
                $image_url = wp_get_attachment_url($attachment_id); // Get the URL of the uploaded image
                echo json_encode(array('url' => $image_url, 'id' => $attachment_id)); // Return URL and ID in the JSON response
            }
        } else {
            echo json_encode(array('error' => 'Please upload only JPG, PNG, or PDF files.'));
        }
    } else {
        echo json_encode(array('error' => 'No file received'));
    }

    wp_die(); // Always use wp_die() to end AJAX handling in WordPress
}

add_action('wp_ajax_image_upload_handler', 'image_upload_handler_callback');
add_action('wp_ajax_nopriv_image_upload_handler', 'image_upload_handler_callback');




// file delete 
add_action('wp_ajax_delete_image_action', 'delete_image_function');
add_action('wp_ajax_nopriv_delete_image_action', 'delete_image_function'); // If you need this action for non-logged in users

function delete_image_function() {
    if (isset($_POST['image_id'])) {
        $image_id = sanitize_text_field($_POST['image_id']);
        
        wp_delete_attachment($image_id, true);
        
        echo 'Image deleted successfully';
    }
    wp_die();
}
