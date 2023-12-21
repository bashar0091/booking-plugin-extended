<?php
add_action('wp_ajax_calenderRequest', 'calenderRequest_handler');
add_action('wp_ajax_nopriv_calenderRequest', 'calenderRequest_handler');

function calenderRequest_handler(){
    
    session_start();

    $dateGet = $_POST['dateGet'];

    $day = $_POST['dayGet'];

    echo json_encode(
        array(
            'get_url' => home_url().'/varaa-etavastaanotto/?päivä='.$day.'&päivämäärä='.$dateGet,
        ),
    );

    wp_die();

}