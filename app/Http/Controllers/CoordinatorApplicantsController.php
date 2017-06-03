<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Studentsteps;
use App\User;
use DB;
use App\Connection;
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
        $connections = Connection::join('users','connections.user_id','users.id')
        ->join('councilors','connections.councilor_id','councilors.id')
        ->select('councilors.id')
        ->where('connections.user_id',Auth::id())
        ->first();
        $users = User::join('student_details','users.id','student_details.user_id')
        ->join('connections','users.id','connections.user_id')
        ->select('users.*','student_details.*')
        ->where('student_details.application_status','Pending')
        ->where('connections.councilor_id',$connections->id)
        ->where('users.type','Student')
        ->get();
        return view('SMS.Coordinator.Scholar.CoordinatorApplicants')->withUsers($users);
    }
}
