<?php
/**
 * Shortcode for employee_show
 */

require_once('booking-form.php');

function employee_show() {
    
    $timezone = get_option('timezone_string');
    date_default_timezone_set($timezone);

    $result = '';

    global $wpdb;

    $weekdays_table_name = $wpdb->prefix . 'amelia_providers_to_weekdays'; 
    $periods_table_name = $wpdb->prefix . 'amelia_providers_to_periods';
    $users_table = $wpdb->prefix . 'amelia_users';
    $periods_services_table = $wpdb->prefix . 'amelia_providers_to_periods_services';
    $amelia_services_table = $wpdb->prefix . 'amelia_services';

    $current_time = date("H:i:s");

    $date = date("l");
    $dayIndex = '';
    if($date == 'Monday') {
        $dayIndex = 1;
    } elseif($date == 'Tuesday') {
        $dayIndex = 2;
    } elseif($date == 'Wednesday') {
        $dayIndex = 3;
    } elseif($date == 'Thursday') {
        $dayIndex = 4;
    } elseif($date == 'Friday') {
        $dayIndex = 5;
    } elseif($date == 'Saturday') {
        $dayIndex = 6;
    } elseif($date == 'Sunday') {
        $dayIndex = 7;
    }

    // weekdays query 
    $query = $wpdb->prepare(
        "SELECT id, userId FROM $weekdays_table_name WHERE dayIndex = %d",
        $dayIndex
    );
    $weekday_ids = $wpdb->get_results($query);

    $employees = array();

    if ($weekday_ids) {
        foreach ($weekday_ids as $weekday_id) {

            $id = $weekday_id->id;
            $userId = $weekday_id->userId;

            // user query 
            $query = $wpdb->prepare(
                "SELECT firstName, lastName, pictureFullPath, email, phone FROM $users_table WHERE id = %d",
                $userId
            );
            $userData = $wpdb->get_row($query);

            $firstName = $userData->firstName;
            $lastName = $userData->lastName;
            $user_email = $userData->email;
            $user_phone = $userData->phone;
            
            $image = $userData->pictureFullPath;

            $firstCharacterFirstName = substr($firstName, 0, 1);
            $firstCharacterLastName = substr($lastName, 0, 1);
            $image_url = ( !empty($image) ? $image : "https://via.placeholder.com/120/000/fff?text=$firstCharacterFirstName$firstCharacterLastName" );
            
            // periods query 
            $query = $wpdb->prepare(
                "SELECT startTime, endTime, id FROM $periods_table_name WHERE weekDayId = %d",
                $id
            );
            $times = $wpdb->get_results($query);

            if ($times) {
                foreach ($times as $time) {
                    
                    $startTime = $time->startTime;
                    $endTime = $time->endTime;
                    $period_id = $time->id;

                    if ($startTime < $current_time) {
                        continue;
                    }

                    $startTimeDateTime = new DateTime($startTime);
                    $endTimeDateTime = new DateTime($endTime);

                    $startTimeFormatted = $startTimeDateTime->format('H:i');

                    $interval = $startTimeDateTime->diff($endTimeDateTime);
                    $minutesDifference = $interval->format('%i');

                    $hoursDifference = $interval->format('%h');

                    if ($hoursDifference > 0) {
                        $differenceTime = sprintf('%02d hour:%02d min', $hoursDifference, $minutesDifference);
                    } else {
                        $differenceTime = sprintf('%d min', $minutesDifference);
                    }

                    // service query 
                    $query = $wpdb->prepare(
                        "SELECT serviceId FROM $periods_services_table WHERE periodId = %d",
                        $period_id
                    );
                    $period_services = $wpdb->get_row($query);
                    $service_id =  $period_services->serviceId;

                    // services list query 
                    $query = $wpdb->prepare(
                        "SELECT name FROM $amelia_services_table WHERE id = %d",
                        $service_id
                    );
                    $service_list = $wpdb->get_row($query);
                    $service_name =  $service_list->name;

                    $employees[] = array(
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $user_email,
                        'phone' => $user_phone,
                        'image_url' => $image_url,
                        'startTimeFormatted' => $startTimeFormatted,
                        'differenceTime' => $differenceTime,
                        'service' => $service_name,
                    );
                }
            } else {
                echo "No results found for ID: $id<br>";
            }
        }
    } else {
        echo "No results found for dayIndex: $dayIndex";
    }

    // Sort employees by startTimeFormatted
    usort($employees, function($a, $b) {
        return strtotime($a['startTimeFormatted']) - strtotime($b['startTimeFormatted']);
    });

    foreach ($employees as $employee) {
        $result .= '
        <div class="pilar_off">
            <div class="am-service pilar-employee">
                <div class="am-service-header popup_show">
                    <div class="am-service-image"><img src="'.$employee['image_url'].'" /></div>
                    <div class="am-service-data">
                        <div class="am-service-title"><h2>'.$employee['firstName'] .' '. $employee['lastName'] .'</h2></div>
                        <div class="am-service-info">
                            <div class="am-service-provider">
                                '. $employee['service'] .'
                            </div>
                            <div>
                                <img src="http://localhost/wp/amelia/wp-content/plugins/ameliabooking/public/img/user.svg" alt="capacity" />
                            </div>
                            <div>
                                <img src="http://localhost/wp/amelia/wp-content/plugins/ameliabooking/public/img/duration.svg" alt="capacity" />
                                '. $employee['differenceTime'] .'
                            </div>
                        </div>
                    </div>
                    <div class="am-service-price">
                        '. $employee['startTimeFormatted'] .'
                    </div>
                </div>

                '.booking_form($employee['image_url'], $employee['firstName'], $employee['lastName'], $employee['service'], $employee['startTimeFormatted'], $employee['startTimeFormatted'], $employee['phone']).'
            </div>
        </div>
        ';
    }

    return $result;
}

add_shortcode( 'support-employee', 'employee_show' );