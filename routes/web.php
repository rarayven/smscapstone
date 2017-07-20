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
//Student Route List
Route::group(['prefix' => 'student/'], function () {
	//Student Notification
	Route::get('messages/notification', ['uses' => 'StudentMessagesController@unreadmessage', 'as' => 'studentmessage.unreadmessage']);
	//Student Checkbox Route List
	Route::put('announcements/checkbox/{id}', ['uses' => 'StudentAnnouncementController@checkbox', 'as' => 'studentannouncements.checkbox']);
	Route::put('messages/checkbox/{id}', ['uses' => 'StudentMessagesController@checkbox', 'as' => 'studentinbox.checkbox']);
	//Student DataTable
	Route::get('messages/sentdata', ['uses' => 'StudentMessagesController@sentdata', 'as' => 'studentsent.data']);
	Route::get('messages/inboxdata', ['uses' => 'StudentMessagesController@inboxdata', 'as' => 'studentinbox.data']);
	//Student Profile
	Route::get('profile', ['uses' => 'StudentProfileController@index', 'as' => 'studentprofile.index']);
	Route::post('name', ['uses' => 'StudentProfileController@name', 'as' => 'studentname.store']);
	Route::post('email', ['uses' => 'StudentProfileController@email', 'as' => 'studentemail.store']);
	Route::post('contact', ['uses' => 'StudentProfileController@contact', 'as' => 'studentcontact.store']);
	Route::post('password', ['uses' => 'StudentProfileController@password', 'as' => 'studentpassword.store']);
	Route::post('image', ['uses' => 'StudentProfileController@image', 'as' => 'studentimage.store']);
	Route::post('minfo', ['uses' => 'StudentProfileController@minfo', 'as' => 'studentminfo.store']);
	Route::post('moccu', ['uses' => 'StudentProfileController@moccu', 'as' => 'studentmoccu.store']);
	Route::post('finfo', ['uses' => 'StudentProfileController@finfo', 'as' => 'studentfinfo.store']);
	Route::post('foccu', ['uses' => 'StudentProfileController@foccu', 'as' => 'studentfoccu.store']);
	Route::post('siblings', ['uses' => 'StudentProfileController@siblings', 'as' => 'studentsiblings.store']);
	Route::post('birthday', ['uses' => 'StudentProfileController@birthday', 'as' => 'studentbirthday.store']);
	//Student Renewal
	Route::resource('renewal', 'StudentRenewalController');
	//Student Events
	Route::get('events', ['uses' => 'StudentEventsController@index', 'as' => 'studentevents.index']);
	Route::get('events/upcome', ['uses' => 'StudentEventsController@upcome', 'as' => 'studentevents.upcome']);
	Route::get('events/{id}', ['uses' => 'StudentEventsController@show', 'as' => 'studentevents.show']);
	//Student Messages
	Route::get('messages/sent', ['uses' => 'StudentMessagesController@sent', 'as' => 'studentmessage.sent']);
	Route::get('messages', ['uses' => 'StudentMessagesController@index', 'as' => 'studentmessage.index']);
	Route::get('messages/create', ['uses' => 'StudentMessagesController@create', 'as' => 'studentmessage.create']);
	Route::post('messages', ['uses' => 'StudentMessagesController@store', 'as' => 'studentmessage.store']);
	Route::get('messages/show/{id}', ['uses' => 'StudentMessagesController@show', 'as' => 'studentmessage.show']);
	Route::delete('messages/delete/{id}', ['uses' => 'StudentMessagesController@destroy', 'as' => 'studentmessage.destroy']);
	Route::get('messages/sent/show/{id}', ['uses' => 'StudentMessagesController@showsent', 'as' => 'studentmessage.showsent']);
	Route::delete('messages/sent/delete/{id}', ['uses' => 'StudentMessagesController@destroysent', 'as' => 'studentmessage.destroysent']);
	Route::get('messages/reply/{id}', ['uses' => 'StudentMessagesController@reply', 'as' => 'studentmessage.reply']);
	//Student Announcements
	Route::get('announcements', ['uses' => 'StudentAnnouncementController@index', 'as' => 'studentannouncements.index']);
	Route::get('announcements/unread', ['uses' => 'StudentAnnouncementController@unread', 'as' => 'studentannouncements.unread']);
	//Student Dashboard
	Route::get('dashboard', ['uses' => 'StudentIndexController@index', 'as' => 'student.index']);
});
//Coordinator Route List
Route::group(['prefix' => 'coordinator/'], function () {
	//Coordinator First Use
	Route::get('register', ['uses' => 'CoordinatorFirstUseController@index', 'as' => 'register.index']);
	Route::post('register', ['uses' => 'CoordinatorFirstUseController@store', 'as' => 'register.store']);
	//Coordinator Notification
	Route::get('messages/notification', ['uses' => 'CoordinatorMessagesController@unreadmessage', 'as' => 'coordinatormessage.unreadmessage']);
	//Coordinator DataTable
	Route::get('events/data', ['uses' => 'CoordinatorEventsController@data', 'as' => 'coordinatorevents.data']);
	Route::get('applications/data', ['uses' => 'CoordinatorApplicantsController@data', 'as' => 'applications.data']);
	Route::get('budget/data', ['uses' => 'CoordinatorBudgetController@data', 'as' => 'budget.data']);
	Route::get('messages/sentdata', ['uses' => 'CoordinatorMessagesController@sentdata', 'as' => 'coordinatorsent.data']);
	Route::get('messages/inboxdata', ['uses' => 'CoordinatorMessagesController@inboxdata', 'as' => 'coordinatorinbox.data']);
	Route::get('announcements/data', ['uses' => 'CoordinatorAnnouncementsController@data', 'as' => 'coordinatorannouncements.data']);
	//Coordinator Checkbox Route List
	Route::put('messages/checkbox/{id}', ['uses' => 'CoordinatorMessagesController@checkbox', 'as' => 'coordinatorinbox.checkbox']);
	Route::put('events/attendance/checkbox/{id}', ['uses' => 'CoordinatorEventsController@attendance', 'as' => 'coordinatoreventsattendance.checkbox']);
	Route::put('events/checkbox/{id}', ['uses' => 'CoordinatorEventsController@checkbox', 'as' => 'coordinatorevents.checkbox']);
	Route::put('list/checkbox/{id}', ['uses' => 'CoordinatorStudentsListController@checkbox', 'as' => 'list.checkbox']);
	//Coordinator Profile
	Route::get('profile', ['uses' => 'CoordinatorProfileController@index', 'as' => 'coordinatorprofile.index']);
	Route::post('name', ['uses' => 'CoordinatorProfileController@name', 'as' => 'coordinatorname.store']);
	Route::post('email', ['uses' => 'CoordinatorProfileController@email', 'as' => 'coordinatoremail.store']);
	Route::post('contact', ['uses' => 'CoordinatorProfileController@contact', 'as' => 'coordinatorcontact.store']);
	Route::post('password', ['uses' => 'CoordinatorProfileController@password', 'as' => 'coordinatorpassword.store']);
	Route::post('image', ['uses' => 'CoordinatorProfileController@image', 'as' => 'coordinatorimage.store']);//Coordinator Utilities
	Route::resource('utilities','CoordinatorUtilitiesController');
	//Coordinator Queries
	Route::resource('queries', 'CoordinatorQueriesController');
	//Coordinator Reports
	Route::resource('reports', 'CoordinatorReportsController');
	//Coordinator Renewal
	Route::resource('renewal', 'CoordinatorRenewalController');
	//Coordinator Budget
	Route::get('budget', ['uses' => 'CoordinatorBudgetController@index', 'as' => 'budget.index']);
	Route::post('budget', ['uses' => 'CoordinatorBudgetController@store', 'as' => 'budget.store']);
	Route::get('budget/{id} ', ['uses' => 'CoordinatorBudgetController@show', 'as' => 'budget.show']);
	Route::get('budget/{id}/edit ', ['uses' => 'CoordinatorBudgetController@edit', 'as' => 'budget.edit']);
	Route::post('budget/{id}', ['uses' => 'CoordinatorBudgetController@update', 'as' => 'budget.update']);
	Route::delete('budget/{id}', ['uses' => 'CoordinatorBudgetController@destroy', 'as' => 'budget.destroy']);
	//Coordinator Events
	Route::get('events', ['uses' => 'CoordinatorEventsController@index', 'as' => 'coordinatorevents.index']);
	Route::post('events', ['uses' => 'CoordinatorEventsController@store', 'as' => 'coordinatorevents.store']);
	Route::get('events/{id}', ['uses' => 'CoordinatorEventsController@show', 'as' => 'coordinatorevents.show']);
	Route::get('events/{id}/edit', ['uses' => 'CoordinatorEventsController@edit', 'as' => 'coordinatorevents.edit']);
	Route::put('events/{id}', ['uses' => 'CoordinatorEventsController@update', 'as' => 'coordinatorevents.update']);
	Route::delete('events/{id}', ['uses' => 'CoordinatorEventsController@destroy', 'as' => 'coordinatorevents.destroy']);
	//Coordinator Announcements
	Route::get('announcements', ['uses' => 'CoordinatorAnnouncementsController@index', 'as' => 'coordinatorannouncements.index']);
	Route::post('announcements', ['uses' => 'CoordinatorAnnouncementsController@store', 'as' => 'coordinatorannouncements.store']);
	Route::get('announcements/{id}/edit', ['uses' => 'CoordinatorAnnouncementsController@edit', 'as' => 'coordinatorannouncements.edit']);
	Route::post('announcements/{id}', ['uses' => 'CoordinatorAnnouncementsController@update', 'as' => 'coordinatorannouncements.update']);
	Route::delete('announcements/{id}', ['uses' => 'CoordinatorAnnouncementsController@destroy', 'as' => 'coordinatorannouncements.destroy']);
	//Coordinator Message
	Route::get('messages/sent', ['uses' => 'CoordinatorMessagesController@sent', 'as' => 'coordinatormessage.sent']);
	Route::get('messages', ['uses' => 'CoordinatorMessagesController@index', 'as' => 'coordinatormessage.index']);
	Route::get('messages/create', ['uses' => 'CoordinatorMessagesController@create', 'as' => 'coordinatormessage.create']);
	Route::post('messages', ['uses' => 'CoordinatorMessagesController@store', 'as' => 'coordinatormessage.store']);
	Route::get('messages/show/{id}', ['uses' => 'CoordinatorMessagesController@show', 'as' => 'coordinatormessage.show']);
	Route::delete('messages/delete/{id}', ['uses' => 'CoordinatorMessagesController@destroy', 'as' => 'coordinatormessage.destroy']);
	Route::get('messages/sent/show/{id}', ['uses' => 'CoordinatorMessagesController@showsent', 'as' => 'coordinatormessage.showsent']);
	Route::delete('messages/sent/delete/{id}', ['uses' => 'CoordinatorMessagesController@destroysent', 'as' => 'coordinatormessage.destroysent']);
	Route::get('messages/reply/{id}', ['uses' => 'CoordinatorMessagesController@reply', 'as' => 'coordinatormessage.reply']);
	//Coordinator Checklist
	Route::get('checklist', ['uses' => 'CoordinatorStudentsController@index', 'as' => 'checklist.index']);
	Route::post('checklist', ['uses' => 'CoordinatorStudentsController@store', 'as' => 'checklist.store']);
	Route::get('checklist/create/{id}', ['uses' => 'CoordinatorStudentsController@create', 'as' => 'checklist.create']);
	Route::get('checklist/allocation', ['uses' => 'CoordinatorStudentsController@allocation', 'as' => 'checklist.allocation']);
	Route::put('checklist/{id}', ['uses' => 'CoordinatorStudentsController@update', 'as' => 'checklist.update']);
	Route::put('checklist/allocation/{id}', ['uses' => 'CoordinatorStudentsController@stipend', 'as' => 'checklist.stipend']);
	//Coordinator List
	Route::get('list', ['uses' => 'CoordinatorStudentsListController@index', 'as' => 'list.index']);
	Route::post('list', ['uses' => 'CoordinatorStudentsListController@store', 'as' => 'list.store']);
	Route::get('list/{id}', ['uses' => 'CoordinatorStudentsListController@show', 'as' => 'list.show']);
	Route::put('list/{id}', ['uses' => 'CoordinatorStudentsListController@update', 'as' => 'list.update']);
	//Coordinator Applicants Details
	Route::get('details/{id}', ['uses' => 'CoordinatorApplicantsDetailsController@show', 'as' => 'details.show']);
	Route::get('details/{id}/edit', ['uses' => 'CoordinatorApplicantsDetailsController@edit', 'as' => 'details.edit']);
	Route::put('details/{id}', ['uses' => 'CoordinatorApplicantsDetailsController@update', 'as' => 'details.update']);
	//Coordinator Applicantions
	Route::get('applications', ['uses' => 'CoordinatorApplicantsController@index', 'as' => 'applications.index']);
	//Coordinator Dashboard
	Route::get('dashboard', ['uses' => 'CoordinatorIndexController@index', 'as' => 'coordinator.index']);
});
// Admin Route List
Route::group(['prefix' => 'admin/'], function () {
	//Admin DataTable
	Route::get('users/data', ['uses' => 'AdminMAccountController@data', 'as' => 'users.data']);
	Route::get('budget-type/data', ['uses' => 'AdminMBudgtypeController@data', 'as' => 'budgtype.data']);
	Route::get('grade/data', ['uses' => 'AdminMGradeController@data', 'as' => 'grade.data']);
	Route::get('requirements/data', ['uses' => 'AdminMRequirementsController@data', 'as' => 'requirements.data']);
	Route::get('year/data', ['uses' => 'AdminMYearController@data', 'as' => 'year.data']);
	Route::get('sem/data', ['uses' => 'AdminMSemController@data', 'as' => 'sem.data']);
	Route::get('batch/data', ['uses' => 'AdminMBatchController@data', 'as' => 'batch.data']);
	Route::get('councilor/data', ['uses' => 'AdminMCouncilorController@data', 'as' => 'councilor.data']);
	Route::get('course/data', ['uses' => 'AdminMCourseController@data', 'as' => 'course.data']);
	Route::get('barangay/data', ['uses' => 'AdminMBarangayController@data', 'as' => 'barangay.data']);
	Route::get('school/data', ['uses' => 'AdminMSchoolController@data', 'as' => 'school.data']);
	Route::get('district/data', ['uses' => 'AdminMDistrictController@data', 'as' => 'district.data']);
	//Admin Checkbox Route List
	Route::put('users/checkbox/{id}', ['uses' => 'AdminMAccountController@checkbox', 'as' => 'users.checkbox']);
	Route::put('budget-type/checkbox/{id}', ['uses' => 'AdminMBudgtypeController@checkbox', 'as' => 'budgtype.checkbox']);
	Route::put('grade/checkbox/{id}', ['uses' => 'AdminMGradeController@checkbox', 'as' => 'grade.checkbox']);
	Route::put('sem/checkbox/{id}', ['uses' => 'AdminMSemController@checkbox', 'as' => 'sem.checkbox']);
	Route::put('year/checkbox/{id}', ['uses' => 'AdminMYearController@checkbox', 'as' => 'year.checkbox']);
	Route::put('requirements/checkbox/{id}', ['uses' => 'AdminMRequirementsController@checkbox', 'as' => 'requirements.checkbox']);
	Route::put('district/checkbox/{id}', ['uses' => 'AdminMDistrictController@checkbox', 'as' => 'district.checkbox']);
	Route::put('batch/checkbox/{id}', ['uses' => 'AdminMBatchController@checkbox', 'as' => 'batch.checkbox']);
	Route::put('school/checkbox/{id}', ['uses' => 'AdminMSchoolController@checkbox', 'as' => 'school.checkbox']);
	Route::put('barangay/checkbox/{id}', ['uses' => 'AdminMBarangayController@checkbox', 'as' => 'barangay.checkbox']);
	Route::put('course/checkbox/{id}', ['uses' => 'AdminMCourseController@checkbox', 'as' => 'course.checkbox']);
	Route::put('councilor/checkbox/{id}', ['uses' => 'AdminMCouncilorController@checkbox', 'as' => 'councilor.checkbox']);
	//Admin Utilities
	Route::resource('utilities', 'AdminUtilitiesController');
	//Admin Profile
	Route::get('profile', ['uses' => 'AdminProfileController@index', 'as' => 'adminprofile.index']);
	Route::post('name', ['uses' => 'AdminProfileController@name', 'as' => 'adminname.store']);
	Route::post('email', ['uses' => 'AdminProfileController@email', 'as' => 'adminemail.store']);
	Route::post('contact', ['uses' => 'AdminProfileController@contact', 'as' => 'admincontact.store']);
	Route::post('password', ['uses' => 'AdminProfileController@password', 'as' => 'adminpassword.store']);
	Route::post('image', ['uses' => 'AdminProfileController@image', 'as' => 'adminimage.store']);
	//Admin User Accounts
	Route::get('users', ['uses' => 'AdminMAccountController@index', 'as' => 'users.index']);
	Route::delete('users/{id}', ['uses' => 'AdminMAccountController@destroy', 'as' => 'users.destroy']);
	//Admin Budget Type
	Route::get('budget-type', ['uses' => 'AdminMBudgtypeController@index', 'as' => 'budgtype.index']);
	Route::post('budget-type', ['uses' => 'AdminMBudgtypeController@store', 'as' => 'budgtype.store']);
	Route::get('budget-type/{id}/edit ', ['uses' => 'AdminMBudgtypeController@edit', 'as' => 'budgtype.edit']);
	Route::put('budget-type/{id}', ['uses' => 'AdminMBudgtypeController@update', 'as' => 'budgtype.update']);
	Route::delete('budget-type/{id}', ['uses' => 'AdminMBudgtypeController@destroy', 'as' => 'budgtype.destroy']);
	//Admin Steps
	Route::get('requirements', ['uses' => 'AdminMRequirementsController@index', 'as' => 'requirements.index']);
	Route::post('requirements', ['uses' => 'AdminMRequirementsController@store', 'as' => 'requirements.store']);
	Route::get('requirements/{id}/edit ', ['uses' => 'AdminMRequirementsController@edit', 'as' => 'requirements.edit']);
	Route::put('requirements/{id}', ['uses' => 'AdminMRequirementsController@update', 'as' => 'requirements.update']);
	Route::delete('requirements/{id}', ['uses' => 'AdminMRequirementsController@destroy', 'as' => 'requirements.destroy']);
	//Admin Batch
	Route::get('batch', ['uses' => 'AdminMBatchController@index', 'as' => 'batch.index']);
	Route::post('batch', ['uses' => 'AdminMBatchController@store', 'as' => 'batch.store']);
	Route::get('batch/{id}/edit ', ['uses' => 'AdminMBatchController@edit', 'as' => 'batch.edit']);
	Route::put('batch/{id}', ['uses' => 'AdminMBatchController@update', 'as' => 'batch.update']);
	Route::delete('batch/{id}', ['uses' => 'AdminMBatchController@destroy', 'as' => 'batch.destroy']);
	//Admin Course
	Route::get('course', ['uses' => 'AdminMCourseController@index', 'as' => 'course.index']);
	Route::post('course', ['uses' => 'AdminMCourseController@store', 'as' => 'course.store']);
	Route::get('course/{id}/edit ', ['uses' => 'AdminMCourseController@edit', 'as' => 'course.edit']);
	Route::put('course/{id}', ['uses' => 'AdminMCourseController@update', 'as' => 'course.update']);
	Route::delete('course/{id}', ['uses' => 'AdminMCourseController@destroy', 'as' => 'course.destroy']);
	//Admin School
	Route::get('school', ['uses' => 'AdminMSchoolController@index', 'as' => 'school.index']);
	Route::post('school', ['uses' => 'AdminMSchoolController@store', 'as' => 'school.store']);
	Route::get('school/{id}/edit ', ['uses' => 'AdminMSchoolController@edit', 'as' => 'school.edit']);
	Route::put('school/{id}', ['uses' => 'AdminMSchoolController@update', 'as' => 'school.update']);
	Route::delete('school/{id}', ['uses' => 'AdminMSchoolController@destroy', 'as' => 'school.destroy']);
	//Admin Academic Grade
	Route::get('grade', ['uses' => 'AdminMGradeController@index', 'as' => 'grade.index']);
	Route::get('grade/create', ['uses' => 'AdminMGradeController@create', 'as' => 'grade.create']);
	Route::post('grade', ['uses' => 'AdminMGradeController@store', 'as' => 'grade.store']);
	Route::get('grade/{id}', ['uses' => 'AdminMGradeController@show', 'as' => 'grade.show']);
	Route::get('grade/{id}/edit', ['uses' => 'AdminMGradeController@edit', 'as' => 'grade.edit']);
	Route::put('grade/{id}', ['uses' => 'AdminMGradeController@update', 'as' => 'grade.update']);
	Route::delete('grade/{id}', ['uses' => 'AdminMGradeController@destroy', 'as' => 'grade.destroy']);
	//Admin Councilor
	Route::get('councilor', ['uses' => 'AdminMCouncilorController@index', 'as' => 'councilor.index']);
	Route::post('councilor', ['uses' => 'AdminMCouncilorController@store', 'as' => 'councilor.store']);
	Route::get('councilor/{id} ', ['uses' => 'AdminMCouncilorController@show', 'as' => 'councilor.show']);
	Route::get('councilor/{id}/edit ', ['uses' => 'AdminMCouncilorController@edit', 'as' => 'councilor.edit']);
	Route::post('councilor/{id}', ['uses' => 'AdminMCouncilorController@update', 'as' => 'councilor.update']);
	Route::delete('councilor/{id}', ['uses' => 'AdminMCouncilorController@destroy', 'as' => 'councilor.destroy']);
	//Admin Barangay
	Route::get('barangay', ['uses' => 'AdminMBarangayController@index', 'as' => 'barangay.index']);
	Route::post('barangay', ['uses' => 'AdminMBarangayController@store', 'as' => 'barangay.store']);
	Route::get('barangay/{id}/edit ', ['uses' => 'AdminMBarangayController@edit', 'as' => 'barangay.edit']);
	Route::put('barangay/{id}', ['uses' => 'AdminMBarangayController@update', 'as' => 'barangay.update']);
	Route::delete('barangay/{id}', ['uses' => 'AdminMBarangayController@destroy', 'as' => 'barangay.destroy']);
	//Admin District
	Route::get('district', ['uses' => 'AdminMDistrictController@index', 'as' => 'district.index']);
	Route::post('district', ['uses' => 'AdminMDistrictController@store', 'as' => 'district.store']);
	Route::get('district/{id}/edit ', ['uses' => 'AdminMDistrictController@edit', 'as' => 'district.edit']);
	Route::put('district/{id}', ['uses' => 'AdminMDistrictController@update', 'as' => 'district.update']);
	Route::delete('district/{id}', ['uses' => 'AdminMDistrictController@destroy', 'as' => 'district.destroy']);
	//Admin Dashboard
	Route::get('dashboard', ['uses' => 'AdminIndexController@index', 'as' => 'admin.index']);
});
//SMS Route List
Route::get('apply', ['uses' => 'SMSAccountApplyController@index', 'as' => 'apply.index']);
Route::post('apply', ['uses' => 'SMSAccountApplyController@store', 'as' => 'apply.store']);
Route::get('apply/{id}', ['uses' => 'SMSAccountApplyController@show', 'as' => 'apply.show']);
Route::get('how-to-apply', ['uses' => 'SMSHowToApplyController@index', 'as' => 'how.index']);
Route::get('/', ['uses' => 'SMSIndexController@index', 'as' => 'sms.index']);
//Authentication Route
Auth::routes();
