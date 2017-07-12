<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Studentsteps;
use App\Application;
use DB;
use Auth;
use Datatables;
use Carbon\Carbon;
class CoordinatorApplicantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function data()
    {
        $users = Application::join('users','users.id','student_details.user_id')
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
        ->where('users.type','Student');
        return Datatables::of($users)
        ->editColumn('strUserName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->addColumn('action', function ($data) {
            return "<a href=".route('details.show',$data->id)."><button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button></a>";
        })
        ->editColumn('application_date', function ($data) {
            return $data->application_date ? with(new Carbon($data->application_date))->format('M d, Y - h:i A') : '';
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['action','strUserName'])
        ->make(true);
    }
    public function index()
    {
        return view('SMS.Coordinator.Scholar.CoordinatorApplicants');
    }
}
