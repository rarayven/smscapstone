<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Studentsteps;
use App\User;
use DB;
use Auth;
class CoordinatorApplicantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function index()
    {
        $users = User::join('student_details','users.id','student_details.user_id')
        ->join('user_councilor','users.id','user_councilor.user_id')
        ->join('schools','student_details.school_id','schools.id')
        ->join('courses','student_details.course_id','courses.id')
        ->select('users.*','student_details.*','schools.description','courses.description as courses_description')
        ->where('student_details.application_status','Pending')
        ->where('user_councilor.councilor_id', function($query){
            $query->from('user_councilor')
            ->join('users','user_councilor.user_id','users.id')
            ->join('councilors','user_councilor.councilor_id','councilors.id')
            ->select('councilors.id')
            ->where('user_councilor.user_id',Auth::id())
            ->first();
        })
        ->where('users.type','Student')
        ->get();
        return view('SMS.Coordinator.Scholar.CoordinatorApplicants')->withUsers($users);
    }
}
