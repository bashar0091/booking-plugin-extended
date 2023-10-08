<?php

function booking_form($image, $fname, $lname, $service, $time, $email, $phone) {

    $output = '';

    $output .= '
    <div class="booking_popup el-dialog__wrapper am-modal am-in-body">
        <div role="dialog" aria-modal="true" aria-label="dialog" class="el-dialog el-dialog--center" style="margin-top: 15vh;">
            <div class="el-dialog__body">

                <span class="close_popup">
                    <svg fill="#000000" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z"></path> </g></svg>
                </span>

                <div id="am-confirm-booking" class="am-confirmation-booking">
                    <div>   
                        <div class="am-confirmation-booking-header">
                            <img src="'.$image.'" alt="" />
                            <h2 class="am-block-searchForm-confirmBookingForm-appointment" style="font-weight: 500; font-family: "Amelia Roboto";">
                                '.$fname .' '. $lname.'
                            </h2>
                        </div>
                        
                        <form action="post" class="el-form am-confirm-booking-form el-form--label-top">
                            <div class="am-confirm-booking-data el-row" style="margin-left: -12px; margin-right: -12px;">
                                <div class="el-col el-col-24 el-col-sm-24" style="padding-left: 12px; padding-right: 12px;">
                                    <div class="am-confirmation-booking-details">
                                        <div>
                                            <p>
                                                Service Type:
                                            </p>
                                            <p class="am-semi-strong">
                                                '.$service.'
                                            </p>
                                        </div>
                                        <div>
                                            <p>Date:</p>
                                            <p class="am-semi-strong">
                                                October 9, 2023
                                            </p>
                                        </div>
                                        <div>
                                            <p>Local Time:</p>
                                            <p class="am-semi-strong">
                                                '.$time.'
                                            </p>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                                <!---->
                                <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                    <div class="el-form-item is-required">
                                        <label for="customer.firstName" class="el-form-item__label">First Name:</label>
                                        <div class="el-form-item__content">
                                            <div class="el-input">
                                                <!---->
                                                <input type="text" autocomplete="given-name" name="given-name" class="el-input__inner" value="'.$fname.'" />
                                                <!----><!----><!----><!---->
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                    <div class="el-form-item is-required">
                                        <label for="customer.lastName" class="el-form-item__label">Last Name:</label>
                                        <div class="el-form-item__content">
                                            <div class="el-input">
                                                <!---->
                                                <input type="text" autocomplete="family-name" name="family-name" class="el-input__inner" value="'.$fname.'" />
                                                <!----><!----><!----><!---->
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                    <div class="el-form-item is-required">
                                        <label for="customer.email" class="el-form-item__label">Email:</label>
                                        <div class="el-form-item__content">
                                            <div class="el-input">
                                                <!---->
                                                <input type="email" autocomplete="email" placeholder="example@mail.com" name="email" class="el-input__inner" value="'.$email.'" />
                                                <!----><!----><!----><!---->
                                            </div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                                <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                    <div class="el-form-item" style="height: inherit;">
                                        <label for="customer.phone" class="el-form-item__label">Phone:</label>
                                        <div class="el-form-item__content">
                                            <div class="el-input el-input-group el-input-group--prepend el-input--suffix">
                                                <div class="el-input-group__prepend">
                                                    <div class="el-select am-selected-flag am-selected-flag-">
                                                        <!---->
                                                        <div class="el-input el-input--suffix">
                                                            <!---->
                                                            <input type="text" readonly="readonly" autocomplete="off" placeholder="" class="el-input__inner" />
                                                            <!---->
                                                            <span class="el-input__suffix">
                                                                <span class="el-input__suffix-inner">
                                                                    <i class="el-select__caret el-input__icon el-icon-arrow-up"></i>
                                                                    <!----><!----><!----><!----><!---->
                                                                </span>
                                                                <!---->
                                                            </span>
                                                            <!----><!---->
                                                        </div>
                                                        <div class="el-select-dropdown el-popper" style="display: none; min-width: 75px;">
                                                            <div class="el-scrollbar" style="">
                                                                <div class="el-select-dropdown__wrap el-scrollbar__wrap" style="margin-bottom: -19px; margin-right: -19px;">
                                                                    <ul class="el-scrollbar__view el-select-dropdown__list">
                                                                        <!---->
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-af"></span> <span class="am-phone-input-nicename">Afghanistan</span> <span class="am-phone-input-phonecode">+93</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-al"></span> <span class="am-phone-input-nicename">Albania</span> <span class="am-phone-input-phonecode">+355</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-dz"></span> <span class="am-phone-input-nicename">Algeria</span> <span class="am-phone-input-phonecode">+213</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-as"></span> <span class="am-phone-input-nicename">American Samoa</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ad"></span> <span class="am-phone-input-nicename">Andorra</span> <span class="am-phone-input-phonecode">+376</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ao"></span> <span class="am-phone-input-nicename">Angola</span> <span class="am-phone-input-phonecode">+244</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ai"></span> <span class="am-phone-input-nicename">Anguilla</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ag"></span> <span class="am-phone-input-nicename">Antigua and Barbuda</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ar"></span> <span class="am-phone-input-nicename">Argentina</span> <span class="am-phone-input-phonecode">+54</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-am"></span> <span class="am-phone-input-nicename">Armenia</span> <span class="am-phone-input-phonecode">+374</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-aw"></span> <span class="am-phone-input-nicename">Aruba</span> <span class="am-phone-input-phonecode">+297</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-au"></span> <span class="am-phone-input-nicename">Australia</span> <span class="am-phone-input-phonecode">+61</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-at"></span> <span class="am-phone-input-nicename">Austria</span> <span class="am-phone-input-phonecode">+43</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-az"></span> <span class="am-phone-input-nicename">Azerbaijan</span> <span class="am-phone-input-phonecode">+994</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bs"></span> <span class="am-phone-input-nicename">Bahamas</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bh"></span> <span class="am-phone-input-nicename">Bahrain</span> <span class="am-phone-input-phonecode">+973</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bd"></span> <span class="am-phone-input-nicename">Bangladesh</span> <span class="am-phone-input-phonecode">+880</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bb"></span> <span class="am-phone-input-nicename">Barbados</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-by"></span> <span class="am-phone-input-nicename">Belarus</span> <span class="am-phone-input-phonecode">+375</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-be"></span> <span class="am-phone-input-nicename">Belgium</span> <span class="am-phone-input-phonecode">+32</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bz"></span> <span class="am-phone-input-nicename">Belize</span> <span class="am-phone-input-phonecode">+501</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bj"></span> <span class="am-phone-input-nicename">Benin</span> <span class="am-phone-input-phonecode">+229</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bm"></span> <span class="am-phone-input-nicename">Bermuda</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bt"></span> <span class="am-phone-input-nicename">Bhutan</span> <span class="am-phone-input-phonecode">+975</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bo"></span> <span class="am-phone-input-nicename">Bolivia</span> <span class="am-phone-input-phonecode">+591</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ba"></span> <span class="am-phone-input-nicename">Bosnia and Herzegovina</span> <span class="am-phone-input-phonecode">+387</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bw"></span> <span class="am-phone-input-nicename">Botswana</span> <span class="am-phone-input-phonecode">+267</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-br"></span> <span class="am-phone-input-nicename">Brazil</span> <span class="am-phone-input-phonecode">+55</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-vg"></span> <span class="am-phone-input-nicename">British Virgin Islands</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bn"></span> <span class="am-phone-input-nicename">Brunei</span> <span class="am-phone-input-phonecode">+673</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bg"></span> <span class="am-phone-input-nicename">Bulgaria</span> <span class="am-phone-input-phonecode">+359</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bf"></span> <span class="am-phone-input-nicename">Burkina Faso</span> <span class="am-phone-input-phonecode">+226</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-bi"></span> <span class="am-phone-input-nicename">Burundi</span> <span class="am-phone-input-phonecode">+257</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-kh"></span> <span class="am-phone-input-nicename">Cambodia</span> <span class="am-phone-input-phonecode">+855</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cm"></span> <span class="am-phone-input-nicename">Cameroon</span> <span class="am-phone-input-phonecode">+237</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ca"></span> <span class="am-phone-input-nicename">Canada</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cv"></span> <span class="am-phone-input-nicename">Cape Verde</span> <span class="am-phone-input-phonecode">+238</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ky"></span> <span class="am-phone-input-nicename">Cayman Islands</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cf"></span> <span class="am-phone-input-nicename">Central African Republic</span> <span class="am-phone-input-phonecode">+236</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-td"></span> <span class="am-phone-input-nicename">Chad</span> <span class="am-phone-input-phonecode">+235</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cl"></span> <span class="am-phone-input-nicename">Chile</span> <span class="am-phone-input-phonecode">+56</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cn"></span> <span class="am-phone-input-nicename">China</span> <span class="am-phone-input-phonecode">+86</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-co"></span> <span class="am-phone-input-nicename">Colombia</span> <span class="am-phone-input-phonecode">+57</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-km"></span> <span class="am-phone-input-nicename">Comoros</span> <span class="am-phone-input-phonecode">+269</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cd"></span> <span class="am-phone-input-nicename">Congo (DRC)</span> <span class="am-phone-input-phonecode">+243</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cg"></span> <span class="am-phone-input-nicename">Congo (Republic)</span> <span class="am-phone-input-phonecode">+242</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ck"></span> <span class="am-phone-input-nicename">Cook Islands</span> <span class="am-phone-input-phonecode">+682</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cr"></span> <span class="am-phone-input-nicename">Costa Rica</span> <span class="am-phone-input-phonecode">+506</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ci"></span> <span class="am-phone-input-nicename">Cote D\'Ivoire</span> <span class="am-phone-input-phonecode">+225</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-hr"></span> <span class="am-phone-input-nicename">Croatia</span> <span class="am-phone-input-phonecode">+385</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cu"></span> <span class="am-phone-input-nicename">Cuba</span> <span class="am-phone-input-phonecode">+53</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cy"></span> <span class="am-phone-input-nicename">Cyprus</span> <span class="am-phone-input-phonecode">+357</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-cz"></span> <span class="am-phone-input-nicename">Czech Republic</span> <span class="am-phone-input-phonecode">+420</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-dk"></span> <span class="am-phone-input-nicename">Denmark</span> <span class="am-phone-input-phonecode">+45</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-dj"></span> <span class="am-phone-input-nicename">Djibouti</span> <span class="am-phone-input-phonecode">+253</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-dm"></span> <span class="am-phone-input-nicename">Dominica</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-do"></span> <span class="am-phone-input-nicename">Dominican Republic</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ec"></span> <span class="am-phone-input-nicename">Ecuador</span> <span class="am-phone-input-phonecode">+593</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-eg"></span> <span class="am-phone-input-nicename">Egypt</span> <span class="am-phone-input-phonecode">+20</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sv"></span> <span class="am-phone-input-nicename">El Salvador</span> <span class="am-phone-input-phonecode">+503</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gq"></span> <span class="am-phone-input-nicename">Equatorial Guinea</span> <span class="am-phone-input-phonecode">+240</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-er"></span> <span class="am-phone-input-nicename">Eritrea</span> <span class="am-phone-input-phonecode">+291</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ee"></span> <span class="am-phone-input-nicename">Estonia</span> <span class="am-phone-input-phonecode">+372</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-et"></span> <span class="am-phone-input-nicename">Ethiopia</span> <span class="am-phone-input-phonecode">+251</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-fk"></span> <span class="am-phone-input-nicename">Falkland Islands (Malvinas)</span> <span class="am-phone-input-phonecode">+500</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-fo"></span> <span class="am-phone-input-nicename">Faroe Islands</span> <span class="am-phone-input-phonecode">+298</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-fj"></span> <span class="am-phone-input-nicename">Fiji</span> <span class="am-phone-input-phonecode">+679</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-fi"></span> <span class="am-phone-input-nicename">Finland</span> <span class="am-phone-input-phonecode">+358</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-fr"></span> <span class="am-phone-input-nicename">France</span> <span class="am-phone-input-phonecode">+33</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gf"></span> <span class="am-phone-input-nicename">French Guiana</span> <span class="am-phone-input-phonecode">+594</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pf"></span> <span class="am-phone-input-nicename">French Polynesia</span> <span class="am-phone-input-phonecode">+689</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ga"></span> <span class="am-phone-input-nicename">Gabon</span> <span class="am-phone-input-phonecode">+241</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gm"></span> <span class="am-phone-input-nicename">Gambia</span> <span class="am-phone-input-phonecode">+220</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ge"></span> <span class="am-phone-input-nicename">Georgia</span> <span class="am-phone-input-phonecode">+995</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-de"></span> <span class="am-phone-input-nicename">Germany</span> <span class="am-phone-input-phonecode">+49</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gh"></span> <span class="am-phone-input-nicename">Ghana</span> <span class="am-phone-input-phonecode">+233</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gi"></span> <span class="am-phone-input-nicename">Gibraltar</span> <span class="am-phone-input-phonecode">+350</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gr"></span> <span class="am-phone-input-nicename">Greece</span> <span class="am-phone-input-phonecode">+30</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gl"></span> <span class="am-phone-input-nicename">Greenland</span> <span class="am-phone-input-phonecode">+299</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gp"></span> <span class="am-phone-input-nicename">Guadeloupe</span> <span class="am-phone-input-phonecode">+590</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gu"></span> <span class="am-phone-input-nicename">Guam</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gt"></span> <span class="am-phone-input-nicename">Guatemala</span> <span class="am-phone-input-phonecode">+502</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gg"></span> <span class="am-phone-input-nicename">Guernsey</span> <span class="am-phone-input-phonecode">+44</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gn"></span> <span class="am-phone-input-nicename">Guinea</span> <span class="am-phone-input-phonecode">+224</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gw"></span> <span class="am-phone-input-nicename">Guinea-Bissau</span> <span class="am-phone-input-phonecode">+245</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gy"></span> <span class="am-phone-input-nicename">Guyana</span> <span class="am-phone-input-phonecode">+592</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ht"></span> <span class="am-phone-input-nicename">Haiti</span> <span class="am-phone-input-phonecode">+509</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-hn"></span> <span class="am-phone-input-nicename">Honduras</span> <span class="am-phone-input-phonecode">+504</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-hk"></span> <span class="am-phone-input-nicename">Hong Kong</span> <span class="am-phone-input-phonecode">+852</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-hu"></span> <span class="am-phone-input-nicename">Hungary</span> <span class="am-phone-input-phonecode">+36</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-is"></span> <span class="am-phone-input-nicename">Iceland</span> <span class="am-phone-input-phonecode">+354</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-in"></span> <span class="am-phone-input-nicename">India</span> <span class="am-phone-input-phonecode">+91</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-id"></span> <span class="am-phone-input-nicename">Indonesia</span> <span class="am-phone-input-phonecode">+62</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ir"></span> <span class="am-phone-input-nicename">Iran</span> <span class="am-phone-input-phonecode">+98</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-iq"></span> <span class="am-phone-input-nicename">Iraq</span> <span class="am-phone-input-phonecode">+964</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ie"></span> <span class="am-phone-input-nicename">Ireland</span> <span class="am-phone-input-phonecode">+353</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-im"></span> <span class="am-phone-input-nicename">Isle of Man</span> <span class="am-phone-input-phonecode">+44</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-il"></span> <span class="am-phone-input-nicename">Israel</span> <span class="am-phone-input-phonecode">+972</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-it"></span> <span class="am-phone-input-nicename">Italy</span> <span class="am-phone-input-phonecode">+39</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-jm"></span> <span class="am-phone-input-nicename">Jamaica</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-jp"></span> <span class="am-phone-input-nicename">Japan</span> <span class="am-phone-input-phonecode">+81</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-je"></span> <span class="am-phone-input-nicename">Jersey</span> <span class="am-phone-input-phonecode">+44</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-jo"></span> <span class="am-phone-input-nicename">Jordan</span> <span class="am-phone-input-phonecode">+962</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-kz"></span> <span class="am-phone-input-nicename">Kazakhstan</span> <span class="am-phone-input-phonecode">+7</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ke"></span> <span class="am-phone-input-nicename">Kenya</span> <span class="am-phone-input-phonecode">+254</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ki"></span> <span class="am-phone-input-nicename">Kiribati</span> <span class="am-phone-input-phonecode">+686</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-xk"></span> <span class="am-phone-input-nicename">Kosovo</span> <span class="am-phone-input-phonecode">+383</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-kw"></span> <span class="am-phone-input-nicename">Kuwait</span> <span class="am-phone-input-phonecode">+965</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-kg"></span> <span class="am-phone-input-nicename">Kyrgyzstan</span> <span class="am-phone-input-phonecode">+996</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-la"></span> <span class="am-phone-input-nicename">Laos</span> <span class="am-phone-input-phonecode">+856</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lv"></span> <span class="am-phone-input-nicename">Latvia</span> <span class="am-phone-input-phonecode">+371</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lb"></span> <span class="am-phone-input-nicename">Lebanon</span> <span class="am-phone-input-phonecode">+961</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ls"></span> <span class="am-phone-input-nicename">Lesotho</span> <span class="am-phone-input-phonecode">+266</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lr"></span> <span class="am-phone-input-nicename">Liberia</span> <span class="am-phone-input-phonecode">+231</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ly"></span> <span class="am-phone-input-nicename">Libya</span> <span class="am-phone-input-phonecode">+218</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-li"></span> <span class="am-phone-input-nicename">Liechtenstein</span> <span class="am-phone-input-phonecode">+423</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lt"></span> <span class="am-phone-input-nicename">Lithuania</span> <span class="am-phone-input-phonecode">+370</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lu"></span> <span class="am-phone-input-nicename">Luxembourg</span> <span class="am-phone-input-phonecode">+352</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mo"></span> <span class="am-phone-input-nicename">Macao</span> <span class="am-phone-input-phonecode">+853</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mk"></span> <span class="am-phone-input-nicename">Macedonia (FYROM)</span> <span class="am-phone-input-phonecode">+389</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mg"></span> <span class="am-phone-input-nicename">Madagascar</span> <span class="am-phone-input-phonecode">+261</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mw"></span> <span class="am-phone-input-nicename">Malawi</span> <span class="am-phone-input-phonecode">+265</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-my"></span> <span class="am-phone-input-nicename">Malaysia</span> <span class="am-phone-input-phonecode">+60</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mv"></span> <span class="am-phone-input-nicename">Maldives</span> <span class="am-phone-input-phonecode">+960</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ml"></span> <span class="am-phone-input-nicename">Mali</span> <span class="am-phone-input-phonecode">+223</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mt"></span> <span class="am-phone-input-nicename">Malta</span> <span class="am-phone-input-phonecode">+356</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mh"></span> <span class="am-phone-input-nicename">Marshall Islands</span> <span class="am-phone-input-phonecode">+692</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mq"></span> <span class="am-phone-input-nicename">Martinique</span> <span class="am-phone-input-phonecode">+596</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mr"></span> <span class="am-phone-input-nicename">Mauritania</span> <span class="am-phone-input-phonecode">+222</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mu"></span> <span class="am-phone-input-nicename">Mauritius</span> <span class="am-phone-input-phonecode">+230</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-yt"></span> <span class="am-phone-input-nicename">Mayotte</span> <span class="am-phone-input-phonecode">+269</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mx"></span> <span class="am-phone-input-nicename">Mexico</span> <span class="am-phone-input-phonecode">+52</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-fm"></span> <span class="am-phone-input-nicename">Micronesia</span> <span class="am-phone-input-phonecode">+691</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-md"></span> <span class="am-phone-input-nicename">Moldova</span> <span class="am-phone-input-phonecode">+373</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mc"></span> <span class="am-phone-input-nicename">Monaco</span> <span class="am-phone-input-phonecode">+377</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mn"></span> <span class="am-phone-input-nicename">Mongolia</span> <span class="am-phone-input-phonecode">+976</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-me"></span> <span class="am-phone-input-nicename">Montenegro</span> <span class="am-phone-input-phonecode">+382</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ms"></span> <span class="am-phone-input-nicename">Montserrat</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ma"></span> <span class="am-phone-input-nicename">Morocco</span> <span class="am-phone-input-phonecode">+212</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mz"></span> <span class="am-phone-input-nicename">Mozambique</span> <span class="am-phone-input-phonecode">+258</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-mm"></span> <span class="am-phone-input-nicename">Myanmar</span> <span class="am-phone-input-phonecode">+95</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-na"></span> <span class="am-phone-input-nicename">Namibia</span> <span class="am-phone-input-phonecode">+264</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-np"></span> <span class="am-phone-input-nicename">Nepal</span> <span class="am-phone-input-phonecode">+977</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-nl"></span> <span class="am-phone-input-nicename">Netherlands</span> <span class="am-phone-input-phonecode">+31</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-nc"></span> <span class="am-phone-input-nicename">New Caledonia</span> <span class="am-phone-input-phonecode">+687</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-nz"></span> <span class="am-phone-input-nicename">New Zealand</span> <span class="am-phone-input-phonecode">+64</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ni"></span> <span class="am-phone-input-nicename">Nicaragua</span> <span class="am-phone-input-phonecode">+505</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ne"></span> <span class="am-phone-input-nicename">Niger</span> <span class="am-phone-input-phonecode">+227</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ng"></span> <span class="am-phone-input-nicename">Nigeria</span> <span class="am-phone-input-phonecode">+234</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-nu"></span> <span class="am-phone-input-nicename">Niue</span> <span class="am-phone-input-phonecode">+683</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-nf"></span> <span class="am-phone-input-nicename">Norfolk Island</span> <span class="am-phone-input-phonecode">+672</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-no"></span> <span class="am-phone-input-nicename">Norway</span> <span class="am-phone-input-phonecode">+47</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-om"></span> <span class="am-phone-input-nicename">Oman</span> <span class="am-phone-input-phonecode">+968</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pk"></span> <span class="am-phone-input-nicename">Pakistan</span> <span class="am-phone-input-phonecode">+92</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pw"></span> <span class="am-phone-input-nicename">Palau</span> <span class="am-phone-input-phonecode">+680</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ps"></span> <span class="am-phone-input-nicename">Palestine</span> <span class="am-phone-input-phonecode">+970</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pa"></span> <span class="am-phone-input-nicename">Panama</span> <span class="am-phone-input-phonecode">+507</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pg"></span> <span class="am-phone-input-nicename">Papua New Guinea</span> <span class="am-phone-input-phonecode">+675</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-py"></span> <span class="am-phone-input-nicename">Paraguay</span> <span class="am-phone-input-phonecode">+595</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pe"></span> <span class="am-phone-input-nicename">Peru</span> <span class="am-phone-input-phonecode">+51</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ph"></span> <span class="am-phone-input-nicename">Philippines</span> <span class="am-phone-input-phonecode">+63</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pl"></span> <span class="am-phone-input-nicename">Poland</span> <span class="am-phone-input-phonecode">+48</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pt"></span> <span class="am-phone-input-nicename">Portugal</span> <span class="am-phone-input-phonecode">+351</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-pr"></span> <span class="am-phone-input-nicename">Puerto Rico</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-qa"></span> <span class="am-phone-input-nicename">Qatar</span> <span class="am-phone-input-phonecode">+974</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-re"></span> <span class="am-phone-input-nicename">Réunion</span> <span class="am-phone-input-phonecode">+262</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ro"></span> <span class="am-phone-input-nicename">Romania</span> <span class="am-phone-input-phonecode">+40</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ru"></span> <span class="am-phone-input-nicename">Russia</span> <span class="am-phone-input-phonecode">+7</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-rw"></span> <span class="am-phone-input-nicename">Rwanda</span> <span class="am-phone-input-phonecode">+250</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-kn"></span> <span class="am-phone-input-nicename">Saint Kitts and Nevis</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lc"></span> <span class="am-phone-input-nicename">Saint Lucia</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-vc"></span> <span class="am-phone-input-nicename">Saint Vincent and the Grenadines</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ws"></span> <span class="am-phone-input-nicename">Samoa</span> <span class="am-phone-input-phonecode">+684</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sm"></span> <span class="am-phone-input-nicename">San Marino</span> <span class="am-phone-input-phonecode">+378</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-st"></span> <span class="am-phone-input-nicename">Sao Tome and Principe</span> <span class="am-phone-input-phonecode">+239</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sa"></span> <span class="am-phone-input-nicename">Saudi Arabia</span> <span class="am-phone-input-phonecode">+966</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sn"></span> <span class="am-phone-input-nicename">Senegal</span> <span class="am-phone-input-phonecode">+221</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-rs"></span> <span class="am-phone-input-nicename">Serbia</span> <span class="am-phone-input-phonecode">+381</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sc"></span> <span class="am-phone-input-nicename">Seychelles</span> <span class="am-phone-input-phonecode">+248</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sl"></span> <span class="am-phone-input-nicename">Sierra Leone</span> <span class="am-phone-input-phonecode">+232</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sg"></span> <span class="am-phone-input-nicename">Singapore</span> <span class="am-phone-input-phonecode">+65</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sk"></span> <span class="am-phone-input-nicename">Slovakia</span> <span class="am-phone-input-phonecode">+421</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-si"></span> <span class="am-phone-input-nicename">Slovenia</span> <span class="am-phone-input-phonecode">+386</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sb"></span> <span class="am-phone-input-nicename">Solomon Islands</span> <span class="am-phone-input-phonecode">+677</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-so"></span> <span class="am-phone-input-nicename">Somalia</span> <span class="am-phone-input-phonecode">+252</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-za"></span> <span class="am-phone-input-nicename">South Africa</span> <span class="am-phone-input-phonecode">+27</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-kr"></span> <span class="am-phone-input-nicename">South Korea</span> <span class="am-phone-input-phonecode">+82</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ss"></span> <span class="am-phone-input-nicename">South Sudan</span> <span class="am-phone-input-phonecode">+211</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-es"></span> <span class="am-phone-input-nicename">Spain</span> <span class="am-phone-input-phonecode">+34</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-lk"></span> <span class="am-phone-input-nicename">Sri Lanka</span> <span class="am-phone-input-phonecode">+94</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sd"></span> <span class="am-phone-input-nicename">Sudan</span> <span class="am-phone-input-phonecode">+249</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sr"></span> <span class="am-phone-input-nicename">Suriname</span> <span class="am-phone-input-phonecode">+597</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sz"></span> <span class="am-phone-input-nicename">Swaziland</span> <span class="am-phone-input-phonecode">+268</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-se"></span> <span class="am-phone-input-nicename">Sweden</span> <span class="am-phone-input-phonecode">+46</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ch"></span> <span class="am-phone-input-nicename">Switzerland</span> <span class="am-phone-input-phonecode">+41</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-sy"></span> <span class="am-phone-input-nicename">Syria</span> <span class="am-phone-input-phonecode">+963</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tw"></span> <span class="am-phone-input-nicename">Taiwan</span> <span class="am-phone-input-phonecode">+886</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tj"></span> <span class="am-phone-input-nicename">Tajikistan</span> <span class="am-phone-input-phonecode">+992</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tz"></span> <span class="am-phone-input-nicename">Tanzania</span> <span class="am-phone-input-phonecode">+255</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-th"></span> <span class="am-phone-input-nicename">Thailand</span> <span class="am-phone-input-phonecode">+66</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tl"></span> <span class="am-phone-input-nicename">Timor-Leste</span> <span class="am-phone-input-phonecode">+670</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tg"></span> <span class="am-phone-input-nicename">Togo</span> <span class="am-phone-input-phonecode">+228</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-to"></span> <span class="am-phone-input-nicename">Tonga</span> <span class="am-phone-input-phonecode">+676</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tt"></span> <span class="am-phone-input-nicename">Trinidad and Tobago</span> <span class="am-phone-input-phonecode">+868</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tn"></span> <span class="am-phone-input-nicename">Tunisia</span> <span class="am-phone-input-phonecode">+216</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tr"></span> <span class="am-phone-input-nicename">Turkey</span> <span class="am-phone-input-phonecode">+90</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tm"></span> <span class="am-phone-input-nicename">Turkmenistan</span> <span class="am-phone-input-phonecode">+7370</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tc"></span> <span class="am-phone-input-nicename">Turks and Caicos Islands</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-tv"></span> <span class="am-phone-input-nicename">Tuvalu</span> <span class="am-phone-input-phonecode">+688</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ug"></span> <span class="am-phone-input-nicename">Uganda</span> <span class="am-phone-input-phonecode">+256</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ua"></span> <span class="am-phone-input-nicename">Ukraine</span> <span class="am-phone-input-phonecode">+380</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ae"></span> <span class="am-phone-input-nicename">United Arab Emirates</span> <span class="am-phone-input-phonecode">+971</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-gb"></span> <span class="am-phone-input-nicename">United Kingdom</span> <span class="am-phone-input-phonecode">+44</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-us"></span> <span class="am-phone-input-nicename">United States</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-uy"></span> <span class="am-phone-input-nicename">Uruguay</span> <span class="am-phone-input-phonecode">+598</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-uz"></span> <span class="am-phone-input-nicename">Uzbekistan</span> <span class="am-phone-input-phonecode">+998</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-vu"></span> <span class="am-phone-input-nicename">Vanuatu</span> <span class="am-phone-input-phonecode">+678</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ve"></span> <span class="am-phone-input-nicename">Venezuela</span> <span class="am-phone-input-phonecode">+58</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-vn"></span> <span class="am-phone-input-nicename">Vietnam</span> <span class="am-phone-input-phonecode">+84</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-vi"></span> <span class="am-phone-input-nicename">Virgin Islands, U.S.</span> <span class="am-phone-input-phonecode">+1</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ye"></span> <span class="am-phone-input-nicename">Yemen</span> <span class="am-phone-input-phonecode">+967</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-zm"></span> <span class="am-phone-input-nicename">Zambia</span> <span class="am-phone-input-phonecode">+260</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-zw"></span> <span class="am-phone-input-nicename">Zimbabwe</span> <span class="am-phone-input-phonecode">+263</span>
                                                                        </li>
                                                                        <li class="el-select-dropdown__item">
                                                                            <span class="am-flag am-flag-ax"></span> <span class="am-phone-input-nicename">Åland Islands</span> <span class="am-phone-input-phonecode">+358</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="el-scrollbar__bar is-horizontal"><div class="el-scrollbar__thumb" style="transform: translateX(0%);"></div></div>
                                                                <div class="el-scrollbar__bar is-vertical"><div class="el-scrollbar__thumb" style="transform: translateY(0%);"></div></div>
                                                            </div>
                                                            <!---->
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="tel" autocomplete="tel" placeholder="" name="tel" class="el-input__inner" value="'.$phone.'" />
                                                <!----><!----><!----><!---->
                                            </div>
                                            <!----><!---->
                                        </div>
                                    </div>
                                </div>
                                <div class="am-custom-fields"><div class="el-row" style="margin-left: -12px; margin-right: -12px;"></div></div>
                            </div>
                            <div class="am-confirm-booking-payment el-row" style="margin-left: -12px; margin-right: -12px;">
                                <div class="el-col el-col-24" style="padding-left: 12px; padding-right: 12px;"><!----></div>
                                <div class="el-col el-col-24 el-col-sm-12" style="padding-left: 12px; padding-right: 12px;">
                                    <div class="el-form-item" style="display: none;">
                                        <label class="el-form-item__label">
                                            <span style="font-weight: 700;">
                                                Credit or debit card:
                                            </span>
                                        </label>
                                        <div class="el-form-item__content">
                                            <div id="card-element-0" class="am-stripe"></div>
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-confirm-booking-data el-row" style="margin-left: -12px; margin-right: -12px;">
                                <div class="el-col el-col-24 el-col-sm-24 el-col-lg-24" style="padding-left: 12px; padding-right: 12px;"><!----></div>
                            </div>
                            <div class="el-row">
                                <div class="el-col el-col-24 el-col-sm-24">
                                    <div class="am-confirmation-booking-cost" style="padding-top: 16px;">
                                        <!---->
                                        <div class="el-row" style="margin-left: -12px; margin-right: -12px;">
                                            <div class="el-col el-col-6" style="padding-left: 12px; padding-right: 12px;">
                                                <p style="visibility: visible;">
                                                    Base Price:
                                                </p>
                                            </div>
                                            <div class="el-col el-col-18" style="padding-left: 12px; padding-right: 12px;">
                                                <p class="am-semi-strong am-align-right">
                                                    $20.00
                                                </p>
                                            </div>
                                        </div>
                                        <!---->
                                        <!---->
                                        <div class="el-row" style="margin-left: -12px; margin-right: -12px;">
                                            <div class="el-col el-col-8" style="padding-left: 12px; padding-right: 12px;"><p>Discount</p></div>
                                            <div class="el-col el-col-16" style="padding-left: 12px; padding-right: 12px;">
                                                <p class="am-semi-strong am-align-right">
                                                    $0.00
                                                </p>
                                            </div>
                                        </div>
                                        <div class="am-add-coupon am-flex-row-middle-align el-row">
                                            <div class="el-col el-col-24 el-col-xs-10 el-col-sm-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="svg-amelia inlined-svg" role="img" aria-labelledby="title">
                                                    <title>add-coupon</title>
                                                    <!-- Generator: Sketch 48.2 (47327) - http://www.bohemiancoding.com/sketch -->
                                                    <desc>Created with Sketch.</desc>
                                                    <defs></defs>
                                                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g id="Group" fill="#303C42">
                                                            <path
                                                                d="M7.152,12.7704615 C6.29353846,11.5809231 6.26092308,10.8652308 6.23446154,10.2904615 C6.22953846,10.1852308 6.22584615,10.0978462 6.21661538,10.0055385 C6.17415385,9.54953846 5.84676923,8.64738462 5.22769231,7.74461538 C4.37538462,6.49907692 3.79384615,4.63569231 4.95876923,3.48307692 C5.232,3.21230769 5.58523077,3.06953846 5.97907692,3.06953846 C6.952,3.06953846 7.98892308,4.02892308 8.61538462,4.85846154 L8.61538462,3.55261538 L8.61538462,1.23261538 C8.61538462,0.552615385 8.06276923,0 7.38461538,0 L5.53661538,0 C5.36861538,0 5.232,0.134769231 5.22892308,0.302769231 C5.22092308,0.804923077 4.80738462,1.21353846 4.30769231,1.21353846 C3.80738462,1.21353846 3.39446154,0.804923077 3.38646154,0.302769231 C3.38338462,0.134769231 3.24676923,0 3.07876923,0 L1.23076923,0 C0.552,0 0,0.552615385 0,1.23261538 L0,12.3058462 C0,12.9858462 0.552,13.5384615 1.23076923,13.5384615 L3.07692308,13.5384615 C3.24676923,13.5384615 3.38461538,13.4006154 3.38461538,13.2307692 C3.38461538,12.7206154 3.79876923,12.3058462 4.30769231,12.3058462 C4.81661538,12.3058462 5.23076923,12.7206154 5.23076923,13.2307692 C5.23076923,13.4006154 5.36861538,13.5384615 5.53846154,13.5384615 L7.38461538,13.5384615 C7.52430769,13.5384615 7.65907692,13.5101538 7.78707692,13.4646154 C7.56738462,13.2683077 7.352,13.048 7.152,12.7704615"
                                                                id="Fill-1450"
                                                            ></path>
                                                            <path
                                                                d="M15.9536615,11.8383385 C15.9487385,11.8303385 15.4373538,10.9934154 15.0724308,9.83095385 C14.9881231,9.55956923 14.8816615,9.17741538 14.7604308,8.73987692 C14.1825846,6.66295385 13.6588923,4.89741538 13.0865846,4.32141538 C12.9450462,4.17987692 12.5161231,3.74787692 9.58812308,3.26295385 C9.50135385,3.2488 9.40843077,3.27341538 9.33950769,3.33187692 C9.27058462,3.39033846 9.23058462,3.47587692 9.23058462,3.56633846 L9.23058462,6.03956923 C9.23058462,6.16449231 9.30627692,6.27710769 9.42258462,6.32449231 L10.3192,6.68941538 C10.3782769,6.90172308 10.4908923,7.28572308 10.6016615,7.56572308 C10.5487385,7.65310769 10.5050462,7.75341538 10.4570462,7.86233846 C10.3764308,8.04695385 10.2878154,8.25064615 10.1518154,8.40018462 C9.55489231,8.01741538 8.95181538,6.91895385 8.56781538,5.96264615 C8.26504615,5.20756923 6.93273846,3.69926154 5.97889231,3.69926154 C5.74996923,3.69926154 5.54750769,3.78110769 5.3912,3.93495385 C4.49643077,4.81926154 5.01766154,6.35649231 5.73581538,7.40449231 C6.3272,8.26849231 6.7672,9.29187692 6.82996923,9.95218462 C6.83981538,10.0611077 6.84473846,10.1644923 6.84966154,10.2666462 C6.87489231,10.8100308 6.90073846,11.3724923 7.65089231,12.4112615 C8.04289231,12.9534154 8.50135385,13.2721846 8.98627692,13.6100308 C9.67858462,14.0912615 10.3942769,14.5897231 11.1179692,15.8457231 C11.1727385,15.9411077 11.2742769,16.0001846 11.3844308,16.0001846 C15.0004308,16.0001846 15.9819692,12.1115692 15.9912,12.0721846 C16.0108923,11.9921846 15.9967385,11.9084923 15.9536615,11.8383385"
                                                                id="Fill-1452"
                                                            ></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <span>Add Coupon</span>
                                            </div>
                                            <div class="el-col el-col-24 el-col-xs-14 el-col-sm-14">
                                                <form class="el-form el-form--label-top">
                                                    <div class="el-form-item el-form-item--feedback">
                                                        <!---->
                                                        <div class="el-form-item__content">
                                                            <div class="am-add-coupon-field el-input el-input--small el-input-group el-input-group--append">
                                                                <!---->
                                                                <input type="text" autocomplete="off" native-type="submit" class="el-input__inner" />
                                                                <!----><!---->
                                                                <div class="el-input-group__append">
                                                                    <button disabled="disabled" type="submit" class="el-button am-add-coupon-button el-button--default el-button--mini is-disabled">
                                                                        <!---->
                                                                        <i class="el-icon-check"></i>
                                                                        <!---->
                                                                    </button>
                                                                </div>
                                                                <!---->
                                                            </div>
                                                            <!---->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="am-coupon-limit el-row" style="display: none;">
                                            <div class="el-col el-col-24 el-col-xs-4 el-col-sm-2">
                                                <div style="display: inline-block;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 38" class="svg-amelia inlined-svg" role="img" aria-labelledby="title">
                                                        <title>coupon-limit</title>
                                                        <!-- Generator: sketchtool 64 (101010) - https://sketch.com -->
                                                        <title>22F1F827-9153-4FA7-987C-F8AF462FA353-svg</title>
                                                        <desc>Created with sketchtool.</desc>
                                                        <defs></defs>
                                                        <circle id="Oval" fill="#303C42" cx="19" cy="19" r="19"></circle>
                                                        <g id="coupon" transform="translate(11.000000, 14.000000)" fill="#FFFFFF">
                                                            <path
                                                                d="M4.78079037,0.0222775052 L0.503446445,0.0222775052 C0.225418146,0.0222775052 0,0.247664185 0,0.52572395 L0,3.07769398 C0,3.35575374 0.225418146,3.58114042 0.503446445,3.58114042 C1.17029273,3.58114042 1.7128192,4.1236669 1.7128192,4.79054465 C1.7128192,5.45742239 1.17029273,5.99988594 0.503446445,5.99988594 C0.225418146,5.99988594 0,6.22527262 0,6.50333238 L0,9.05533388 C0,9.33339364 0.225418146,9.55878032 0.503446445,9.55878032 L4.78079037,9.55878032 L4.78079037,0.0222775052 Z"
                                                                id="Path"
                                                            ></path>
                                                            <path
                                                                d="M15.4965536,3.58114042 C15.7745819,3.58114042 16,3.35575374 16,3.07769398 L16,0.52572395 C16,0.247664185 15.7745819,0.0222775052 15.4965536,0.0222775052 L5.78768326,0.0222775052 L5.78768326,9.55881179 L15.4965536,9.55881179 C15.7745819,9.55881179 16,9.33342511 16,9.05536534 L16,6.50336385 C16,6.22530408 15.7745819,5.9999174 15.4965536,5.9999174 C14.8297073,5.9999174 14.2871808,5.45742239 14.2871808,4.79054465 C14.2871808,4.1236669 14.8297073,3.58114042 15.4965536,3.58114042 Z"
                                                                id="Path"
                                                            ></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="el-col el-col-24 el-col-xs-20 el-col-sm-22">
                                                <div class="am-coupon-limit-text">
                                                    <strong>Coupon Limit Reached</strong>
                                                    <p>Number of appointments with applied coupon is 0</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="am-confirmation-total">
                                            <!---->
                                            <!---->
                                            <div class="el-row" style="margin-left: -12px; margin-right: -12px;">
                                                <div class="el-col el-col-12" style="padding-left: 12px; padding-right: 12px;">
                                                    <p>
                                                        Total Cost:
                                                    </p>
                                                </div>
                                                <div class="el-col el-col-12" style="padding-left: 12px; padding-right: 12px;">
                                                    <p class="am-semi-strong am-align-right">
                                                        $20.00
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                            </div>

                            <div slot="footer" class="dialog-footer payment-dialog-footer">
                                <!---->
                                <div class="paypal-button el-button el-button--primary" style="display: none;">
                                    <div id="am-paypal-button-container"></div>
                                    <span>Confirm</span>
                                </div>
                                <div class="el-button el-button--primary" style=""><span>Confirm</span></div>
                            </div>
                        </form>
                    </div>
                    <div id="am-spinner" class="am-booking-fetched" style="display: none;">
                        <h4 style="color: rgb(53, 64, 82);">
                            Please Wait
                        </h4>
                        <div class="am-svg-wrapper">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 38" stroke="#7F8FA4" class="svg-amelia am-spin inlined-svg" role="img">
                                    <g fill="none" fill-rule="evenodd">
                                        <g transform="translate(1 1)" stroke-width="2">
                                            <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                                            <path d="M36 18c0-9.94-8.06-18-18-18">
                                                <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 16" class="svg-amelia am-hourglass inlined-svg" role="img">
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
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
        </div>
    </div>

    <script>

    </script>

    ';

    return $output;
}