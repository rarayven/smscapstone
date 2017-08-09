<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Application;
use App\Familydata;
use App\Educback;
use App\Desiredcourses;
use App\Affiliation;
use App\Siblings;
use Carbon\Carbon;
use App\User;
use Session;
use App\GradingDetail;
use App\Budget;
use Auth;
use App\Grade;
class CoordinatorApplicantsDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function show($id)
    {
        try {
            $application = Application::join('users','student_details.user_id','users.id')
            ->join('user_councilor','student_details.user_id','user_councilor.user_id')
            ->join('districts','student_details.district_id','districts.id')
            ->join('barangay','student_details.barangay_id','barangay.id')
            ->join('schools','student_details.school_id','schools.id')
            ->join('courses','student_details.course_id','courses.id')
            ->select('users.*','student_details.*','districts.description as districts_description','barangay.description as barangay_description','schools.description as schools_description','courses.description as courses_description')
            ->where('student_details.user_id',$id)
            ->where('user_councilor.councilor_id', function($query){
                $query->from('user_councilor')
                ->join('users','user_councilor.user_id','users.id')
                ->join('councilors','user_councilor.councilor_id','councilors.id')
                ->select('councilors.id')
                ->where('users.id',Auth::id())
                ->first();
            })
            ->where('student_details.application_status','Pending')
            ->firstorfail();
            $count = Affiliation::where('student_detail_user_id',$id)->count();
            $affiliation = Affiliation::where('student_detail_user_id',$id)->get();
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
            $grades = Grade::join('grade_details','grades.id','grade_details.grade_id')
            ->select('grade_details.*','grades.*', 'grades.id as grade_id')
            ->where('grades.student_detail_user_id',$id)
            ->count();
            $grade = '';
            $grading = '';
            if ($grades!=0) {
                $grade = Grade::join('grade_details','grades.id','grade_details.grade_id')
                ->select('grade_details.*','grades.*', 'grades.id as grade_id')
                ->where('grades.student_detail_user_id',$id)
                ->get();
                $grading = GradingDetail::where('grading_id',$grade[0]->grading_id)->get();
            }
            return view('SMS.Coordinator.Scholar.CoordinatorApplicantsDetails')->withApplication($application)->withMother($mother)->withFather($father)->withDesiredcourses($desiredcourses)->withElem($elem)->withHs($hs)->withSiblings($siblings)->withExist($exist)->withCount($count)->withAffiliation($affiliation)->withGrade($grade)->withGrading($grading)->withGrades($grades);
        } catch(\Exception $e) {
            dd($e->getMessage());
            return redirect(route('applications.index'));
        }
    }
    public function edit($id)
    {
        try {
            $notexist = Application::where('user_id',$id)
            ->whereNotIn('application_status',['Pending','Declined'])
            ->firstorfail();
            Session::flash('fail','Student Already Accepted');
            return redirect(route('applications.index'));
        } catch(\Exception $e) {
            $budget = Budget::where('user_id',Auth::id())
            ->latest('id')->first();
            if ($budget != null) {
                $application = Application::join('users','student_details.user_id','users.id')
                ->join('user_councilor','users.id','user_councilor.user_id')
                ->where('users.type','Student')
                ->where('user_councilor.councilor_id', function($query){
                    $query->from('user_councilor')
                    ->join('users','user_councilor.user_id','users.id')
                    ->join('councilors','user_councilor.councilor_id','councilors.id')
                    ->select('councilors.id')
                    ->where('user_councilor.user_id',Auth::id())
                    ->first();
                })
                ->where('student_details.application_status','Accepted')
                ->where('student_status','Continuing')
                ->count();
                if (($budget->slot_count - $application) == 0) {
                    Session::flash('fail','No available slot');
                    return redirect(route('applications.index'));
                }
                $application = Application::find($id);
                $application->application_status = 'Accepted';
                $application->save();
                $user = User::find($id);
                $user->is_active = 1;
                $user->save();
                Session::flash('success','Student Accepted');
                return redirect(route('applications.index'));
            } else {
                Session::flash('fail','No available slot');
                return redirect(route('applications.index'));
            }
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $notexist = Application::where('user_id',$id)
            ->whereNotIn('application_status',['Pending','Accepted'])
            ->firstorfail();
            Session::flash('fail','Student Already Declined');
            return redirect(route('applications.index'));
        } catch(\Exception $e) {
            $application = Application::find($id);
            $application->remarks=$request->strApplRemarks;
            $application->application_status='Declined';
            $application->save();
            $user = User::find($id);
            $user->is_active = 0;
            $user->save();
            Session::flash('success','Student Declined');
            return redirect(route('applications.index'));
        }
    }
}
