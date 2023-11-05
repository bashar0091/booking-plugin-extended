<?php
add_action('wp_ajax_calenderRequest', 'calenderRequest_handler');
add_action('wp_ajax_nopriv_calenderRequest', 'calenderRequest_handler');

function calenderRequest_handler(){
    
    session_start();

    $_SESSION['dateGet'] = $_POST['dateGet'];

    $day = $_POST['dayGet'];
    
    if ($day == 'Monday') {
        $_SESSION['day_index'] = 1;
    } elseif ($day == 'Tuesday') {
        $_SESSION['day_index'] = 2;
    } elseif ($day == 'Wednesday') {
        $_SESSION['day_index'] = 3;
    } elseif ($day == 'Thursday') {
        $_SESSION['day_index'] = 4;
    } elseif ($day == 'Friday') {
        $_SESSION['day_index'] = 5;
    } elseif ($day == 'Saturday') {
        $_SESSION['day_index'] = 6;
    } elseif ($day == 'Sunday') {
        $_SESSION['day_index'] = 7;
    } else {
        $_SESSION['day_index'] = 0;
    }

}