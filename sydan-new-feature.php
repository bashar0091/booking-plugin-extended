<?php
/**
 * Plugin Name: Sydan24 New Feature
 * Plugin URI: #
 * Description: New Feature
 * Version: 1.1.0
 * Requires at least: 5.7
 * Requires PHP: 7.2
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


//Avoiding Direct File Access
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


define('SNF_FILE', __FILE__);
define('SNF_PATH', plugin_dir_path(__FILE__));
define('SNF_URL', plugin_dir_url(__FILE__));


class SNF {

	private static $instance;

	public static function get_instance(){
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct(){
		add_action( 'admin_menu', [ $this, 'sydan_admin_menu' ] );

		add_action( 'wp_ajax_add_new_availability', [ $this, 'add_new_availability' ] );
		add_action( 'wp_ajax_get_submission_info', [ $this, 'get_submission_info' ] );
		add_action( 'wp_ajax_get_availability_time', [ $this, 'get_availability_time' ] );
		add_action( 'wp_ajax_remove_availability', [ $this, 'remove_availability' ] );
		add_action( 'wp_ajax_get_availability_time_date_service', [ $this, 'get_availability_time_date_service' ] );
		add_action( 'wp_ajax_update_availability_pilar', [ $this, 'update_availability_pilar' ] );
	}

	public function sydan_admin_menu() {
		add_menu_page( 
			'Pikavastaanotto', 
			'Pikavastaanotto', 
			'wpamelia-provider', 
			'pikavastaanotto', 
			[ $this, 'amelia_dashboard_callback' ], 
			'https://palvelu.sydan24.fi/wp-content/uploads/2023/11/request.png', 
			15
		);

		add_menu_page( 
			'Kaikki lahetykset', 
			'Kaikki lahetykset', 
			'wpamelia-provider', 
			'kaikki', 
			[ $this, 'amelia_dashboard_callback' ], 
			'https://palvelu.sydan24.fi/wp-content/uploads/2023/11/request.png', 
			15
		);



		// add_menu_page( 
		// 	'Työajat', 
		// 	'Työajat', 
		// 	'wpamelia-provider', 
		// 	'amelia_availability', 
		// 	[ $this, 'amelia_availability_callback' ], 
		// 	'https://palvelu.sydan24.fi/wp-content/uploads/2024/01/availability-1.png'
		// );
		// add_submenu_page( 'amelia_availability', 'Add Availability', 'Add Availability', 'wpamelia-provider', 'add_new_availability', 'amelia_add_new_availability' );

		add_menu_page( 
			'Oma tilasto', 
			'Oma tilasto', 
			'wpamelia-provider', 
			'doctors_earning', 
			[ $this, 'doctor_earning_callback' ], 
			'https://palvelu.sydan24.fi/wp-content/uploads/2024/02/salary.svg', 
			32 
		);		
	}

	public function doctor_earning_callback(){
		global $wpdb;
		
		$today_earning = 0;
		$weekly_earning = 0;
		$yearly_earning = 0;
		$monthly_earning = 0;
		$weekly_appointment_count = 0;

		//table name 
			$externalId = get_current_user_id();

			$table_name_amelia_users = $wpdb->prefix . 'amelia_users';
			$table_name_amelia_appointments = $wpdb->prefix . 'amelia_appointments';
			$table_name_prescription_data = $wpdb->prefix . 'sydan_prescription_data12';

			$query = $wpdb->prepare("
				SELECT 
					u.id AS user_id, 
					u.hourly_rate, 
					a.id AS appointment_id, 
					MAX(pd.date) AS date
				FROM $table_name_amelia_users AS u
				LEFT JOIN $table_name_amelia_appointments AS a ON u.id = a.providerId
				LEFT JOIN $table_name_prescription_data AS pd ON a.id = pd.appointment_id
				WHERE u.externalId = %d
				AND pd.appointment_id IS NOT NULL
				GROUP BY appointment_id
				ORDER BY date ASC
			", $externalId);

			$results = $wpdb->get_results($query);

			// current date 
			$today_date = date("d-m-Y");
			$current_week = date("W-Y");
			$current_month = date("m-Y");
			$current_year = date("Y");
			
			$weekly_count = 0;
			foreach ($results as $result) {

				// today calculation
				$today_full = date("d-m-Y", strtotime($result->date));
				if( $today_full == $today_date ) {
					$today_earning += $result->hourly_rate;
				}

				// weekly calculation
				$week_start = date("W-Y", strtotime("last Saturday", strtotime($today_date)));
				$week_end = date("W-Y", strtotime("next Friday", strtotime($today_date)));
				$week = date("W-Y", strtotime($result->date));
				if ($week >= $week_start && $week <= $week_end) {
					$weekly_count++;
					$weekly_earning += $result->hourly_rate;
					$weekly_appointment_count = $weekly_count;
				}

				// monthly calculation
				$month = date("m-Y", strtotime($result->date));
				if( $month == $current_month ) {
					$monthly_earning += $result->hourly_rate;
				}

				// yearly calculation
				$year = date("Y", strtotime($result->date));
				if( $year == $current_year ) {
					$yearly_earning += $result->hourly_rate;
				}

			}
			
	?>

	<style> 
		.doctor_earning_main_wrapper{padding:20px;width:100%;margin:0 auto}.pilar_title1{color:#403e57;font:bold 22px/30px Inter}.earning_top_wrapper{display:flex;align-items:center;justify-content:space-between}.pilar_btn{background:no-repeat padding-box #009e82;border:1px solid #009e82;border-radius:8px;font:bold 15px/21px Inter;color:#fff!important;padding:10px 15px}.earning_box1_item,.earning_box2_item{background:no-repeat padding-box #fff}.pilar_icon{display:flex;gap:5px;align-items:center}.earning_box1_item{border:1px solid #e4eae9;border-radius:16px;flex:1}.earning_box1_item h4{font:bold 17px/29px Inter;letter-spacing:0;color:#585670;background:no-repeat padding-box #f7f9fa;border-radius:16px 16px 0 0;margin:0;padding:20px}.earning_box1_item h4+span{font:bold 35px/57px Inter;letter-spacing:0;color:#029e82;display:block;padding:30px}.earning_box1_wrapper{display:flex;justify-content:space-between;gap:20px;margin-top:30px;margin-bottom:60px}.earning_box2_wrapper{display:flex;justify-content:space-between;gap:20px}.earning_box2_item{flex:1;border:1px solid #e4eae9;border-radius:16px;border-left:8px solid #029e82;padding:30px}.earning_box2_item h4{font:bold 40px/77px Inter;letter-spacing:0;color:#585670;margin:0 0 15px}.earning_box2_item span{font:bold 18px/29px Inter;letter-spacing:0;color:#919dab}@media (min-width:767px) and (max-width:1300px){.earning_box1_wrapper{display:grid;grid-template-columns:1fr 1fr 1fr}.earning_box2_wrapper{display:grid;grid-template-columns:1fr 1fr}}@media (max-width:767px){.earning_box1_wrapper,.earning_box2_wrapper{flex-direction:column}.earning_box1_item h4+span,.earning_box2_item h4{font:bold 25px/25px Inter}.earning_box1_item h4,.earning_box2_item span{font:bold 15px/15px Inter}.pilar_title1{font:bold 20px/30px Inter}}
	</style>

	<div class="doctor_earning_main_wrapper">

		<div class="earning_top_wrapper">
			<h3 class="pilar_title1">Viikkotilastot</h3>
			<a href="#!" class="pilar_btn pilar_icon" onclick="pdf_generate()">
				<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z" fill="#ffffff"></path> <path d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z" fill="#ffffff"></path> </g></svg>
				Lataa tietojen historia
			</a>
		</div>
		
		<div id="pdf_generate">
			<div class="earning_box1_wrapper">

				<div class="earning_box1_item">
					<h4>Tilastot tänään</h4>
					<span><?= $today_earning; ?> €</span>
				</div>

				<div class="earning_box1_item">
					<h4>Kokonaistulot (viikko)</h4>
					<span><?= $weekly_earning;?> €</span>
				</div>

				<div class="earning_box1_item">
					<h4>Ajanvaraukset (viikko)</h4>
					<span><?= $weekly_appointment_count; ?></span>
				</div>

				<div class="earning_box1_item">
					<h4>Tutimäärä (viikko)</h4>

					<?php
						$appointment_count = $weekly_appointment_count / 2;
						$formatted_count = is_int($appointment_count) ? number_format($appointment_count) : number_format($appointment_count, 2);
					?>

					<span><?= $formatted_count ?> h</span>
				</div>

			</div>

			<div class="earning_top_wrapper">
				<h3 class="pilar_title1">Keskimääräiset tulot</h3>
			</div>

			<div class="earning_box2_wrapper">

				<div class="earning_box2_item">
					<h4><?= $weekly_earning;?> €</h4>
					<span>Viikkotulot</span>
				</div>

				<div class="earning_box2_item">
					<h4><?= $monthly_earning; ?> €</h4>
					<span>Kuukausitulot</span>
				</div>

				<div class="earning_box2_item">
					<h4><?= $yearly_earning;?> €</h4>
					<span>Vuositulot</span>
				</div>

			</div>
		</div>

	</div>

	<div>
		
	</div>

	<?php 
	}

	public function amelia_availability_callback(){
		global $wpdb;
		$amilia_users = $wpdb->get_results("SELECT id, firstName, lastName, externalId FROM wp_amelia_users WHERE type = 'provider'", ARRAY_A);
		$amilia_services = $wpdb->get_results("SELECT id, name FROM wp_amelia_services", ARRAY_A);

		$year = [ 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030 ];
		$months = [
			'01' => 'tammikuu',
			'02' => 'helmikuu',
			'03' => 'maaliskuuta',
			'04' => 'huhtikuu',
			'05' => 'saattaa',
			'06' => 'kesäkuuta',
			'07' => 'heinäkuu',
			'08' => 'elokuu',
			'09' => 'syyskuu',
			'10' => 'lokakuu',
			'11' => 'marraskuu',
			'12' => 'joulukuu'
		];
		$time = [
			'09:00:00' => '09:00',
			'09:30:00' => '09:30',
			'10:00:00' => '10:00',
			'10:30:00' => '10:30',
			'11:00:00' => '11:00',
			'11:30:00' => '11:30',
			'12:00:00' => '12:00',
			'12:30:00' => '12:30',
			'13:00:00' => '13:00',
			'13:30:00' => '13:30',
			'14:00:00' => '14:00',
			'14:30:00' => '14:30',
			'15:00:00' => '15:00',
			'15:30:00' => '15:30',
			'16:00:00' => '16:00',
			'16:30:00' => '16:30',
			'17:00:00' => '17:00',
		];

		?>
	<style type="text/css"> #availability table {font-family: arial, sans-serif; border-collapse: collapse; width: 100%; overflow: hidden; } #availability table td, #availability table th {border: 1px solid #dddddd; text-align: left; height: 36px; } #availability tbody td.active {background: rgb(29 171 47 / 51%); border-color: rgb(29 171 47 / 51%); } #availability thead th {padding: 4px; font-size: 12px; text-align: center; position: -webkit-sticky; position: sticky; top: 0; background: #fff; } #availability thead th.day_wrap span {width: 65px; display: block; } #availability tbody span.current-day {text-align: center; display: block; } .select-available-month, .select-available-year {margin-top: 15px; } .select-available-month label, .select-available-year label, .available-doctor-wrap label {display: block; margin-bottom: 6px; } .select-available-month select, .select-available-year select, .available-doctor-wrap select {width: 250px; text-align: center; min-height: 40px; } .available-chart {margin-top: 20px; } .available-btn {margin-top: 20px; } #availability tr:nth-child(odd) {background: #f7f7f7; } .available-chart-wrap {overflow: scroll; height: 70vh; } #availability tbody th, .day_wrap {background: #fff; } .availability-message {display: none; margin-top: 15px; } #availability tbody tr:hover {background: rgb(29 171 47 / 8%); } #availability tbody td:hover:after {content: ""; position: absolute; top: -700px; bottom: -700px; background: rgb(29 171 47 / 8%); right: 0; left: 0; z-index: -1 } #availability tbody td {position: relative; } #availability .spinner {float: none; } button.add_new_availability {margin-bottom: 30px; background: #009e83; border: none; color: #fff; font-weight: 700; padding: 2px 22px 4px; border-radius: 4px; cursor: pointer; } div#update_availability-content,div#add_new_availability-content {position: fixed; top: 0; left: 0; bottom: 0; right: 0; background: #ffffffbd; display: none; } div#update_availability-content.active,div#add_new_availability-content.active {display: flex; align-items: center; justify-content: center; } div#update_availability-content .ana-wrap,div#add_new_availability-content .ana-wrap {width: 400px; height: 500px; background: #fff; padding: 50px; box-shadow: 2px 1px 15px 3px #009e8273; position: relative; } form#update_availability_pilar > span,form#add_new_availability > span {display: block; margin: 21px 0; } form#update_availability_pilar label, form#add_new_availability label {display: block; margin-bottom: 7px; font-size: 17px; } form#update_availability_pilar input[type="date"],form#add_new_availability input[type="date"], .availability-services select {width: 300px; text-align: center; padding: 5px 0; border: 1px solid #ddd; position: relative; } form#update_availability_pilar .seperate-time,form#add_new_availability .seperate-time {display: flex; flex-wrap: wrap; justify-content: space-between; } form#update_availability_pilar .min-time select ,form#add_new_availability .min-time select {width: 48%; padding: 4px 10px; border: 1px solid #ddd; margin-top: 0; margin-bottom: 0; } form#update_availability_pilar input.button-primary,form#add_new_availability input.button-primary {width: 300px; padding: 6px 0; } .success {display: none; } form#update_availability_pilar input[type="date"],form#add_new_availability input[type="date"]::-webkit-calendar-picker-indicator {background: transparent; bottom: 0; color: transparent; cursor: pointer; height: auto; left: 0; position: absolute; right: 0; top: 0; width: auto; } form#update_availability_pilar > span.availability-submit,form#add_new_availability > span.availability-submit {display: flex; align-items: center; } form#update_availability_pilar span.spinner,form#add_new_availability span.spinner {float: none; } .add_full_time {margin-top: 15px; margin-bottom: 15px; } div#update_availability-content span.close,div#add_new_availability-content span.close {position: absolute; top: 0; right: 0; width: 30px; height: 30px; background: #009e82; color: #fff; font-size: 25px; display: flex; align-items: center; justify-content: center; cursor: pointer; } #availability tbody td.active.onhere {
    background: rgb(129 129 129 / 51%);
    border-color: rgb(129 129 129 / 51%);
    cursor: pointer;
}
#availability tbody td.active.onhere.remove-availability:before {
    content: "\f464";
    font-family: dashicons;
    font-size: 25px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgb(255 255 255);
}

#availability tbody td.active.onhere.remove-availability {
    position: relative;
}

#update_availability-content .ana-wrap .spinner {
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin: 0;
	z-index: 1;
}
#update_availability-content .ana-wrap.processing:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    opacity: 0.5;
}
.availability_date_show {
	display: block;
	background-color: var(--adminify-input-bg);
    border: none;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    color: #14142b;
    font-size: 14px;
    line-height: 20px;
    padding: 8px 16px;
}
#availability tbody td.active.new {
    background: #ff000073;
    border-color: #ff000073;
}
</style>


		<div class="wrap">
			<button class="add_new_availability">Lisää uusi saatavuus</button>
			<h1>Työajat</h1>
			<div id="availability">
				<form>
					<div class="available-doctor-wrap">
						<label>Valitse käyttäjä</label>
						
						<?php if ( !empty($amilia_users) ): ?>
							<select name="doctor-available" class="available-doctor">
								<option value="">Valitse</option>
								<?php foreach ($amilia_users as $user) {
									if ( !empty($user['id']) ) {
										echo sprintf(
											'<option value="%s" %s>%s %s</option>',
											$user['id'],
											selected( $user['externalId'], get_current_user_id() ),
											!empty($user['firstName']) ? $user['firstName'] : '',
											!empty($user['lastName']) ? $user['lastName'] : ''
										);
									}
								} ?>
							</select>			
						<?php endif ?>
					</div>
					<div class="select-available-year">
						<label>Valitse vuosi</label>
						<select required>
							<option value="">Valitse</option>
							<?php foreach ($year as $item): ?>
								<option value="<?= $item; ?>" <?= selected( date("Y"), $item ); ?>><?= $item; ?></option>
							<?php endforeach ?>
						</select>
					</div>

					<div class="select-available-month">
						<label>Valitse kuukausi</label>
						<select required>
							<option value="">Valitse</option>
							<?php foreach ($months as $key => $item): ?>
								<option value="<?= $key; ?>"><?= $item; ?></option>
							<?php endforeach ?>
						</select>
						<span class="spinner"></span>
					</div>

					<div class="available-chart">
						<div class="available-chart-wrap">
							<table>
								<thead>
									<tr></tr>
								</thead>
								<tbody></tbody>
								<tfoot></tfoot>
							</table>
						</div>
					</div>
					<div class="availability-message">No Availability Found!</div>
				</form>
			</div>


	<!-- Add New Availability -->
			<div id="add_new_availability-content">
				<div class="ana-wrap">
					<span class="dashicons close dashicons-no-alt"></span>
					<h1>Lisää saatavuus</h1>
					<form id="add_new_availability" method="post">
						<input type="hidden" name="action" value="add_new_availability">

						<span class="availability-date">
							<label>Valitse päivämäärä</label>
							<input type="date" name="availability-date" required >
						</span>

						<span class="min-time">
							<label>Työtunnit</label>

							<div class="seperate-time">
								<select name="min-time">
									<option value="">Valitse</option>
									<?php if ( !empty($time) ): ?>
										<?php foreach ($time as $time_sec => $val): ?>
											<option value="<?= $time_sec; ?>"><?= $val; ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>

								<select name="max-time">
									<option value="">Valitse</option>
									<?php if ( !empty($time) ): ?>
										<?php foreach ($time as $time_sec => $val): ?>
											<option value="<?= $time_sec; ?>"><?= $val; ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>					
							</div>

							<div class="add_full_time">
								<label>
									<input type="checkbox" name="fullday">
									Koko päivä
								</label>
							</div>

						</span>

						<?php if ( $amilia_services ): ?>
							<span class="availability-services">
								<label>Palvelut</label>
								<select name="availability-services">
									<option value="">Valitse</option>
									<?php foreach ($amilia_services as $item): ?>
										<option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
									<?php endforeach ?>
								</select>
							</span>				
						<?php endif ?>

						<span class="availability-submit">
							<input type="submit" value="Lisätä" class="button button-primary">
							<span class="spinner"></span>
						</span>

						<p class="success">Lisätty onnistuneesti</p>
					</form>				
				</div>
			</div>

			<!-- a.b# update Availability popup box -->
			<div id="update_availability-content">
				<div class="ana-wrap">

					<span class="spinner"></span>

					<span class="dashicons close dashicons-no-alt"></span>
					<h1>Päivitä Saatavuus</h1>
					<form id="update_availability_pilar" method="post">

						<input type="hidden" id="update_period_id" name="period_id" value="">
						<input type="hidden" name="availiability_date" id="availiability_date">

						<span class="availability-date">
							<label>Valitse päivämäärä</label>
							<span class="availability_date_show">Year-Month-Date</span>
						</span>

						<span class="min-time">
							<label>Työtunnit</label>

							<div class="seperate-time">
								<select name="min-time">
									<option value="">Valitse</option>
									<?php if ( !empty($time) ): ?>
										<?php foreach ($time as $time_sec => $val): ?>
											<option value="<?= $time_sec; ?>"><?= $val; ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>

								<select name="max-time">
									<option value="">Valitse</option>
									<?php if ( !empty($time) ): ?>
										<?php foreach ($time as $time_sec => $val): ?>
											<option value="<?= $time_sec; ?>"><?= $val; ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>					
							</div>

							<!-- <div class="add_full_time">
								<label>
									<input type="checkbox" name="fullday">
									Koko päivä
								</label>
							</div> -->

						</span>

						<?php if ( $amilia_services ): ?>
							<span class="availability-services">
								<label>Palvelut</label>
								<select name="availability-services">
									<option value="">Valitse</option>
									<?php foreach ($amilia_services as $item): ?>
										<option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
									<?php endforeach ?>
								</select>
							</span>				
						<?php endif ?>

						<span class="availability-submit">
							<input type="submit" value="Päivitä" class="button button-primary" style="width: 100px;" />
							<a href="#!" data-period_id="" id="availability_delete" class="button button-primary" style="background-color: #d4143c !important;margin-left: 10px;border-color: #d4143c !important; color:#fff !important">Poista</a>
							<span class="spinner"></span>
						</span>

						<p class="success">Lisätty onnistuneesti</p>
					</form>				
				</div>
			</div>


		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){

				setTimeout(function(){
					$('#availability .select-available-month select').val('01').change();
				}, 500);


				$('#availability .select-available-month select').change(function(e){
					e.preventDefault();
					$this = $(this);

					$('#availability').find('.available-chart-wrap tbody td').removeClass('active');
					$('#availability .spinner').addClass('is-active');

					let monthVal = $(this).val();
					let YearVal = $('.select-available-year select').val();
					let doctor_id = $('.available-doctor').val();

					if ( doctor_id == '' ) {
						alert('Please Select Doctor Field');
						$(this).val('');
						return;
					}

					if ( YearVal == '' ) {
						alert('Please Select Year Field');
						$(this).val('');
						return;
					}

					if ( monthVal == '' ) {
						alert('Please Select Month Field');
						$(this).val('');
						return;
					}

					let dateTime = new Date(YearVal, monthVal, 0).getDate();
					let month = $(this).val() != '' ? YearVal + '-' + $(this).val() + '-01' : '';

					jQuery.post({
						url: "<?= admin_url('admin-ajax.php'); ?>",
						data: {
							'action': 'get_availability_time',
							'doctor_id' : doctor_id,
							'month' : month
						},
						success: function(response) {

							if ( response.length > 10 ) {
								let results = JSON.parse(response);	

								const start = new Date();
								start.setHours(9, 0, 0);
								const end = new Date();
								end.setHours(17, 0, 0);

								$('#availability tbody').html('');
								$('#availability thead tr').html('');


								if ( start <= end && dateTime > 0 ) {
									for (var i = 0; i < dateTime; i++) {
										$('#availability tbody').append('<tr></tr>');

										$('#availability tbody tr').eq(i).append('<th><span class="current-day">'+ $('#availability tbody tr').length +'</span></th>')

										while (start <= end) {
											$('#availability tbody tr').eq(i).append('<td data-time="'+ start.toLocaleString('en-US', {hour: '2-digit', minute: '2-digit', hourCycle: 'h23'}) +'"></td>');
											  start.setMinutes(start.getMinutes() + 30);
										}
										start.setHours(9, 0, 0);
										end.setHours(17, 0, 0);
									}

									$('#availability thead tr').append('<th class="day_wrap"><span class="current-day">Day<span></th>');
									while (start <= end) {
										$('#availability thead tr').append('<th>'+ start.toLocaleString('en-US', {hour: '2-digit', minute: '2-digit', hourCycle: 'h23'}) +'</th>');

									  start.setMinutes(start.getMinutes() + 30);
									}
								}


								jQuery.map(results, function(item, index){

									$.each(item, function( timeIndex, time ) {
										var startDate = 0;
										var endDate = 0;

										if ( time['startTime'] != '' ) {
											var startDateSplit = time['startTime'].split(':');
											startDate = ( ( ( ( parseInt(startDateSplit[0]) * 60 ) + parseInt(startDateSplit[1]) ) - 540 ) / 30 );
										} 

										if ( time['endTime'] != '' ) {
											var endDateSplit = time['endTime'].split(':');
											endDate = ( ( ( ( parseInt(endDateSplit[0]) * 60 ) + parseInt(endDateSplit[1]) ) - 540 ) / 30 );
										} 
										if ( startDate >= 0 && endDate >= 0 ) {
											$('#availability').find('.available-chart-wrap tbody tr').eq(index - 1).find('td').slice( startDate, endDate + 1 ).addClass('active').attr('data-period_id', time['id']);
										}
									});							

								});

								$('.available-chart').show();
								$('.availability-message').hide();
							} else {
								$('.available-chart').hide();
								$('.availability-message').show();
							}

							$('#availability .spinner').removeClass('is-active');
						}
					});		
				});


				$('button.add_new_availability').click(function(e){
					e.preventDefault();
					$('#add_new_availability-content').addClass('active');
				});

				$('div#add_new_availability-content span.close').click(function(e){
					e.preventDefault();
					$('#add_new_availability-content').removeClass('active');
				});

				$('#add_new_availability').on('change', '.add_full_time input', function(e){
					e.preventDefault();

					if ( $(this).prop('checked') == true ) {
						$('.seperate-time').hide();
					} else {
						$('.seperate-time').show();
					}
				});

				$('#add_new_availability').submit(function(e){
					e.preventDefault();
					
					if ( $('.add_full_time input').prop('checked') == false && $('select[name="min-time"]').val() == '' && $('select[name="max-time"]').val() == '' ) {
						alert('Please Input Valid Time');
						return;
					}

					if ( $('.add_full_time input').prop('checked') == false ) {
						if ( $('select[name="min-time"]').val() != '' && $('select[name="max-time"]').val() == '' ) {
							alert('Please Input Valid Time');
							return;					
						}

						if ( $('select[name="min-time"]').val() == '' && $('select[name="max-time"]').val() != '' ) {
							alert('Please Input Valid Time');
							return;					
						}					
					}


					$('.success').hide();
					$('#add_new_availability .spinner').addClass('is-active');

					var formData = new FormData($(this)[0]);

					$.ajax({
						url: "<?= admin_url('admin-ajax.php'); ?>",
						type: 'POST',
						data: formData,
						async: true,
						cache: false,
						contentType: false,
						enctype: 'multipart/form-data',
						processData: false,
						success: function(response) {
							
							if ( response.length > 10 ) {
								let results = JSON.parse(response);

								if ( results['startTime'] != '' ) {
									$('#add_new_availability select[name="min-time"]').find('option[value="'+ results['startTime'] +'"]').attr('disabled', 'disabled');
								}

								if ( results['endTime'] != '' ) {
									$('#add_new_availability select[name="max-time"]').find('option[value="'+ results['endTime'] +'"]').attr('disabled', 'disabled');
								}

								if ( results['startTime'] != '' && results['endTime'] != '' && $('input[name="availability-date"]').val() != '' ) {
									console.log(results['startTime'], results['endTime'], $('input[name="availability-date"]').val());

									let cday = $('input[name="availability-date"]').val().substring($('input[name="availability-date"]').val().length - 2);

									var startDateSplit = results['startTime'].split(':');
									var endDateSplit = results['endTime'].split(':');

									let startDate = ( ( ( ( parseInt(startDateSplit[0]) * 60 ) + parseInt(startDateSplit[1]) ) - 540 ) / 30 );
									let endDate = ( ( ( ( parseInt(endDateSplit[0]) * 60 ) + parseInt(endDateSplit[1]) ) - 540 ) / 30 );

									if ( startDate >= 0 && endDate >= 0 ) {
										$('#availability').find('.available-chart-wrap tbody tr').eq(cday - 1).find('td').slice( startDate, endDate + 1 ).addClass('active');
									}
								}

								$('#add_new_availability-content').removeClass('active');

								$('input[name="availability-date"]').val('');
								$('#add_new_availability select[name="min-time"]').val('');
								$('#add_new_availability select[name="max-time"]').val('');

								$('#add_new_availability .spinner').removeClass('is-active');
							}

						},
						error: function(response) {
							// console.log(response);
							alert('failed!');
						}
					});

				});	


				$('#availability').on('mouseover', 'tbody td.active', function(){
					let periodId = $(this).attr('data-period_id');

					$(this).parents('tr').find('td.active[data-period_id="'+ periodId +'"]').addClass('onhere');
					$(this).addClass('remove-availability');
				});

				$('#availability').on('mouseleave', 'tbody td.active', function(){
					$(this).parents('tr').find('td.active').removeClass('onhere');
					$(this).removeClass('remove-availability');
				});

				$('#availability_delete').on('click', function(e){
					e.preventDefault();
					let $this = $(this);
					let periodId = $(this).attr('data-period_id');

					if ( confirm("Are you sure") && $(this).attr('data-period_id') != '' ) {

						let id = $(this).attr('data-period_id');

						$this.parent().find('.spinner').addClass('is-active');

						jQuery.post({
							url: "<?= admin_url('admin-ajax.php'); ?>",
							data: {
								'action': 'remove_availability',
								'period_id' : id,
							},
							success: function(response) {
								if ( response == 1 ) {
									$this.parent().find('.spinner').removeClass('is-active');
									$('#update_availability-content').removeClass('active');
									$('.available-chart-wrap table tr td.active[data-period_id="'+ periodId +'"]').removeClass('active');
								}
							},
							error: function(response) {
								// console.log(response);
								alert('failed!');
							}							
						});
					}
				});

				// a.b# show popup after click, then will be ajax request
				function availability_column_click() {
					$('#availability tbody').on('click', 'td.active.onhere.remove-availability', function(e){
						e.preventDefault();

						$('#update_availability-content').addClass('active');

						
						var period_id = $(this).attr('data-period_id');

						$(this).parents('tr').find('td[data-period_id="'+ period_id +'"]').attr('class', '');

						$('#availability_delete').attr('data-period_id',period_id);
						$('#update_period_id').val(period_id);

						// get data of amelia periods with ajax request
						$('#update_availability-content .ana-wrap').addClass('processing');
						$('#update_availability-content .ana-wrap .spinner').addClass('is-active');
						jQuery.post({
							url: "<?= admin_url('admin-ajax.php'); ?>",
							data: {
								'action': 'get_availability_time_date_service',
								'period_id' : period_id,
							},
							success: function(response) {
								$('#update_availability-content .ana-wrap').removeClass('processing');
								$('#update_availability-content .ana-wrap .spinner').removeClass('is-active');

								var data = response.data;
								$(`#update_availability-content .seperate-time select[name="min-time"] option[value="${data.startTime}"]`).attr('selected', '');
								$(`#update_availability-content .seperate-time select[name="max-time"] option[value="${data.endTime}"]`).attr('selected', '');
								$(`#update_availability-content .availability-services select[name="availability-services"] option[value="${data.serviceId}"]`).attr('selected', '');
								$(`#update_availability-content .availability_date_show`).text(data.startDate);

								$('#availiability_date').val(data.startDate);
							}
						});

					});

					$('div#update_availability-content span.close').click(function(e){
						e.preventDefault();
						$('#update_availability-content').removeClass('active');
						$('#availability_delete').attr('data-period_id',"");
						$('#update_period_id').val("");
					});

					$('#update_availability_pilar').on('submit', function(e) {
						e.preventDefault();

						var form = $(this);
        				var formData = form.serialize();

						$('#update_availability-content .ana-wrap').addClass('processing');
						$('#update_availability-content .ana-wrap .spinner').addClass('is-active');

						jQuery.post({
							url: "<?= admin_url('admin-ajax.php'); ?>",
							data: {
								'action': 'update_availability_pilar',
								'form_data': formData,
							},
							success: function(response) {
								// console.log(response.min_time);
								// console.log(response.max_time);
								// console.log(response.period_id);
								// console.log(response.availiability_date);

									if ( response.min_time != '' && response.max_time != '' && response.availiability_date != '' ) {

										let cday = response.availiability_date.substring(response.availiability_date.length - 2);

										let startDateSplit = response.min_time.split(':');
										let endDateSplit = response.max_time.split(':');

										let startDate = ( ( ( ( parseInt(startDateSplit[0]) * 60 ) + parseInt(startDateSplit[1]) ) - 540 ) / 30 );
										let endDate = ( ( ( ( parseInt(endDateSplit[0]) * 60 ) + parseInt(endDateSplit[1]) ) - 540 ) / 30 );

										if ( startDate >= 0 && endDate >= 0 ) {
											$('#availability').find('.available-chart-wrap tbody tr').eq(cday - 1).find('td').slice( startDate, endDate + 1 ).addClass('active new');
										}
										
										$('#update_availability-content').removeClass('active');
										$('#update_availability-content .ana-wrap').removeClass('processing');
										$('#update_availability-content .ana-wrap .spinner').removeClass('is-active');					
									}

							}
						});

					});
				}
				availability_column_click(); //run this js function #availability_column_click


			});

			
		</script>
		<?php 
	}

	public function remove_availability() {
		$return = '';
		if ( !empty($_POST['period_id']) ) {
			global $wpdb;

			$wpdb->delete( 
				'wp_amelia_providers_to_specialdays_periods_services', 
				[ 'periodId' => $_POST['period_id'] ], 
				[ '%d' ]
			);

			$return = $wpdb->delete( 
				'wp_amelia_providers_to_specialdays_periods', 
				[ 'id' => $_POST['period_id'] ], 
				[ '%d' ]
			);
		}

		echo json_encode( $return );

		wp_die();
	}

	public function get_availability_time_date_service() {
		$return = [];
	
		if (isset($_POST['period_id'])) {
			global $wpdb;
	
			$table_name_periods = $wpdb->prefix . 'amelia_providers_to_specialdays_periods';
			$table_name_specialdays = $wpdb->prefix . 'amelia_providers_to_specialdays';
			$table_name_periods_services = $wpdb->prefix . 'amelia_providers_to_specialdays_periods_services';
	
			$period_id = sanitize_text_field($_POST['period_id']);
	
			$query = $wpdb->prepare("
				SELECT p.*, s.*, ps.serviceId
				FROM $table_name_periods p
				LEFT JOIN $table_name_specialdays s ON p.specialDayId = s.id
				LEFT JOIN $table_name_periods_services ps ON p.id = ps.periodId
				WHERE p.id = %d
			", $period_id);
	
			$result = $wpdb->get_row($query, ARRAY_A);
	
			if ($result) {
				$return['data'] = $result;
			}
		}
	
		wp_send_json($return);

		wp_die();
	}	
	
	public function update_availability_pilar() {
		$return = [];
	
		global $wpdb;
	
		$form_data = isset($_POST['form_data']) ? $_POST['form_data'] : '';
		parse_str($form_data, $formFields);
	
		$period_id = $formFields['period_id'];
		$min_time = $formFields['min-time'];
		$max_time = $formFields['max-time'];
		$availability_services = $formFields['availability-services'];
		$period_id = $formFields['period_id'];
		$availiability_date = $formFields['availiability_date'];
	
		// Update the wp_amelia_providers_to_specialdays_periods table
		$table_name_periods = $wpdb->prefix . 'amelia_providers_to_specialdays_periods';

		$data_periods = array(
			'startTime' => $min_time,
			'endTime'   => $max_time,
		);
		$where_periods = array(
			'id' => $period_id,
		);
		$wpdb->update($table_name_periods, $data_periods, $where_periods);
	
		// Update the wp_amelia_providers_to_specialdays_periods_services table
		$table_name_services = $wpdb->prefix . 'amelia_providers_to_specialdays_periods_services';

		$data_services = array(
			'serviceId' => $availability_services,
		);
		$where_services = array(
			'periodId' => $period_id,
		);
		$wpdb->update($table_name_services, $data_services, $where_services);
	
		$return['min_time'] = $min_time;
		$return['max_time'] = $max_time;
		$return['period_id'] = $period_id;
		$return['availiability_date'] = $availiability_date;

		wp_send_json($return);

		wp_die();
	}	

	public function add_new_availability() {
		$existing_day_periods = [];

		if ( isset($_POST['fullday']) && $_POST['fullday'] == 'on' ) {
			$startTime = '09:00:00';
			$endTime = '17:00:00';
		} elseif ( !empty($_POST['min-time']) && !empty($_POST['max-time']) ) {
			$startTime = $_POST['min-time'];
			$endTime = $_POST['max-time'];		
		} else {
			$startTime = '';
			$endTime = '';
		}

		if ( !empty($_POST['availability-date']) && !empty($startTime) && !empty($endTime) ) {
			global $wpdb;

			// Get Amelia User
			$amilia_user = $wpdb->get_row($wpdb->prepare( "SELECT id FROM wp_amelia_users WHERE externalId = %s", get_current_user_id()), ARRAY_A);


			if ( !empty($amilia_user) ) {


				// Check Existing Day
				$existing_day = $wpdb->get_row($wpdb->prepare( "SELECT id FROM wp_amelia_providers_to_specialdays WHERE startDate = %s AND userId = %d", $_POST['availability-date'], $amilia_user['id']), ARRAY_A);


				if ( empty($existing_day) ) {
					$wpdb->insert( 'wp_amelia_providers_to_specialdays', array(
							'userId' => $amilia_user['id'],
							'startDate' => $_POST['availability-date'],
							'endDate' => $_POST['availability-date'],
						),
						array(
							'%d',
							'%s',
							'%s',
						)
					);
				} 


				if ( !empty($existing_day) ) {
					$current_date_id = $existing_day['id'];
				} elseif ( $wpdb->insert_id ) {
					$current_date_id = $wpdb->insert_id;
				}


				if ( !empty($current_date_id) ) {

					$existing_day_periods = $wpdb->get_row($wpdb->prepare( "SELECT * FROM wp_amelia_providers_to_specialdays_periods WHERE specialDayId = %d AND startTime = %s", $current_date_id, $startTime), ARRAY_A);


					if ( empty($existing_day_periods) ) {
						$wpdb->insert( 'wp_amelia_providers_to_specialdays_periods', array(
								'specialDayId' => $current_date_id,
								'startTime' => $startTime,
								'endTime' => $endTime,
							),
							array(
								'%d',
								'%s',
								'%s',
							)
						);

						$day_periods = $wpdb->insert_id;

						if ( $day_periods ) {
							$existing_day_periods = $wpdb->get_row($wpdb->prepare( "SELECT * FROM wp_amelia_providers_to_specialdays_periods WHERE id = %d", $day_periods), ARRAY_A);						
							if ( !empty($_POST['availability-services']) ) {

								$existing_services_periods = $wpdb->get_row($wpdb->prepare( "SELECT * FROM wp_amelia_providers_to_specialdays_periods_services WHERE periodId = %d", $day_periods ), ARRAY_A);

								if ( empty($existing_services_periods) ) {

									$wpdb->insert( 'wp_amelia_providers_to_specialdays_periods_services', array(
											'periodId' => $day_periods,
											'serviceId' => $_POST['availability-services']
										),
										array(
											'%d',
											'%d',
										)
									);							
								}
							}
						}
					}
				}

			}
		}

		echo json_encode( $existing_day_periods );

		wp_die();
	}

	public function amelia_dashboard_callback(){
		global $wpdb;
		$submit_meta = $wpdb->prefix . 'wsf_submit_meta';
		$table = $wpdb->prefix . 'wsf_submit';

		$get_form_id = isset($_GET['form_id']) ? $_GET['form_id'] : '';

		if ( !empty($get_form_id) ) {
			$submission_id_sql = $wpdb->get_results( "SELECT id FROM {$table} WHERE form_id = {$get_form_id}", ARRAY_A );
			$submission_id_arr = array_column( $submission_id_sql, 'id' );

			if ( !empty($submission_id_arr) ) {
				$submission_id_str = implode(',', $submission_id_arr);			
				$results = $wpdb->get_results("SELECT meta_value, parent_id FROM {$submit_meta} WHERE meta_key = 'woocommerce_order_id' AND parent_id IN ({$submission_id_str}) ORDER BY id DESC");
			}

		} else {

			$submission_id_sql = $wpdb->get_results( "SELECT id FROM {$table} WHERE form_id != 20", ARRAY_A );
			$submission_id_arr = array_column( $submission_id_sql, 'id' );

			if ( !empty($submission_id_arr) ) {
				$submission_id_str = implode(',', $submission_id_arr);			
				$results = $wpdb->get_results("SELECT meta_value, parent_id FROM {$submit_meta} WHERE meta_key = 'woocommerce_order_id' AND parent_id IN ({$submission_id_str}) ORDER BY id DESC");
			}

		}



		$select_form = [
			// 20 => 'Pikavastaanotto',
			17 => 'Älykellon-EKG',
			11 => 'Haluan arvion oireistani',
			13 => 'Arvio tehdyistä sydäntutkimuksista',
			14 => 'Muu syy',
		];

	?>
	<style type="text/css"> div#pikavasta th {min-width: 72px; color: var(--adminify-btn-bg) !important; } #submission_info {display: none; position: fixed; right: 0; top: 90px; bottom: 0; width: 500px; } div#pikavasta {position: relative; } #submission_info h1 {font-size: 21px; color: var(--adminify-btn-bg); } div#pikavasta h1 {font-size: 21px; color: var(--adminify-btn-bg); margin-bottom: 10px; } #submission_info .close {position: absolute; left: 0; right: 0; width: 30px; height: 30px; background: var(--adminify-btn-bg); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; } #submission_info .submission-info-wrap {padding: 32px; height: 100%; background: #fff; overflow-y: scroll; } #submission_info h1 {margin: 17px 0; } #submission_info table th {font-weight: 700; } #submission_info table td:first-child {font-weight: 500; } #submission_info tr td, #submission_info tr th {border-bottom: 1px solid #ddd; border-right: 1px solid #ddd; vertical-align: middle; word-break: break-word; } .loader {width: 48px; height: 48px; border: 5px solid #e0e0e0; border-bottom-color: var(--adminify-btn-bg); border-radius: 50%; display: none; box-sizing: border-box; animation: rotation 1s linear infinite; } .loader.active {display: inline-block; } @keyframes rotation {0% {transform: rotate(0deg); } 100% {transform: rotate(360deg); } } .submission-content {display: none; } </style> 
	<div class="wrap">
		<div id="pikavasta">
			<?php if ( $get_form_id != 20 ): ?>
				<div class="form_selection">
					<form action="/wp-admin/admin.php">
						<input type="hidden" name="page" value="kaikki">
						<select name="form_id">
							<option value="">Valitse kaikki</option>
							<?php foreach ($select_form as $key => $value): ?>
								<option value="<?= $key; ?>" <?php selected( $get_form_id, $key, true ); ?>><?= $value; ?></option>
							<?php endforeach ?>
						</select>		
					</form>
				</div>				
			<?php endif ?>

			<?php if(isset($_GET['form_id']) && $_GET['form_id'] == 20) { 

			} else { ?>

			<h1><?= !empty($get_form_id) ? $select_form[$get_form_id] : '' ; ?></h1>

			<?php } ?>


			<table class="wp-list-table widefat">
				<thead>
					<tr>
						<th class="submission_id">ID</th>
						<?php if(isset($_GET['form_id']) && $_GET['form_id'] == 20) { ?>
						<th>Ajastin</th>
						<th>Toiminta</th>
						<?php } ?>
						<th>Nimi</th>
						<th>Sähköposti</th>
						<th>Puhelin</th>
						<th>Hinta</th>
						<th>Päivämäärä</th>
						<th>Avaa potilas</th>
						<th>Tarkemmat tiedot</th>
					</tr>
				</thead>
				<tbody>
	<?php 
	if ( !empty($results) ) {
		$num = 0;
		foreach ($results as $item) {
			$num++;
			$form_id = !empty($item->parent_id) ? $item->parent_id : 0;
			$order_id = $item->meta_value;

			if ( $form_id == 20 ) {
				break;
			}

			if ( !empty($order_id) ) {
				$order = wc_get_order($order_id);
			}

			if ( !empty($order) ) {
				$name = sprintf('%s %s', !empty($order->get_billing_first_name()) ? $order->get_billing_first_name() : '', !empty($order->get_billing_last_name()) ? $order->get_billing_last_name() : '' );
				$email = !empty($order->get_billing_email()) ? $order->get_billing_email() : '';
				$phone = !empty($order->get_billing_phone()) ? $order->get_billing_phone() : '';
				$price = !empty($order->get_formatted_order_total()) ? $order->get_formatted_order_total() : '';
				$date = !empty($order->get_date_created()) ? $order->get_date_created()->date("d-m-Y") : '';
				$time = !empty($order->get_date_created()) ? $order->get_date_created()->date("H:i:s") : '';

				?>

					<?php
						$items = $order->get_items();
						foreach ($items as $item_id => $item) {
							$timer = $item->get_meta('timer');

							if($timer == 'processing') {
					?>
					<tr class="form_id_<?= $form_id ?>" style="opacity: 0.3; pointer-events:none">
					<?php
							} else {
					?>
					<tr class="form_id_<?= $form_id ?>" >
					<?php
							}
						}
					?>

					
						<td>
							<?= $form_id ?>

							<?php 
								// new submission text show 
								$items = $order->get_items();
								foreach ($items as $item_id => $item) {
									$form_notification = $item->get_meta('form_notification');

									if($form_notification == 1) {
										echo '<span class="new_notification_text">New</span>';
									}
								}
							?>
						</td>

						<?php
							if(isset($_GET['form_id']) && $_GET['form_id'] == 20) {

								$items = $order->get_items();
								?>
								<td>
									<span class="timer_text" id="timer<?= $num;?>" data-timer="<?php foreach ($items as $item_id => $item) {
										$timer = $item->get_meta('timer');
										echo $timer;}?>" <?php if($items){echo ' style="font-weight:bold;color:#009e82;" ';}?> >

										<?php
											foreach ($items as $item_id => $item) {
												$timer = $item->get_meta('timer');

												if($timer == 'done') {
													echo '<p style="font-weight:bold;color:#009e82;">Potilas käsitelty</p>';
												} else if($timer == 'processing') {
													echo '<p style="color:red;font-weight:bold;">Käsittelyssä</p>';
												} else if($timer == 0 || $timer == '') {
													echo '<p style="color:red;font-weight:bold;">Myöhässä</p>';
												} else {
													$minutes = floor($timer / 60);
													$seconds = $timer % 60;
													echo sprintf('%02d:%02d', $minutes, $seconds);
												}
											}
										?>
									</span>
								</td>

								<td>
									<?php
										foreach ( $items as $item_id => $item) {
											$timer = $item->get_meta('timer');
											$id = $item_id;

											if($timer == 'done') {
												?>
													<button class="button secondary is-outline" style="border-radius: 5px; background-color: #009e82; color: #fff; border-color: #009e82;opacity:0.3;pointer-event:none;cursor:default">Merkitse tehdyksi</button>
												<?php
											} else {
												?>
													<form action="" class="timer_form">
														<i class="spinner"></i>
														<input type="hidden" name="order_id" value="<?= $order_id;?>">
														<button class="button secondary is-outline processing_text" style="border-radius: 5px; background-color: #009e82; color: #fff; border-color: #009e82;">Merkitse tehdyksi</button>
													</form>
												<?php
											}
										}
									?>
								</td>
								<?php								
							}
						?>

						<td><?= $name; ?></td>
						<td><?= $email; ?></td>
						<td><?= $phone; ?></td>
						<td><?= $price; ?></td>
						<td><?= $date; ?></td>
						<td>
							<input type="hidden" class="order_id_notification" value="<?= $order_id;?>">
							<button class="open_patient button new_notification_click" data-id="<?= $order_id; ?>" data-date="<?= $date; ?>" data-phone="<?= $phone; ?>" data-firstname="<?php echo !empty($order->get_billing_first_name()) ? $order->get_billing_first_name() : ''; ?>" data-lastname="<?php echo !empty($order->get_billing_last_name()) ? $order->get_billing_last_name() : ''; ?>" data-submission="<?= $form_id ?>" data-user_id="<?= $order->get_customer_id(); ?>" data-time="<?= $time; ?>">Avaa potilas</button>
						</td>
						<td>
							<input type="hidden" class="order_id_notification" value="<?= $order_id;?>">
							<?php
								foreach ( $items as $item_id => $item) {
									$timer = $item->get_meta('timer');
									$id = $item_id;

									if($timer == 'done') {
										?>
											<button class="view_more_sub button new_notification_click" data-id="<?= $form_id; ?>">Tarkemmat tiedot</button>
										<?php
									} else {
										?>
											<button class="view_more_sub button new_notification_click processing_click" data-id="<?= $form_id; ?>">Tarkemmat tiedot</button>
										<?php
									}
								}
							?>
						</td>			
					</tr>			
				<?php 
			}
		}
	}
	 ?>			
					
				</tbody>
				<tfoot>
					<tr>
						<th class="submission_id">ID</th>
						<?php if(isset($_GET['form_id']) && $_GET['form_id'] == 20) { ?>
						<th>Ajastin</th>
						<th>Toiminta</th>
						<?php } ?>
						<th>Nimi</th>
						<th>Sähköposti</th>
						<th>Puhelin</th>
						<th>Hinta</th>
						<th>Päivämäärä</th>
						<th>Avaa potilas</th>
						<th>Tarkemmat tiedot</th>
					</tr>			
				</tfoot>
			</table>
			<div id="submission_info">
				<span class="dashicons dashicons-no-alt close"></span>
				<div class="submission-info-wrap">
					<span class="loader"></span>
					<div class="submission-content">
						<h1></h1>
						<table class="wp-list-table widefat">
							<thead>
								<tr>
									<th>Nimi</th>
									<th>Sisältö</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th>Nimi</th>
									<th>Sisältö</th>
								</tr>					
							</tfoot>
						</table>					
					</div>
				</div>
			</div>
		</div>


	</div>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.form_selection form').on('change', 'select', function(e){
				e.preventDefault();
				$(this).parents('form').submit();
			});

			$('#pikavasta .view_more_sub').click(function(e){
				e.preventDefault();
				var id = $(this).data('id');

				$('#submission_info').show();
				$('#submission_info .submission-content').hide();
				$('.loader').addClass('active');
				$('#submission_info tbody').html('');

				$('#submission_info .close').addClass('processing_close');
				$('#submission_info .close').attr('id', `form_id_${id}`)

				$('#submission_info h1').html($(this).parents('#pikavasta').find('h1').html());

				jQuery.post({
					url: "<?= admin_url('admin-ajax.php'); ?>",
					data: {
						'action': 'get_submission_info',
						'id' : id
					},
					success: function(response) {
						if ( response.length > 10 ) {
							var results = JSON.parse(response);

							jQuery.map(results, function(item, index){

								if ( item['type'] != undefined && item['type'] == 'file' ) {
									$('#submission_info tbody').append('<tr class="'+ item['key'] +'"><td>'+ item['label'] +'</td><td><a href="'+ item['value'] +'" target="_blank"><span class="dashicons dashicons-media-document"></span></a></td></tr>');
								} else {
									$('#submission_info tbody').append('<tr class="'+ item['key'] +'"><td>'+ item['label'] +'</td><td>'+ item['value'] +'</td></tr>');
								}

							});

							$('.loader').removeClass('active');
							$('#submission_info .submission-content').show();						
						}
					}
				});

				$('.processing_close').on('click', function(){
					get_id = $(this).attr('id');

					$(`.${get_id}`).find('.processing_text').text('Merkitse tehdyksi');
					$(`.${get_id}`).css({
						'opacity': '1',
						'pointer-events': 'inherit',
					});

					var order_id_notification = $(`.${get_id}`).find('.order_id_notification').val();;

					$.ajax({
						type: 'POST',
						url: adminAjax.ajaxurl,
						data: {
							action: 'processing_close',
							'order_id_notification' : order_id_notification,
						},
						success: function(response) {
							// get_this.parent().parent().find('.new_notification_text').remove();
						},
						error: function(error) {
							console.error('Error:', error);
						}
					});
				});
				
				

			});

			$('#submission_info .close').click(function(){
				$('#submission_info').hide();
			});
		});
	</script>
	<?php 
	}

	public function get_submission_info(){
		$returnVal = [];

		if ( !empty($_POST['id']) ) {

			global $wpdb;
			$submit_meta = $wpdb->prefix . 'wsf_submit_meta';
			$field_label_table = $wpdb->prefix . 'wsf_field';

			$results = $wpdb->get_results("SELECT meta_key, meta_value, field_id FROM {$submit_meta} WHERE parent_id = {$_POST['id']} AND field_id IS NOT NULL", ARRAY_A);

			foreach ($results as $key => $field_key) {
				$field_label = $wpdb->get_results("SELECT label FROM {$field_label_table} WHERE id = {$field_key['field_id']}", ARRAY_A);
				$returnVal[$key]['label'] = !empty($field_label) ? $field_label[0]['label'] : '';
				$returnVal[$key]['key'] = !empty($field_key['meta_key']) ? $field_key['meta_key'] : '';

				if ( !empty($field_key['meta_value']) ) {

					if ( is_serialized( $field_key['meta_value'] ) ) {
						$field_Val_uns = unserialize($field_key['meta_value']);


						if ( is_array($field_Val_uns[0]) && !empty($field_Val_uns[0]['name']) ) {

							// $file_path = explode('/', $field_Val_uns[0]['path']);
							// $url = \WS_Form_Common::get_api_path('helper/file_download', sprintf('hash=%s&field_id=%u&file_index=%u&_wpnonce=%s&%s=%s', rawurlencode($file_path[2]), rawurlencode($file_path[3]), rawurlencode(0), wp_create_nonce('wp_rest'), rawurlencode(WS_FORM_POST_NONCE_FIELD_NAME), rawurlencode(wp_create_nonce(WS_FORM_POST_NONCE_ACTION_NAME))));
							
							$url = home_url('/wp-content/uploads/').$field_Val_uns[0]['path'];
							$returnVal[$key]['value'] = $url;
							$returnVal[$key]['type'] = 'file';

						} else {
							$returnVal[$key]['value'] = implode(', ', $field_Val_uns);
						}


					} else {
						$returnVal[$key]['value'] = $field_key['meta_value'];
					}
				} else {
					$returnVal[$key]['value'] = '';
				}
			}
		}

		echo json_encode( $returnVal );
		wp_die();
	}

	public function get_availability_time() {
		$return = [];

		if ( !empty($_POST['doctor_id']) && !empty($_POST['month']) ) {
			global $wpdb;
			$doctor_id = $_POST['doctor_id'];
			$first_day = date('Y-m-d', strtotime($_POST['month']));
			$last_day =  date('Y-m-t', strtotime($_POST['month']));

			$specialDay = $wpdb->get_results($wpdb->prepare("SELECT id, userId, startDate FROM wp_amelia_providers_to_specialdays WHERE userId = %d AND startDate BETWEEN %s AND %s", $doctor_id, $first_day, $last_day), ARRAY_A);	

			$convertSpecialDay = array_column($specialDay, NULL, 'id');

			$special_id = array_column($specialDay, 'id');
			$assva = implode(',', $special_id);

			$specialTime = $wpdb->get_results("SELECT id, specialDayId, startTime, endTime FROM wp_amelia_providers_to_specialdays_periods WHERE specialDayId IN({$assva})", ARRAY_A);	

			$newSpecialTime = [];
			foreach ($specialTime as $key => $time) {
				$key_time = date("d", strtotime($convertSpecialDay[$time['specialDayId']]['startDate']));
				// $newSpecialTime[$key_time]['specialDayId'] = $convertSpecialDay[$time['specialDayId']]['startDate'];
				$newSpecialTime[$key_time][$key]['id'] = $time['id'];
				$newSpecialTime[$key_time][$key]['startTime'] = $time['startTime'];
				$newSpecialTime[$key_time][$key]['endTime'] = $time['endTime'];
			}	
		}

		echo json_encode( $newSpecialTime );

		wp_die();
	}

}


add_action( 'plugins_loaded', function(){
	SNF::get_instance();
});