<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Councilor;
use App\District;
use App\Barangay;
use App\School;
use DB;
use App\Batch;
use App\Course;
use Response;
use App\Application;
use App\Familydata;
use App\Educback;
use App\Siblings;
use App\Desiredcourses;
use Carbon\Carbon;
use App\Academicgrade;
use App\Current;
use App\Year;
use App\Semester;
use Image;
use App\Connection;
use App\Grade;
use Auth;
use Hash;
use Config;
class SMSAccountApplyController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
  }
  public function index()
  {
    $district = District::where('is_active',1)->get();
    $councilor = Councilor::where('is_active',1)->get();
    $barangay = Barangay::where('is_active',1)->get();
    $school = School::where('is_active',1)->get();
    $course = Course::where('is_active',1)->get();
    $grade = Academicgrade::where('is_active',1)->get();
    $year = Year::where('is_active',1)->get();
    $sem = Semester::where('is_active',1)->get();
    return view('SMS.Account.SMSAccountApply')->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withGrade($grade)->withYear($year)->withSem($sem);
  }
  public function store(Request $request)
  {
    $this->validate($request, Application::$storeRule);
    DB::beginTransaction();
    try {
      $randompassword = Hash::make('password');
      $dtm = Carbon::now(Config::get('app.timezone'));
      $date = $request->datPersDOB;
      $dob = Carbon::createFromFormat('Y-m-d', $date);
      //Image Upload
      $image = $request->file('strApplPicture');
      $imagename = md5($request->strUserEmail. time()).'.'.$image->getClientOriginalExtension();
      $location = public_path('images/'.$imagename);
      //PDF Upload
      $pdf = $request->file('strApplGrades');
      $pdfname = md5($request->strUserEmail. time()).'.'.$pdf->getClientOriginalExtension();
      //Insert in users
      $users = new User;
      $users->type='Student';
      $users->first_name=$request->strUserFirstName;
      $users->middle_name=$request->strUserMiddleName;
      $users->last_name=$request->strUserLastName;
      $users->email=$request->strUserEmail;
      $users->password=$randompassword;
      $users->cell_no=$request->strUserCell;
      $users->picture=$imagename;
      $users->save();
      //Insert in user_councilor
      $connections = new Connection;
      $connections->user_id = $users->id;
      $connections->councilor_id = $request->intCounID;
      $connections->save();
      //Get Max of batches
      $batch = Batch::where('is_active',1)->max('id');
      //Insert in student_details
      $application = new Application;
      $application->user_id=$users->id;
      $application->house_no=$request->strApplHouseNo;
      $application->street=$request->strPersStreet;
      $application->barangay_id=$request->intBaraID;
      $application->district_id=$request->intDistID;
      $application->birthday=$dob;
      $application->birthplace=$request->strPersPOB;
      $application->religion=$request->strPersReligion;
      $application->gender=$request->PersGender;
      $application->brothers=$request->intPersBrothers;
      $application->sisters=$request->intPersSisters;
      $application->batch_id=$batch;
      $application->application_date=$dtm;
      $application->first_essay=$request->strPersEssay;
      $application->second_essay=$request->strPersEssay2;
      $application->organization=$request->strPersOrganization;
      $application->position=$request->strPersPosition;
      $application->participation_date=$request->strPersDateParticipation;
      $application->save();
      //Insert in family_data
      $familydata = new Familydata;
      $familydata->student_detail_user_id=$users->id;
      $familydata->last_name=$request->motherlname;
      $familydata->first_name=$request->motherfname;
      $familydata->citizenship=$request->mothercitizen;
      $familydata->highest_ed=$request->motherhea;
      $familydata->occupation=$request->motheroccupation;
      $familydata->monthly_income=$request->motherincome;
      $familydata->member_type=0;
      $familydata->save();
      $familydata = new Familydata;
      $familydata->student_detail_user_id=$users->id;
      $familydata->last_name=$request->fatherlname;
      $familydata->first_name=$request->fatherfname;
      $familydata->citizenship=$request->fathercitizen;
      $familydata->highest_ed=$request->fatherhea;
      $familydata->occupation=$request->fatheroccupation;
      $familydata->monthly_income=$request->fatherincome;
      $familydata->member_type=1;
      $familydata->save();
      //Insert in educational_backgrounds
      $educback = new Educback;
      $educback->student_detail_user_id=$users->id;
      $educback->level=0;
      $educback->school_name=$request->elemschool;
      $educback->date_enrolled=$request->elemenrolled;
      $educback->date_graduated=$request->elemgrad;
      $educback->awards=$request->elemhonors;
      $educback->save();
      $educback = new Educback;
      $educback->student_detail_user_id=$users->id;
      $educback->level=1;
      $educback->school_name=$request->hschool;
      $educback->date_enrolled=$request->hsenrolled;
      $educback->date_graduated=$request->hsgrad;
      $educback->awards=$request->hshonor;
      $educback->save();
      if((($request->strSiblFirstName)!='')&&(($request->strSiblLastName)!='')&&(($request->strSiblDateFrom)!='')&&(($request->strSiblDateTo)!='')){
        //Insert in siblings
        $siblings = new Siblings;
        $siblings->student_detail_user_id=$users->id; 
        $siblings->first_name=$request->strSiblFirstName;
        $siblings->last_name=$request->strSiblLastName;
        $siblings->date_from=$request->strSiblDateFrom;
        $siblings->date_to=$request->strSiblDateTo;
        $siblings->save();
      }
      //Insert in desired_courses
      $desiredcourses = new Desiredcourses;
      $desiredcourses->student_detail_user_id=$users->id;
      $desiredcourses->school_id=$request->school1;
      $desiredcourses->course_id=$request->course1;
      $desiredcourses->save();
      $desiredcourses = new Desiredcourses;
      $desiredcourses->student_detail_user_id=$users->id;
      $desiredcourses->school_id=$request->school2;
      $desiredcourses->course_id=$request->course2;
      $desiredcourses->save();
      $desiredcourses = new Desiredcourses;
      $desiredcourses->student_detail_user_id=$users->id;
      $desiredcourses->school_id=$request->school3;
      $desiredcourses->course_id=$request->course3;
      $desiredcourses->save();
      if((($request->intPersCurrentSchool)!='')&&(($request->intPersCurrentCourse)!='')&&(($request->strPersGwa)!='')&&(($request->intYearID)!='')&&(($request->intSemID)!='')){
        //Insert in current colleges
        $current = new Current;
        $current->student_detail_user_id=$users->id;
        $current->school_id=$request->intPersCurrentSchool;
        $current->course_id=$request->intPersCurrentCourse;
        $current->gwa=$request->strPersGwa;
        $current->save();
        //Insert in grades
        $scholargrade = new Grade;
        $scholargrade->student_detail_user_id=$users->id;
        $scholargrade->year_id=$request->intYearID;
        $scholargrade->semester_id=$request->intSemID;
        $scholargrade->pdf=$pdfname;
        $scholargrade->save();
      }
      //Actual Upload
      Image::make($image)->resize(400,400)->save($location);
      $pdf->move(base_path().'/public/docs/', $pdfname);
      DB::commit();
      return redirect('/');
    } catch(\Exception $e) {
      DB::rollBack();
      return dd($e->getMessage());
    }  
  }
  public function show($id)
  {
    $query = District::join('barangay', 'districts.id', 'barangay.district_id')
    ->select('barangay.*')
    ->where('barangay.district_id',$id)
    ->where('districts.id',$id)
    ->where('barangay.is_active',1)
    ->get();
    return Response::json($query);
  }
  public function edit($id)
  {
    $query = District::join('councilors', 'districts.id', 'councilors.district_id')
    ->select('councilors.*')
    ->where('councilors.district_id',$id)
    ->where('districts.id',$id)
    ->where('councilors.is_active',1)
    ->get();
    return Response::json($query);
  }
  public function update($id)
  {
    $grade = Academicgrade::find($id);
    return Response::json($grade);
  }
  public function destroy($id)
  {
    $grade = Academicgrade::join('schools','schools.academic_grading_id','academic_gradings.id')
    ->select('academic_gradings.*')
    ->where('schools.id',$id)
    ->first();
    return Response::json($grade);
  }
}
