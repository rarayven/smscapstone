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
use App\Current;
use Image;
use App\Connection;
use App\Grade;
use Auth;
use Hash;
use Config;
use Session;
use App\GradeDetail;
use App\GradingDetail;
use App\Setting;
use App\Affiliation;
use App\Budget;
class SMSAccountApplyController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
  }
  public function index()
  {
    $now = Carbon::now(Config::get('app.timezone'));
    $low = Carbon::now(Config::get('app.timezone'))->subYears(20);
    $district = District::where('is_active',1)->get();
    $councilor = Councilor::where('is_active',1)->get();
    $barangay = Barangay::where('is_active',1)->get();
    $school = School::where('is_active',1)->get();
    $course = Course::where('is_active',1)->get();
    $setting = Setting::first();
    return view('SMS.Account.SMSAccountApply')->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withNow($now)->withLow($low)->withSetting($setting);
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
      $application->essay=$request->essay;
      $application->school_id=$request->intPersCurrentSchool;
      $application->course_id=$request->intPersCurrentCourse;
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
      //Insert in affiliations
      if ($request->strPersOrganization[0] != null && $request->strPersPosition[0] != null && $request->strPersDateParticipation[0] != null) {
        for ($i=0; $i < count($request->strPersOrganization); $i++) { 
          $affiliation = new Affiliation;
          $affiliation->student_detail_user_id=$users->id;
          $affiliation->organization=$request->strPersOrganization[$i];
          $affiliation->position=$request->strPersPosition[$i];
          $affiliation->participation_date=$request->strPersDateParticipation[$i];
          $affiliation->save();
        }
      }
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
      for ($i=0; $i < count($request->school); $i++) { 
        $desiredcourses = new Desiredcourses;
        $desiredcourses->student_detail_user_id=$users->id;
        $desiredcourses->school_id=$request->school[$i];
        $desiredcourses->course_id=$request->course[$i];
        $desiredcourses->save();
      }
      //Insert in grades
      $getAcademic = School::join('gradings','schools.grading_id','gradings.id')
      ->select('gradings.id')
      ->where('schools.id',$application->school_id)
      ->first();
      $scholargrade = new Grade;
      $scholargrade->student_detail_user_id=$users->id;
      if (($request->col)=='no') {        
        $scholargrade->year=$request->year;
        $scholargrade->semester=$request->semester;
      }
      $scholargrade->grading_id=$getAcademic->id;
      $scholargrade->pdf=$pdfname;
      $scholargrade->save();
      //Manual Input of Grades
      for ($i=0; $i < count($request->subject_description); $i++) { 
        if (($request->col)=='no') {
          $detail = new GradeDetail;
          $detail->grade_id=$scholargrade->id;
          $detail->description=$request->subject_description[$i];
          $detail->units=$request->units[$i];
          $detail->grade=$request->subject_grade[$i];
          $detail->save();
        }
      }
      //Actual Upload
      Image::make($image)->resize(400,400)->save($location);
      $pdf->move(base_path().'/public/docs/', $pdfname);
      DB::commit();
      Session::flash('success','Your application is submitted successfully. Please wait for confirmation through your email.');
      return redirect(route('sms.index'));
    } catch(\Exception $e) {
      DB::rollBack();
      return dd($e->getMessage());
    }  
  }
  public function show($id)
  {
    $district = District::join('councilors','districts.id','councilors.district_id')
    ->join('barangay','districts.id','barangay.district_id')
    ->where('councilors.is_active',1)
    ->where('barangay.id',$id)
    ->select('councilors.*',DB::raw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',IFNULL(councilors.middle_name,'')) as strCounName"),'districts.id as district_id')
    ->get();
    return Response::json($district);
  }
  public function getGrade($id)
  {
    $grading = GradingDetail::where('grading_id', function($query) use($id){
      $query->from('gradings')
      ->join('schools','gradings.id','schools.grading_id')
      ->select('gradings.id')
      ->where('schools.id',$id)
      ->first();
    })
    ->select('grade')
    ->orderBy('grade','desc')
    ->get();
    return Response::json($grading);
  }
  public function getCount($id)
  {
    $budget = Budget::where('councilor_id',$id)->latest('id')->first();
    $application = Application::join('users','student_details.user_id','users.id')
    ->join('user_councilor','users.id','user_councilor.user_id')
    ->where('users.type','Student')
    ->where('user_councilor.councilor_id', $id)
    ->where('student_details.application_status','Accepted')
    ->where('student_status','Continuing')
    ->count();
    $users = Application::join('users','users.id','student_details.user_id')
    ->join('user_councilor','users.id','user_councilor.user_id')
    ->where('user_councilor.councilor_id', $id)
    ->where('student_details.application_status','Pending')
    ->where('student_details.batch_id', function($query){
      $query->from('batches')
      ->select('id')
      ->latest('id')
      ->first();
    })
    ->where('users.type','Student')
    ->count();
    $counter = (object)['id' => $id, 'slot' => $application, 'max' => $budget->slot_count, 'queued' => $users];
    return Response::json($counter);
  }
}
