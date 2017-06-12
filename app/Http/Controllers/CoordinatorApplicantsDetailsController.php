<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Application;
use App\Familydata;
use App\Educback;
use App\Desiredcourses;
use App\Studentsteps;
use App\Current;
use App\Step;
use App\Connection;
use App\Siblings;
use App\User;
use App\Councilor;
use Carbon\Carbon;
use Session;
use Auth;
use Config;
class CoordinatorApplicantsDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function index()
    {
        return redirect(route('applicants.index'));
    }
    public function show($id)
    {
        try {
            $councilor = Connection::join('users','user_councilor.user_id','users.id')
            ->join('councilors','user_councilor.councilor_id','councilors.id')
            ->select('councilors.*')
            ->where('users.id',Auth::id())
            ->firstorfail();
            $application = Application::join('users','student_details.user_id','users.id')
            ->join('user_councilor','student_details.user_id','user_councilor.user_id')
            ->join('districts','student_details.district_id','districts.id')
            ->join('barangay','student_details.barangay_id','barangay.id')
            ->select('users.*','student_details.*','districts.description as districts_description','barangay.description as barangay_description')
            ->where('student_details.user_id',$id)
            ->where('user_councilor.councilor_id',$councilor->id)
            ->where('student_details.application_status','Pending')->firstorfail();
            $currschool = Current::where('student_detail_user_id',$id)->count();
            $getschool = Current::join('schools','current_colleges.school_id','schools.id')
            ->join('courses','current_colleges.course_id','courses.id')
            ->select('current_colleges.*','courses.description as courses_description','schools.description as schools_description')
            ->where('student_detail_user_id',$id)->first();
            $exist = Siblings::where('student_detail_user_id',$id)->count();
            $siblings = Siblings::where('student_detail_user_id',$id)->first();
            $mother = Familydata::where('student_detail_user_id',$id)
            ->where('member_type',0)->first();
            $father = Familydata::where('student_detail_user_id',$id)
            ->where('member_type',1)->first();
            $elem = Educback::where('student_detail_user_id',$id)
            ->where('level',0)->first();
            $hs = Educback::where('student_detail_user_id',$id)
            ->where('level',1)->first();
            $desiredcourses = Desiredcourses::join('courses','desired_courses.course_id','courses.id')
            ->join('schools','desired_courses.school_id','schools.id')
            ->select('desired_courses.*','schools.description as schools_description','courses.description as courses_description')
            ->where('desired_courses.student_detail_user_id',$id)
            ->get();
            return view('SMS.Coordinator.Scholar.CoordinatorApplicantsDetails')->withApplication($application)->withMother($mother)->withFather($father)->withDesiredcourses($desiredcourses)->withElem($elem)->withHs($hs)->withSiblings($siblings)->withExist($exist)->withCurrschool($currschool)->withGetschool($getschool)->withCouncilor($councilor);
        } catch(\Exception $e) {
            return redirect(route('applicants.index'));
        }
    }
    public function edit($id)
    {
        try {
            $notexist = Studentsteps::findorfail($id);
            Session::flash('fail','Student Already Accepted');
            return redirect(route('applicants.index'));
        } catch(\Exception $e) {
            DB::beginTransaction();
            try {
                $current = Carbon::now(Config::get('app.timezone'));
                $application = Application::find($id);
                $application->application_status='Accepted';
                $application->save();
                $steps = Step::where('order',1)->first();
                $intStepID = $steps->id;
                $studentsteps = new Studentsteps;
                $studentsteps->user_id=$id;
                $studentsteps->step_id=$intStepID;
                $studentsteps->completion_date=$current;
                $studentsteps->save();
                $user = User::find($id);
                $user->is_active = 1;
                $user->save();
                DB::commit();
                Session::flash('success','Student Accepted');
                return redirect(route('applicants.index'));
            } catch(\Exception $e) {
                DB::rollBack();
                return dd('steps null');
            }
        }
    }
    public function update(Request $request, $id)
    {
        $application = Application::find($id);
        $application->remarks=$request->strApplRemarks;
        $application->application_status='Declined';
        $application->save();
        Session::flash('success','Student Declined');
        return redirect(route('applicants.index'));
    }
}
