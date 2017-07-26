<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Application;
use Auth;
use App\GradingDetail;
use App\Grade;
use App\School;
use App\Course;
use App\Setting;
use DB;
use App\GradeDetail;
use App\Shift;
use Config;
use Carbon\Carbon;
class StudentRenewalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function index()
    {
        $grading = GradingDetail::where('grading_id', function($query){
            $query->from('schools')
            ->join('student_details','schools.id','student_details.school_id')
            ->join('gradings','schools.grading_id','gradings.id')
            ->select('schools.grading_id')
            ->where('student_details.user_id',Auth::id())
            ->first();
        })
        ->select('grade')
        ->orderBy('grade','desc')
        ->get();
        $grade = Grade::where('student_detail_user_id',Auth::id())
        ->select('grades.*')
        ->latest('id')
        ->first();
        $setting = Setting::first();
        if ($grade->semester=='I') {
            $grade->semester = 1;
            $grade->year = 1;
        }
        $grade->semester += 1;
        if ($grade->semester > $setting->semester_count) {
            $grade->semester = 1;
            $grade->year += 1;
        }
        $application = Application::join('schools','student_details.school_id','schools.id')
        ->join('courses','student_details.course_id','courses.id')
        ->select('student_details.*','schools.description as school_description','courses.description as course_description')
        ->where('student_details.user_id',Auth::id())
        ->first();
        $school = School::where('is_active',1)->get();
        $course = Course::where('is_active',1)->get();
        return view('SMS.Student.StudentRenewal')->withApplication($application)->withGrading($grading)->withGrade($grade)->withSchool($school)->withCourse($course);
    }
    public function store(Request $request)
    {
        //PDF Upload
        $pdf = $request->file('strApplGrades');
        $pdfname = md5(Auth::user()->email. time()).'.'.$pdf->getClientOriginalExtension();
        $school = School::join('student_details','schools.id','student_details.school_id')
        ->join('gradings','schools.grading_id','gradings.id')
        ->select('schools.grading_id')
        ->where('student_details.user_id',Auth::id())
        ->first();
        $grade = Grade::where('student_detail_user_id',Auth::id())
        ->select('grades.*')
        ->latest('id')
        ->first();
        $setting = Setting::first();
        $grade->semester += 1;
        if ($grade->semester > $setting->semester_count) {
            $grade->semester = 1;
            $grade->year += 1;
        }
        DB::beginTransaction();
        try {
            $grades = new Grade;
            $grades->student_detail_user_id = Auth::id();
            $grades->grading_id = $school->grading_id;
            $grades->year = $grade->year;
            $grades->semester = $grade->semester;
            $grades->pdf = $pdfname;
            $grades->save();
            //Manual Input of Grades
            for ($i=0; $i < count($request->subject_description); $i++) {
                $detail = new GradeDetail;
                $detail->grade_id=$grades->id;
                $detail->description=$request->subject_description[$i];
                $detail->units=$request->units[$i];
                $detail->grade=$request->subject_grade[$i];
                $detail->save();
            }
            if ($request->rad == 'yes') {
                $application = Application::find(Auth::id());
                $shift = new Shift;
                $shift->user_id = Auth::id();
                $shift->school_id = $application->school_id;
                $shift->course_id = $application->course_id;
                $shift->shift_date = Carbon::now(Config::get('app.timezone'));
                $shift->save();
                $application->school_id = $request->school_transfer;
                $application->course_id = $request->course_transfer;
                $application->save();
            }
            $pdf->move(base_path().'/public/docs/', $pdfname);
            DB::commit();
            return redirect(route('student.index'));
        } catch(\Exception $e) {
            DB::rollBack();
            return dd($e->getMessage());
        } 
    }
}
