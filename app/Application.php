<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Application extends Model
{
	protected $table = 'student_details';
	protected $primaryKey = 'user_id';
	public $timestamps = false;
	protected $dates = ['birthday'];
	public static $storeRule = [
	'strUserFirstName' => 'required|max:25|unique_with:users, strUserMiddleName = middle_name, strUserLastName = last_name, strUserFirstName = first_name',
	'strUserMiddleName' => 'nullable|max:25',
	'strUserLastName' => 'required|max:25',
	'strUserEmail' => 'required|email|max:30|unique:users,email',
	'strUserCell' => 'required|max:15',
	'strApplPicture' => 'required|image',
	'datPersDOB' => 'required|date',
	'intCounID' => 'exists:councilors,id',
	'strApplHouseNo' => 'required|max:4',
	'strPersStreet' => 'required|max:25',
	'intBaraID' => 'exists:barangay,id',
	'intDistID' => 'exists:districts,id',
	'strPersPOB' => 'required|max:25',
	'strPersReligion' => 'required|max:50',
	'PersGender' => 'required',
	'intPersBrothers' => 'nullable|numeric',
	'intPersSisters' => 'nullable|numeric',
	'strPersEssay' => 'required|string',
	'strPersEssay2' => 'required|string',
	'strPersOrganization' => 'nullable|max:50',
	'strPersPosition' => 'nullable|max:25',
	'strPersDateParticipation' => 'nullable|max:4',
	'motherlname' => 'required|max:25',
	'motherfname' => 'required|max:25',
	'mothercitizen' => 'required|max:25',
	'motherhea' => 'required|max:25',
	'motheroccupation' => 'required|max:25',
	'motherincome' => 'required|max:20',
	'fatherlname' => 'required|max:25',
	'fatherfname' => 'required|max:25',
	'fathercitizen' => 'required|max:25',
	'fatherhea' => 'required|max:25',
	'fatheroccupation' => 'required|max:25',
	'fatherincome' => 'required|max:20',
	'elemschool' => 'required|max:50',
	'elemenrolled' => 'required|max:4',
	'elemgrad' => 'required|max:4',
	'elemhonors' => 'nullable|max:50',
	'hschool' => 'required|max:50',
	'hsenrolled' => 'required|max:4',
	'hsgrad' => 'required|max:4',
	'hshonor' => 'nullable|max:50',
	'strSiblFirstName' => 'max:25|required_with:strSiblLastName,strSiblDateFromar,strSiblDateTo',
	'strSiblLastName' => 'max:25',
	'strSiblDateFrom' => 'max:4',
	'strSiblDateTo' => 'max:4',
	'school1' => 'required',
	'course1' => 'required',
	'school2' => 'required',
	'course2' => 'required',
	'school3' => 'required',
	'course3' => 'required',
	'intPersCurrentSchool' => 'required_with:intPersCurrentCourse,strPersGwa,intYearID,intSemID',
	'strPersGwa' => 'max:4',
	'strApplGrades' => 'required|file',
	];
	public static $updateSiblings = [
	'intPersBrothers' => 'required|numeric',
	'intPersSisters' => 'required|numeric',
	];
	public static $updateBirthday = [
	'birthday' => 'required',
	];
}
