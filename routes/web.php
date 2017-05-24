<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//DataTable
Route::get('student/achievements/data', ['uses' => 'StudentAchievementsController@data', 'as' => 'studentachievement.data']);
Route::get('admin/maintenance/budgtype/data', ['uses' => 'AdminMBudgtypeController@data', 'as' => 'budgtype.data']);
Route::get('admin/maintenance/grade/data', ['uses' => 'AdminMGradeController@data', 'as' => 'grade.data']);
Route::get('admin/maintenance/steps/data', ['uses' => 'AdminMStepsController@data', 'as' => 'steps.data']);
Route::get('admin/maintenance/year/data', ['uses' => 'AdminMYearController@data', 'as' => 'year.data']);
Route::get('admin/maintenance/sem/data', ['uses' => 'AdminMSemController@data', 'as' => 'sem.data']);
Route::get('admin/maintenance/batch/data', ['uses' => 'AdminMBatchController@data', 'as' => 'batch.data']);
Route::get('admin/maintenance/councilor/data', ['uses' => 'AdminMCouncilorController@data', 'as' => 'councilor.data']);
Route::get('admin/maintenance/course/data', ['uses' => 'AdminMCourseController@data', 'as' => 'course.data']);
Route::get('admin/maintenance/barangay/data', ['uses' => 'AdminMBarangayController@data', 'as' => 'barangay.data']);
Route::get('admin/maintenance/school/data', ['uses' => 'AdminMSchoolController@data', 'as' => 'school.data']);
Route::get('admin/maintenance/district/data', ['uses' => 'AdminMDistrictController@data', 'as' => 'district.data']);
//Student Route List
Route::resource('student/dashboard', 'StudentIndexController');
Route::resource('student/renewal', 'StudentRenewalController');
Route::resource('student/profile', 'StudentProfileController');
Route::resource('student/messages', 'StudentMessagesController');
Route::resource('student/achievements', 'StudentAchievementsController');
Route::resource('student/events', 'StudentEventsController');
//Checkbox Route List
Route::put('coordinator/services/events/checkbox/{id}', ['uses' => 'CoordinatorEventsController@checkbox', 'as' => 'events.checkbox']);
Route::put('admin/maintenance/budgtype/checkbox/{id}', ['uses' => 'AdminMBudgtypeController@checkbox', 'as' => 'budgtype.checkbox']);
Route::put('admin/maintenance/grade/checkbox/{id}', ['uses' => 'AdminMGradeController@checkbox', 'as' => 'grade.checkbox']);
Route::put('admin/maintenance/sem/checkbox/{id}', ['uses' => 'AdminMSemController@checkbox', 'as' => 'sem.checkbox']);
Route::put('admin/maintenance/year/checkbox/{id}', ['uses' => 'AdminMYearController@checkbox', 'as' => 'year.checkbox']);
Route::put('admin/maintenance/steps/checkbox/{id}', ['uses' => 'AdminMStepsController@checkbox', 'as' => 'steps.checkbox']);
Route::put('admin/maintenance/district/checkbox/{id}', ['uses' => 'AdminMDistrictController@checkbox', 'as' => 'district.checkbox']);
Route::put('admin/maintenance/batch/checkbox/{id}', ['uses' => 'AdminMBatchController@checkbox', 'as' => 'batch.checkbox']);
Route::put('admin/maintenance/school/checkbox/{id}', ['uses' => 'AdminMSchoolController@checkbox', 'as' => 'school.checkbox']);
Route::put('admin/maintenance/barangay/checkbox/{id}', ['uses' => 'AdminMBarangayController@checkbox', 'as' => 'barangay.checkbox']);
Route::put('admin/maintenance/course/checkbox/{id}', ['uses' => 'AdminMCourseController@checkbox', 'as' => 'course.checkbox']);
Route::put('admin/maintenance/councilor/checkbox/{id}', ['uses' => 'AdminMCouncilorController@checkbox', 'as' => 'councilor.checkbox']);
//SMS Route List
Route::resource('how-to-apply', 'SMSHowToApplyController');
Route::resource('apply', 'SMSAccountApplyController');
//Coordinator Route List
Route::resource('coordinator/scholar/details', 'CoordinatorApplicantsDetailsController');
Route::resource('coordinator/dashboard', 'CoordinatorIndexController');
Route::resource('coordinator/services/messages', 'CoordinatorMessagesController');
Route::resource('coordinator/services/announcements', 'CoordinatorAnnouncementsController');
Route::resource('coordinator/services/profile', 'CoordinatorProfileController');
Route::resource('coordinator/scholar/students', 'CoordinatorStudentsController');
Route::resource('coordinator/scholar/list', 'CoordinatorStudentsListController');
Route::resource('coordinator/scholar/applicants', 'CoordinatorApplicantsController');
Route::resource('coordinator/services/budget', 'CoordinatorBudgetController');
Route::resource('coordinator/services/reports', 'CoordinatorReportsController');
Route::resource('coordinator/services/queries', 'CoordinatorQueriesController');
Route::resource('coordinator/services/events', 'CoordinatorEventsController');
Route::resource('coordinator/scholar/achievements', 'CoordinatorAchievementsController');
Route::resource('coordinator/scholar/token', 'CoordinatorTokenController');
// Admin Route List
Route::resource('admin/maintenance/budgtype', 'AdminMBudgtypeController');
Route::resource('admin/maintenance/grade', 'AdminMGradeController');
Route::resource('admin/maintenance/sem', 'AdminMSemController');
Route::resource('admin/maintenance/year', 'AdminMYearController');
Route::resource('admin/maintenance/steps', 'AdminMStepsController');
Route::resource('admin/maintenance/school', 'AdminMSchoolController');
Route::resource('admin/maintenance/batch','AdminMBatchController');
Route::resource('admin/maintenance/district','AdminMDistrictController');
Route::resource('admin/maintenance/course', 'AdminMCourseController');
Route::resource('admin/maintenance/councilor', 'AdminMCouncilorController');
Route::resource('admin/maintenance/barangay','AdminMBarangayController');
Route::resource('admin/dashboard', 'AdminIndexController');
//Landing Page Routing List
Route::resource('/', 'SMSIndexController');
//Authentication Route
Auth::routes();
