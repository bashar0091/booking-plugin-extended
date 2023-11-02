<?php
/**
 * Shortcode for employee_show
 */

require_once('booking-form.php');

function employee_show() {

  $output = '';

  // for css and html layout get 
  $output .= do_shortcode('[ameliasearch today=1]');

  $current_user = wp_get_current_user();

  $user_first_name = $current_user->first_name;
  $user_last_name = $current_user->last_name;
  $user_email = !empty($current_user->user_email) ? $current_user->user_email : 'guest@gmail.com';

  global $wpdb;

  $table_name_providers_to_weekdays = $wpdb->prefix . 'amelia_providers_to_weekdays';
  $table_name_providers_to_periods = $wpdb->prefix . 'amelia_providers_to_periods';

  $currentDate = date('l');
  $day_index = 0;
  if ($currentDate == 'Monday') {
    $day_index = 1;
  } elseif ($currentDate == 'Tuesday') {
    $day_index = 2;
  } elseif ($currentDate == 'Wednesday') {
    $day_index = 3;
  } elseif ($currentDate == 'Thursday') {
    $day_index = 4;
  } elseif ($currentDate == 'Friday') {
    $day_index = 5;
  } else {
    $day_index = 0;
  }

  $query = $wpdb->prepare(
    "SELECT papp.id AS period_id, pwpd.userId, u.id AS user_id, papp.weekDayId, papp.locationId, papp.startTime, papp.endTime, u.status, u.type, u.firstName, u.lastName, u.pictureFullPath
    FROM $table_name_providers_to_periods AS papp
    INNER JOIN $table_name_providers_to_weekdays AS pwpd
    ON papp.weekDayId = pwpd.id
    LEFT JOIN wp_amelia_users AS u
    ON pwpd.userId = u.id
    WHERE pwpd.dayIndex = %d
    ORDER BY papp.startTime ASC", // Order by start time in ascending order
    $day_index
  );

  $results = $wpdb->get_results($query);
    
  $output .='
  <div class="pilar_booking_list amelia-search amelia-frontend amelia-app-booking">
      <div id="amelia-booking-wrap" class="am-wrap">
          <div id="am-search-booking">
              <div class="am-search-filters am-scroll">
                  <div class="am-close-icon"><i class="el-icon-close"></i></div>
                  <h2>Search Filters</h2>
                  <div id="am-search-filters" class="am-search-filter">
                      <button type="button" class="el-button am-search-mobile-button el-button--primary">
                          <!----><!---->
                          <span>Search</span>
                      </button>
                      <h3>Appointment Date:</h3>
                      <div
                          data-v-bc55024c=""
                          class="am-calendar-picker c-pane-container is-expanded"
                          id="am-calendar-picker"
                          dragattribute="[object Object]"
                          is-expanded="true"
                          formats="[object Object]"
                          mindate="Thu Nov 02 2023 16:10:34 GMT+0600 (Bangladesh Standard Time)"
                          maxdate="Thu Oct 31 2024 00:00:00 GMT+0600 (Bangladesh Standard Time)"
                          themestyles="[object Object]"
                          style="background-color: rgb(250, 250, 250); border: 1px solid rgb(218, 218, 218);"
                          frompage="[object Object]"
                      >
                          <div data-v-2083cb72="" data-v-bc55024c="" class="c-pane" id="am-calendar-picker" dragattribute="[object Object]" attributes="[object Object]" style="min-width: 256px;">
                              <div data-v-2083cb72="" class="c-header">
                                  <div data-v-2083cb72="" class="c-arrow-layout">
                                      <svg data-v-12e91ab4="" data-v-2083cb72="" width="26px" height="26px" viewBox="3 2 12 32" class="svg-icon c-arrow c-disabled">
                                          <path
                                              data-v-12e91ab4=""
                                              d="M11.196 10c0 0.143-0.071 0.304-0.179 0.411l-7.018 7.018 7.018 7.018c0.107 0.107 0.179 0.268 0.179 0.411s-0.071 0.304-0.179 0.411l-0.893 0.893c-0.107 0.107-0.268 0.179-0.411 0.179s-0.304-0.071-0.411-0.179l-8.321-8.321c-0.107-0.107-0.179-0.268-0.179-0.411s0.071-0.304 0.179-0.411l8.321-8.321c0.107-0.107 0.268-0.179 0.411-0.179s0.304 0.071 0.411 0.179l0.893 0.893c0.107 0.107 0.179 0.25 0.179 0.411z"
                                          ></path>
                                      </svg>
                                  </div>
                                  <div data-v-2083cb72="" class="c-title-layout align-center">
                                      <div data-v-1ad2436f="" data-v-2083cb72="" tabindex="-1" class="c-title-popover popover-container">
                                          <!---->
                                          <div data-v-2083cb72="" class="c-title-anchor" data-v-1ad2436f="">
                                              <div data-v-2083cb72="" class="c-title">
                                                  November 2023
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div data-v-2083cb72="" class="c-arrow-layout">
                                      <svg data-v-12e91ab4="" data-v-2083cb72="" width="26px" height="26px" viewBox="-2 1 11 32" class="svg-icon c-arrow">
                                          <path
                                              data-v-12e91ab4=""
                                              d="M10.625 17.429c0 0.143-0.071 0.304-0.179 0.411l-8.321 8.321c-0.107 0.107-0.268 0.179-0.411 0.179s-0.304-0.071-0.411-0.179l-0.893-0.893c-0.107-0.107-0.179-0.25-0.179-0.411 0-0.143 0.071-0.304 0.179-0.411l7.018-7.018-7.018-7.018c-0.107-0.107-0.179-0.268-0.179-0.411s0.071-0.304 0.179-0.411l0.893-0.893c0.107-0.107 0.268-0.179 0.411-0.179s0.304 0.071 0.411 0.179l8.321 8.321c0.107 0.107 0.179 0.268 0.179 0.411z"
                                          ></path>
                                      </svg>
                                  </div>
                              </div>
                              <!---->
                              <div data-v-2083cb72="" class="c-weekdays">
                                  <div data-v-2083cb72="" class="c-weekday">
                                      M
                                  </div>
                                  <div data-v-2083cb72="" class="c-weekday">
                                      T
                                  </div>
                                  <div data-v-2083cb72="" class="c-weekday">
                                      W
                                  </div>
                                  <div data-v-2083cb72="" class="c-weekday">
                                      T
                                  </div>
                                  <div data-v-2083cb72="" class="c-weekday">
                                      F
                                  </div>
                                  <div data-v-2083cb72="" class="c-weekday">
                                      S
                                  </div>
                                  <div data-v-2083cb72="" class="c-weekday">
                                      S
                                  </div>
                              </div>
                              <!---->
                              <div data-v-2083cb72="" class="c-weeks">
                                  <div data-v-2083cb72="" class="c-weeks-rows-wrapper">
                                      <div data-v-28896542="" data-v-2083cb72="" styles="[object Object]" formats="[object Object]" id="am-calendar-picker" dragattribute="[object Object]" attributes="[object Object]" class="c-weeks-rows">
                                          <div data-v-28896542="" class="c-week">
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="color: rgb(204, 204, 204); opacity: 0.5; text-decoration: line-through;">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  30
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="color: rgb(204, 204, 204); opacity: 0.5; text-decoration: line-through;">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  31
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="color: rgb(204, 204, 204); opacity: 0.5; text-decoration: line-through;">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  1
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f="">
                                                          <div data-v-3db80f80="" class="c-day-layer c-day-box-center-center c-day-scale-enter c-day-scale-leave">
                                                              <div
                                                                  data-v-3db80f80=""
                                                                  class="c-day-background"
                                                                  style="width: 1.8rem; height: 1.8rem; background-color: rgb(26, 132, 238); border-width: 0px; border-style: solid; border-radius: 50%; opacity: 1;"
                                                              ></div>
                                                          </div>
                                                      </div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="color: rgb(250, 250, 250);">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  2
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  3
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  4
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  5
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                          </div>
                                          <div data-v-28896542="" class="c-week">
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  6
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  7
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  8
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  9
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  10
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  11
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  12
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                          </div>
                                          <div data-v-28896542="" class="c-week">
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  13
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  14
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  15
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  16
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  17
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  18
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  19
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                          </div>
                                          <div data-v-28896542="" class="c-week">
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  20
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  21
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  22
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  23
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  24
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  25
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  26
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                          </div>
                                          <div data-v-28896542="" class="c-week">
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  27
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  28
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  29
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  30
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  1
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  2
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  3
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                          </div>
                                          <div data-v-28896542="" class="c-week">
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  4
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  5
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  6
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  7
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  8
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  9
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                              <div data-v-1ad2436f="" data-v-3db80f80="" data-v-28896542="" class="c-day-popover popover-container" id="am-calendar-picker" dragattribute="[object Object]">
                                                  <!---->
                                                  <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day" style="opacity: 0.4;">
                                                      <div data-v-3db80f80="" class="c-day-backgrounds c-day-layer" data-v-1ad2436f=""></div>
                                                      <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content-wrapper">
                                                          <div data-v-3db80f80="" data-v-1ad2436f="" class="c-day-content" style="">
                                                              <div data-v-3db80f80="" data-v-1ad2436f="">
                                                                  10
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <!---->
                                                      <!---->
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="am-search-results">
                  <div class="am-search-input">
                      <span class="am-filter-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="svg-search inlined-svg" role="img">
                              <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                              <title>Filter</title>
                              <defs></defs>
                              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <g id="Filter">
                                      <rect id="Rectangle" fill-opacity="0" fill="#D8D8D8" x="0" y="0" width="16" height="16"></rect>
                                      <path
                                          d="M6.22222222,13.6666667 L9.77777778,13.6666667 L9.77777778,11.8888889 L6.22222222,11.8888889 L6.22222222,13.6666667 L6.22222222,13.6666667 Z M0,3 L0,4.77777778 L16,4.77777778 L16,3 L0,3 L0,3 Z M2.66666667,9.22222222 L13.3333333,9.22222222 L13.3333333,7.44444444 L2.66666667,7.44444444 L2.66666667,9.22222222 L2.66666667,9.22222222 Z"
                                          id="Shape"
                                          fill="#7F8FA4"
                                          fill-rule="nonzero"
                                      ></path>
                                  </g>
                              </g>
                          </svg>
                      </span>
                      <div class="el-input el-input--medium el-input--prefix">
                          <!---->
                          <input type="text" autocomplete="off" placeholder="Search..." class="el-input__inner" />
                          <span class="el-input__prefix">
                              <i class="el-input__icon el-icon-search"></i>
                              <!---->
                          </span>
                          <!----><!----><!---->
                      </div>
                  </div>
                  <div class="am-service-list">
                      <div id="service-list" class="am-service-list-container">';

                        if ($results) {
                          foreach ($results as $row) {
                            // Access data for each row in the joined result set
                            $userId = $row->userId;
                            $period_id = $row->period_id;
                            $weekDayId = $row->weekDayId;
                            $locationId = $row->locationId;

                            $startTime = $row->startTime; 
                            $formattedStartTime = date('H:i', strtotime($startTime));

                            $endTime = $row->endTime;

                            $user_firstName = $row->firstName;
                            $user_lastName = $row->lastName;
                            $pictureFullPath = $row->pictureFullPath;
                      
                            $output .= '
                              <div class="pilar_card_box">
                                <div class="pilar_card_time">
                                    <span class="pilar_title1">Today</span>
                                    <span class="pilar_title2">'.$formattedStartTime.'</span>
                                    <span class="pilar_title3">
                                        <img src="'.home_url().'/wp-content/plugins/ameliabooking/public/img/duration.svg" alt="capacity">
                                        30 min
                                    </span>
                                </div>
                            
                                <div class="pilar_card_img_box">
                                    <div class="pilar_card_image">
                                        <img src="'.$pictureFullPath.'" alt="doctor_img">
                                    </div>
                                    <div>
                                        <span>'.$user_firstName.' '.$user_lastName.'</span>
                                    </div>
                                </div>
                            
                                <div>
                                    <span>Mehiläinen Helsinki Töölö</span>
                                </div>
                            
                                <div>
                                    <button class="pilar_card_btn">Book</button>

                                    <div class="pilar_modal v-modal" tabindex="0"></div>
                                    <div class="pilar_modal el-dialog__wrapper am-modal am-in-body" id="am-modal">
                                          <div role="dialog" aria-modal="true" aria-label="dialog" class="el-dialog el-dialog--center" style="margin-top: 15vh;">
                                              <div class="el-dialog__body">

                                                  <button class="pilar_modal_close el-button el-button--danger">Close</button>

                                                  <div id="am-confirm-booking" class="am-confirmation-booking">
                                                      <div>
                                                          <div class="am-confirmation-booking-header">
                                                              <img src="'.$pictureFullPath.'" alt="doctor_img" />
                                                              <h2 class="am-block-searchForm-confirmBookingForm-appointment" style="font-weight: 500;">
                                                                '.$user_firstName.' '.$user_lastName.'
                                                              </h2>
                                                          </div>
                                                          <!---->
                                                          <form class="el-form am-confirm-booking-form el-form--label-top">
                                                              <div class="am-confirm-booking-data el-row" style="margin-left: -12px; margin-right: -12px;">
                                                                  <div class="el-col el-col-24 el-col-sm-24" style="padding-left: 12px; padding-right: 12px;">
                                                                      <div class="am-confirmation-booking-details">
                                                                          <div>
                                                                              <p>
                                                                                  PALVELU:
                                                                              </p>
                                                                              <p class="am-semi-strong">
                                                                                  Jukka Lehtonen
                                                                              </p>
                                                                          </div>
                                                                          <div>
                                                                              <p>Date:</p>
                                                                              <p class="am-semi-strong">
                                                                                  3.11.2023
                                                                              </p>
                                                                          </div>
                                                                          <div>
                                                                              <p>Local Time:</p>
                                                                              <p class="am-semi-strong">
                                                                                  '.$formattedStartTime.'
                                                                              </p>
                                                                          </div>
                                                                          <!---->
                                                                      </div>
                                                                  </div>
                                                                  <!---->
                                                                  <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                                                      <div class="el-form-item is-required am-input-">
                                                                          <label for="customer.firstName" class="el-form-item__label">First Name:</label>
                                                                          <div class="el-form-item__content">
                                                                              <div class="el-input">
                                                                                  <!---->
                                                                                  <input type="text" name="given-name" class="el-input__inner" value="'.$user_first_name.'" />
                                                                                  <!----><!----><!----><!---->
                                                                              </div>
                                                                              <!---->
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                                                      <div class="el-form-item is-required am-input-">
                                                                          <label for="customer.lastName" class="el-form-item__label">Last Name:</label>
                                                                          <div class="el-form-item__content">
                                                                              <div class="el-input">
                                                                                  <!---->
                                                                                  <input type="text" name="family-name" class="el-input__inner" value="'.$user_last_name.'" />
                                                                                  <!----><!----><!----><!---->
                                                                              </div>
                                                                              <!---->
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                                                      <div class="el-form-item is-required am-input-">
                                                                          <label for="customer.email" class="el-form-item__label">Email:</label>
                                                                          <div class="el-form-item__content">
                                                                              <div class="el-input">
                                                                                  <!---->
                                                                                  <input type="email" placeholder="example@mail.com" name="email" class="el-input__inner" value="'.$user_email.'" />
                                                                                  <!----><!----><!----><!---->
                                                                              </div>
                                                                              <!---->
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                                                      <div class="el-form-item is-required am-input-" style="height: inherit;">
                                                                          <label for="customer.phone" class="el-form-item__label">Phone:</label>
                                                                          <div class="el-form-item__content">
                                                                              <div class="el-input el-input-group el-input-group--prepend el-input--suffix">
                                                                                  <div class="el-input-group__prepend">
                                                                                      <div class="el-select am-selected-flag am-selected-flag-fi">
                                                                                          <div class="el-input el-input--suffix">
                                                                                              <input type="text" readonly="readonly" autocomplete="off" placeholder="" class="el-input__inner" />
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <input type="tel" autocomplete="tel" placeholder="041 2345678" name="tel" class="el-input__inner" />
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                          
                                                              <div class="el-row">
                                                                  <div class="el-col el-col-24 el-col-sm-24">
                                                                      <div class="am-confirmation-booking-cost" style="padding-top: 16px;">
                                                                          <div class="el-row" style="margin-left: -12px; margin-right: -12px;">
                                                                              <div class="el-col el-col-6" style="padding-left: 12px; padding-right: 12px;">
                                                                                  <p style="visibility: visible;">
                                                                                      Base Price:
                                                                                  </p>
                                                                              </div>
                                                                              <div class="el-col el-col-18" style="padding-left: 12px; padding-right: 12px;">
                                                                                  <p class="am-semi-strong am-align-right">
                                                                                      50.00 €
                                                                                  </p>
                                                                              </div>
                                                                          </div>
                                                                          <div class="am-confirmation-total">
                                                                              <div class="el-row" style="margin-left: -12px; margin-right: -12px;">
                                                                                  <div class="el-col el-col-12" style="padding-left: 12px; padding-right: 12px;">
                                                                                      <p>
                                                                                          Total Cost:
                                                                                      </p>
                                                                                  </div>
                                                                                  <div class="el-col el-col-12" style="padding-left: 12px; padding-right: 12px;">
                                                                                      <p class="am-semi-strong am-align-right">
                                                                                          50.00 €
                                                                                      </p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </form>
                                                          <div slot="footer" class="dialog-footer payment-dialog-footer">
                                                              <div class="el-button el-button--primary" style=""><span>Confirm</span></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                    </div>

                                </div>

                              </div>
                            ';

                            // Do something with the data from the joined result set
                            echo "User ID: $userId, Period ID: $period_id, WeekDay ID: $weekDayId, Location ID: $locationId, Start Time: $startTime, End Time: $endTime<br>";
                          
                          }
                        } else {
                          
                          $output .= '
                          <div class="am-empty-state am-section">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 183" class="svg-search inlined-svg" role="img">
                                  <!-- Generator: Sketch 48.2 (47327) - http://www.bohemiancoding.com/sketch -->
                                  <desc>Created with Sketch.</desc>
                                  <defs>
                                      <path
                                          d="M14.5857988,1.0910877 L156.944571,21.2970828 C164.444532,22.444795 170.524453,27.686021 170.524453,32.9955281 L170.524453,68.4624665 C170.524453,73.7719736 164.444532,79.0055174 156.944571,80.1437945 L15.591716,95.1486608 C8.09175443,96.1065431 9.1848039e-16,89.811518 0,79.8555862 L0,16.3687816 C8.68387437e-16,6.41284978 7.08583727,0.124692368 14.5857988,1.0910877 Z"
                                          id="path-1"
                                      ></path>
                                      <filter x="-36.4%" y="-45.6%" width="172.7%" height="231.6%" filterUnits="objectBoundingBox" id="filter-2">
                                          <feOffset dx="0" dy="19" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                          <feGaussianBlur stdDeviation="17.5" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                                          <feColorMatrix values="0 0 0 0 0.226735433   0 0 0 0 0.437054197   0 0 0 0 0.687818878  0 0 0 0.189056839 0" type="matrix" in="shadowBlurOuter1"></feColorMatrix>
                                      </filter>
                                  </defs>
                                  <g id="#15-Search--Empty" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(-614.000000, -282.000000)">
                                      <g id="emptystate_services" transform="translate(648.000000, 295.000000)">
                                          <g id="Group-13">
                                              <g id="2" transform="translate(0.743691, 106.297056)">
                                                  <rect id="Rectangle-18" fill="#FFFFFF" x="0" y="0" width="170.524453" height="63.1715969" rx="13.5"></rect>
                                                  <rect id="Rectangle" fill="#1B3554" opacity="0.300000012" x="59.3491124" y="13.0769231" width="95.5118312" height="6.62217443" rx="3.31108721"></rect>
                                                  <rect id="Rectangle-Copy" fill="#1B3554" opacity="0.300000012" x="59.3491124" y="25.147929" width="70.3437873" height="6.62217443" rx="3.31108721"></rect>
                                                  <rect id="Rectangle-Copy-2" fill="#1B3554" opacity="0.149999991" x="59.3491124" y="43.2544379" width="27.3134404" height="6.62217443" rx="3.31108721"></rect>
                                                  <ellipse id="Oval-8" fill="#BAC2CB" cx="30.5909804" cy="23.4990776" rx="15.502223" ry="15.4517403"></ellipse>
                                                  <path
                                                      d="M28.1047581,29.23252 C28.3997507,29.5275126 28.7852781,29.6746317 29.1715599,29.6746317 C29.5578418,29.6746317 29.9433691,29.5275126 30.2383617,29.23252 L37.782929,21.6879527 C38.3721597,21.098722 38.3721597,20.1435798 37.782929,19.5543491 C37.1936983,18.9651184 36.2385561,18.9651184 35.6493254,19.5543491 L29.1715599,26.0313601 L25.7116213,22.572176 C25.1223906,21.9829453 24.1672484,21.9829453 23.5780177,22.572176 C22.988787,23.1614067 22.988787,24.1165489 23.5780177,24.7057796 L28.1047581,29.23252 Z"
                                                      id="Shape"
                                                      fill="#FFFFFF"
                                                      fill-rule="nonzero"
                                                  ></path>
                                              </g>
                                              <g id="1" transform="translate(0.743691, 0.673963)">
                                                  <g id="Rectangle-18">
                                                      <use fill="black" fill-opacity="1" filter="url(#filter-2)" xlink:href="#path-1"></use>
                                                      <use fill="#FFFFFF" fill-rule="evenodd" xlink:href="#path-1"></use>
                                                  </g>
                                                  <path
                                                      d="M62.6601996,30.0455456 L151.549856,36.2262136 C153.378519,36.3597511 154.860944,37.6094571 154.860944,39.0172769 C154.860944,40.4250968 153.378519,41.49638 151.549856,41.4102053 L62.6601996,37.4213171 C60.8315367,37.3433708 59.3491124,35.6118419 59.3491124,33.5536888 C59.3491124,31.4955358 60.8315367,29.9247822 62.6601996,30.0455456 Z"
                                                      id="Rectangle"
                                                      fill="#1B3554"
                                                      opacity="0.300000012"
                                                  ></path>
                                                  <path
                                                      d="M62.6601996,43.4902203 L126.381813,45.0351964 C128.210475,45.0811552 129.6929,46.4040926 129.6929,47.9899778 C129.6929,49.5758631 128.210475,50.8615938 126.381813,50.8617367 L62.6601996,50.8659918 C60.8315367,50.8660932 59.3491124,49.1977118 59.3491124,47.1395588 C59.3491124,45.0814058 60.8315367,43.4475046 62.6601996,43.4902203 Z"
                                                      id="Rectangle-Copy"
                                                      fill="#1B3554"
                                                      opacity="0.300000012"
                                                  ></path>
                                                  <path
                                                      d="M62.6601996,63.6572325 L83.3514657,62.8047474 C85.1801286,62.7284204 86.6625529,64.1898406 86.6625529,66.0690657 C86.6625529,67.9482908 85.1801286,69.5693885 83.3514657,69.6896609 L62.6601996,71.033004 C60.8315367,71.1501768 59.3491124,69.5765167 59.3491124,67.5183637 C59.3491124,65.4602107 60.8315367,63.7315882 62.6601996,63.6572325 Z"
                                                      id="Rectangle-Copy-2"
                                                      fill="#1B3554"
                                                      opacity="0.149999991"
                                                  ></path>
                                                  <path
                                                      d="M32.7614646,59.6757082 C42.5218314,59.470101 50.4341719,51.1766997 50.4341719,41.154152 C50.4341719,31.1316042 42.5218314,22.450245 32.7614646,21.7711936 C23.0010979,21.1003158 15.0887574,29.4001675 15.0887574,40.3020311 C15.0887574,51.2038947 23.0010979,59.8788036 32.7614646,59.6757082 Z"
                                                      id="Oval-8"
                                                      fill="#A28FF3"
                                                  ></path>
                                                  <path
                                                      d="M29.9271435,47.7348553 C30.2634383,48.1013006 30.7029439,48.2854944 31.1433095,48.2881771 C31.5836751,48.2908612 32.0231806,48.1127767 32.3594755,47.7528053 L40.9603664,38.7441952 C41.632096,38.0567477 41.632096,36.9100589 40.9603664,36.1784909 C40.2886369,35.4446114 39.1997641,35.4036172 38.5280345,36.0911321 L31.1433095,43.802371 L27.1989409,39.4379419 C26.5272113,38.6866782 25.4383385,38.6558746 24.7666089,39.3732753 C24.0948793,40.0929757 24.0948793,41.2885022 24.7666089,42.0397164 L29.9271435,47.7348553 Z"
                                                      id="Shape"
                                                      fill="#FFFFFF"
                                                      fill-rule="nonzero"
                                                  ></path>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </svg>
                              <div>
                                  <h2>No results found...</h2>
                                  <p>Please refine your search criteria</p>
                              </div>
                          </div>
                          ';
                          
                        }
                        
                  $output .='
                      </div>
                  </div>

                  <div class="am-spinner am-section" style="display: none;">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 38" stroke="#7F8FA4" class="svg-search am-spin inlined-svg" role="img">
                          <g fill="none" fill-rule="evenodd">
                              <g transform="translate(1 1)" stroke-width="2">
                                  <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                                  <path d="M36 18c0-9.94-8.06-18-18-18">
                                      <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                                  </path>
                              </g>
                          </g>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 16" class="svg-search am-hourglass inlined-svg" role="img">
                          <!-- Generator: Sketch 48.2 (47327) - http://www.bohemiancoding.com/sketch -->
                          <desc>Created with Sketch.</desc>
                          <defs></defs>
                          <g id="Icons" stroke="none" stroke-width="0" fill="none" fill-rule="evenodd" transform="translate(-2.000000, 0.000000)">
                              <g id="sat" transform="translate(2.000000, 0.000000)" fill="#303C42">
                                  <path
                                      d="M8.37968,4.8 L3.32848,4.8 C3.22074667,4.8 3.12368,4.86506667 3.08208,4.9648 C3.04101333,5.06453333 3.06394667,5.1792 3.14021333,5.25546667 L5.67834667,7.79093333 C5.72794667,7.84106667 5.79621333,7.86933333 5.86661333,7.86933333 C5.95941333,7.8672 6.00634667,7.84106667 6.05594667,7.7904 L8.56901333,5.2544 C8.64474667,5.1776 8.66714667,5.06346667 8.62554667,4.96426667 C8.58448,4.86453333 8.48741333,4.8 8.37968,4.8"
                                      id="Fill-694"
                                  ></path>
                                  <path
                                      d="M6.82293333,7.62293333 C6.6144,7.83146667 6.6144,8.16853333 6.82293333,8.37706667 L9.04,10.5941333 C9.74506667,11.2992 10.1333333,12.2368 10.1333333,13.2341333 L10.1333333,14.4 L9.2,14.4 L6.08,10.24 C5.9792,10.1056 5.75413333,10.1056 5.65333333,10.24 L2.53333333,14.4 L1.6,14.4 L1.6,13.2341333 C1.6,12.2368 1.98826667,11.2992 2.69333333,10.5941333 L4.9104,8.37706667 C5.11893333,8.16853333 5.11893333,7.83146667 4.9104,7.62293333 L2.69333333,5.40586667 C1.98826667,4.7008 1.6,3.7632 1.6,2.7664 L1.6,1.6 L10.1333333,1.6 L10.1333333,2.7664 C10.1333333,3.7632 9.74506667,4.7008 9.04,5.40586667 L6.82293333,7.62293333 Z M11.2,2.7664 L11.2,1.45173333 C11.5173333,1.26666667 11.7333333,0.9264 11.7333333,0.533333333 L11.7333333,0.266666667 C11.7333333,0.119466667 11.6138667,0 11.4666667,0 L0.266666667,0 C0.119466667,0 0,0.119466667 0,0.266666667 L0,0.533333333 C0,0.9264 0.216,1.26666667 0.533333333,1.45173333 L0.533333333,2.7664 C0.533333333,4.048 1.03253333,5.25386667 1.9392,6.16 L3.7792,8 L1.9392,9.84 C1.03253333,10.7461333 0.533333333,11.952 0.533333333,13.2341333 L0.533333333,14.5482667 C0.216,14.7333333 0,15.0736 0,15.4666667 L0,15.7333333 C0,15.8805333 0.119466667,16 0.266666667,16 L11.4666667,16 C11.6138667,16 11.7333333,15.8805333 11.7333333,15.7333333 L11.7333333,15.4666667 C11.7333333,15.0736 11.5173333,14.7333333 11.2,14.5482667 L11.2,13.2341333 C11.2,11.952 10.7008,10.7461333 9.79413333,9.84 L7.95413333,8 L9.79413333,6.16 C10.7008,5.25386667 11.2,4.048 11.2,2.7664 L11.2,2.7664 Z"
                                      id="Fill-696"
                                  ></path>
                              </g>
                          </g>
                      </svg>
                  </div>
              </div>
              <!---->
          </div>
      </div>
  </div>';


  return $output;
}

add_shortcode( 'support-employee', 'employee_show' );