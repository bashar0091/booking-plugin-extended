<?php
/**
 * Shortcode for employee_show
 */
function employee_show() {
    
    // Set the time zone to Dhaka
    $timezone = get_option('timezone_string');
    date_default_timezone_set($timezone);

    $resulted = '';

    global $wpdb;

    // Your table name for providers to weekdays
    $providers_to_weekdays_table = $wpdb->prefix . 'amelia_providers_to_weekdays';

    // Your table name for users
    $users_table = $wpdb->prefix . 'amelia_users';

    // Get the current day index (assuming you want to find employees for the current day)
    $current_day_index = 7 - 1;

    // Get the current PHP time
    $current_time = date("H:i:s"); // Format: 03:00:00

    // SQL query to retrieve startTime and userId where dayIndex matches the current day
    $query = $wpdb->prepare(
        "SELECT startTime, userId FROM $providers_to_weekdays_table WHERE dayIndex = %d ORDER BY startTime ASC",
        $current_day_index
    );

    // Execute the query
    $results = $wpdb->get_results($query);

    // Check if there are results
    if ($results) {
        foreach ($results as $result) {
            // Access the startTime and userId column data for each row
            $startTime = $result->startTime;

            // Check if $startTime is less than the current PHP time
            if ($startTime < $current_time) {
                continue; // Skip to the next iteration
            }

            // Convert startTime to a DateTime object
            $startTimeDateTime = new DateTime($startTime);

            // Format the time to display only the hour and minute
            $startTimeFormatted = $startTimeDateTime->format('H:i');

            $userId = $result->userId;
            
            // Query to retrieve the first name of the user with the given userId
            $query = $wpdb->prepare(
                "SELECT firstName, lastName, pictureFullPath FROM $users_table WHERE id = %d",
                $userId
            );

            $userData = $wpdb->get_row($query);

            // Execute the query to get the first name
            $firstName = $userData->firstName;
            $lastName = $userData->lastName;
            $image = $userData->pictureFullPath;

            $firstCharacterFirstName = substr($firstName, 0, 1);
            $firstCharacterLastName = substr($lastName, 0, 1);

            $image_url = ( !empty($image) ? $image : "https://via.placeholder.com/120/000/fff?text=$firstCharacterFirstName$firstCharacterLastName" );
            
            $resulted .= '
            <div class="pilar_off">
                <div class="am-service pilar-employee">
                    <div class="am-service-header">
                        <div class="am-service-image"><img src="'. $image_url .'" /></div>
                        <div class="am-service-data">
                            <div class="am-service-title"><h2>'. $firstName .' '. $lastName .'</div>
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
                            '. $startTimeFormatted .'
                        </div>
                    </div>
                </div>
            </div>
            ';

        }
    } else {
        echo "No data found for the current day.";
    }

    return $resulted;
}

add_shortcode( 'support-employee', 'employee_show' );