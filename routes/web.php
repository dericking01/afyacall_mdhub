<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/admin/home');
Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/dashboard','HomeController@dashboard')->name('dashboard');
    Route::get('graphs/chartdata', 'HomeController@getChartData')->name('graphschartsdata');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::post('users/change-status', 'Admin\UsersController@userChangeStatus')->name('user.change_status');
    Route::post('users/admin-change-status', 'Admin\UsersController@adminChangeStatus')->name('user.admin_change_status');
    
    Route::post('users/change_password', 'Admin\UsersController@changePassword')->name('user.change_password');
    Route::post('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    Route::get('prescription_settings', 'Admin\PrescriptionSettingController@index')->name('prescription-settings');

    //Patient Management
    Route::resource('patients', 'Patient\PatientController');
    Route::get('patients/medical-history/{id}', 'Patient\PatientController@patientMedicalHistory')->name('patient.medical.history');
    Route::post('patients/report', 'Patient\PatientController@report')->name('patients.report');
    Route::get('patients/report/home', 'Patient\PatientController@report_index')->name('patient.report_home');
    Route::get('patients/report/preview-patient-report', 'Patient\PatientController@preview_report')->name('patient.preview_report');

    //Doctors Management
    Route::resource('doctors', 'Doctor\DoctorController');
    Route::post('doctors/report', 'Doctor\DoctorController@report')->name('doctors.report');
    Route::get('doctors/report/home', 'Doctor\DoctorController@report_index')->name('doctor.report_home');
    Route::get('doctors/report/preview-doctor-report', 'Doctor\DoctorController@preview_report')->name('doctor.preview_report');
    Route::get('doctors/{id}/calls', 'Doctor\DoctorController@getCalls')->name('doctor.calls');

    //UsersLogActivities
    Route::resource('userlogs', 'Admin\UserLogsActivitiesController');
    // illness controllers 
    Route::resource('illnesses', 'Diseases\IllnessesController');
    Route::post('symptoms/import', 'Diseases\IllnessesController@import')->name('symptoms.import');

    //chief complaints
    Route::resource('chiefcomplaint', 'Diseases\ChiefComplaintController');
    // Location controller    
    Route::get('location/reports/total_patients_all_regions', 'Location\ReportsController@getTotalPatientsAllRegions')->name('location.report.total_patients_all_regions');
    Route::get('location/reports/total_patients_per_region/{region_id}', 'Location\ReportsController@getTotalPatientsPerRegion')->name('location.report.total_patients_per_region');
    // Route::get('location/reports/total_patients_per_district', 'Location\ReportsController@getTotalPatientsPerDistrict')->name('location.report.total_patients_per_district');
    Route::get('location/reports/total_doctors_all_regions', 'Location\ReportsController@getTotalDoctorsAllRegions')->name('location.report.total_doctors_all_regions');
    Route::get('location/reports/total_doctors_per_region/{region_id}', 'Location\ReportsController@getTotalDoctorsPerRegion')->name('location.report.total_doctors_per_region');
    // Route::get('location/reports/total_doctors_per_district', 'Location\ReportsController@getTotalDoctorsPerDistrict')->name('location.report.total_doctors_per_district');
    Route::get('location/reports', 'Location\ReportsController@index')->name('location.report_home');
    Route::resource('regions', 'Location\RegionsController');
    Route::resource('districts', 'Location\DistrictsController');
    Route::resource('wards', 'Location\WardsController');
    Route::resource('streets', 'Location\StreetsController');

    //get district by Region Id
    Route::post('district_region', 'Location\RegionsController@districts')->name('region.get_disctricts');

    //Home remedies
    Route::get('consultation', 'HomeRemedies\HomeRemediesController@index')->name('home.remedies');
    Route::get('consultation/page', 'HomeRemedies\HomeRemediesController@create')->name('home.remedies.create');
    Route::get('consultation/view/{id}', 'HomeRemedies\HomeRemediesController@view')->name('home.remedies.view');
        Route::get('consultation/edit/{id}', 'HomeRemedies\HomeRemediesController@edit')->name('home.remedies.edit');
    Route::patch('consultation/update/{id}', 'HomeRemedies\HomeRemediesController@update_remedies')->name('home.update_remedies');
    Route::get('consultation/consulte-patient-now/{id}', 'HomeRemedies\HomeRemediesController@remedies_patient_now')->name('home.remedies.remedies_patient_now');
    Route::post('consultation/create-patient', 'HomeRemedies\HomeRemediesController@create_patient')->name('home.create_patient');
    Route::post('consultation/patient-data', 'HomeRemedies\HomeRemediesController@patient_data')->name('home.patient_data');
    Route::post('consultation/new-consultation', 'HomeRemedies\HomeRemediesController@new_remedies')->name('home.new_remedies');
    Route::get('/icd/search','HomeRemedies\IcdDiagnosisController@search')->name('home.icd_search');


    //Calendar
    Route::get('calendar', 'Calendar\CalendarController@index')->name('calendar');
    Route::resource('myschedule', 'Calendar\MySchedularController');

    //Health Facilities
    Route::resource('healthfacility', 'HealthFacility\HealthFacilityController');

    //CDR Reports
    Route::get('cdr', 'Admin\CdrReportController@index')->name('cdr');
    Route::get('cdr/all', 'Admin\CdrReportController@allcdr')->name('cdr.all');
    
    //logs
    Route::get('user-logs', 'Logs\SystemLogsController@userlogs')->name('user.logs');
    Route::get('sms-logs', 'Logs\SystemLogsController@smslogs')->name('sms.logs');
    Route::get('email-logs', 'Logs\SystemLogsController@emaillogs')->name('email.logs');

    //notification report
    Route::get('notification-sms', 'Doctor\DoctorController@notification')->name('notification.sms');
    Route::post('notificationsms', 'Doctor\DoctorController@getNotification')->name('getnotification.sms');
    
});
