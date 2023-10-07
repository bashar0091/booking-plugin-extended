<?php
/**
 * Shortcode for employee_show
 */
function employee_show() {
    
    $timezone = get_option('timezone_string');
    date_default_timezone_set($timezone);

    $result = '';

    global $wpdb;

    $weekdays_table_name = $wpdb->prefix . 'amelia_providers_to_weekdays'; 
    $periods_table_name = $wpdb->prefix . 'amelia_providers_to_periods';
    $users_table = $wpdb->prefix . 'amelia_users';

    $current_time = date("H:i:s");

    $dayIndex = 6;

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

            $query = $wpdb->prepare(
                "SELECT firstName, lastName, pictureFullPath FROM $users_table WHERE id = %d",
                $userId
            );

            $userData = $wpdb->get_row($query);

            $firstName = $userData->firstName;
            $lastName = $userData->lastName;
            
            $image = $userData->pictureFullPath;

            $firstCharacterFirstName = substr($firstName, 0, 1);
            $firstCharacterLastName = substr($lastName, 0, 1);
            $image_url = ( !empty($image) ? $image : "https://via.placeholder.com/120/000/fff?text=$firstCharacterFirstName$firstCharacterLastName" );
            
            $query = $wpdb->prepare(
                "SELECT startTime FROM $periods_table_name WHERE weekDayId = %d",
                $id
            );

            $times = $wpdb->get_results($query);

            if ($times) {
                foreach ($times as $time) {
                    
                    $startTime = $time->startTime;

                    if ($startTime < $current_time) {
                        continue;
                    }

                    $startTimeDateTime = new DateTime($startTime);

                    $startTimeFormatted = $startTimeDateTime->format('H:i');

                    $employees[] = array(
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'image_url' => $image_url,
                        'startTimeFormatted' => $startTimeFormatted
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
                <div class="am-service-header">
                    <div class="am-service-image"><img src="'.$employee['image_url'].'" /></div>
                    <div class="am-service-data">
                        <div class="am-service-title"><h2>'.$employee['firstName'] .' '. $employee['lastName'] .'</h2></div>
                        <div class="am-service-info">
                            <div class="am-service-provider">
                                Remote reception only
                            </div>
                            <div>
                                <img src="http://localhost/wp/amelia/wp-content/plugins/ameliabooking/public/img/user.svg" alt="capacity" />
                            </div>
                            <div>
                                <img src="http://localhost/wp/amelia/wp-content/plugins/ameliabooking/public/img/duration.svg" alt="capacity" />
                            </div>
                        </div>
                    </div>
                    <div class="am-service-price">
                        '. $employee['startTimeFormatted'] .'
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    return $result;
}

add_shortcode( 'support-employee', 'employee_show' );