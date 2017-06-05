<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use App\User;
use Auth;
use DB;
use App\District;
use App\Councilor;
use App\Barangay;
use App\Course;
use App\School;
use App\Batch;
use App\Connection;
use App\Achievement;
use Response;
use Carbon\Carbon;
class CoordinatorAchievementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function index()
    {
        $district = District::where('is_active',1)->get();
        $councilor = Councilor::where('is_active',1)->get();
        $barangay = Barangay::where('is_active',1)->get();
        $school = School::where('is_active',1)->get();
        $course = Course::where('is_active',1)->get();
        $batch = Batch::where('is_active',1)->get();
        return view('SMS.Coordinator.Scholar.CoordinatorAchievements')->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withBatch($batch);
    }
    public function store(Request $request)
    {
        $connections = Connection::join('users','user_councilor.user_id','users.id')
        ->join('councilors','user_councilor.councilor_id','councilors.id')
        ->select('councilors.id')
        ->where('user_councilor.user_id',Auth::id())
        ->first();
        $users = User::join('achievements','users.id','achievements.user_id')
        ->join('user_councilor','users.id','user_councilor.user_id')
        ->join('student_details','users.id','student_details.user_id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',IFNULL(users.middle_name,'')) as strStudName"),'users.*','student_details.*','achievements.*'])
        ->where('user_councilor.councilor_id',$connections->id)
        ->where('achievements.status','Pending')
        ->where('users.type','Student')
        ->get();
        $datatables = Datatables::of($users)
        ->addColumn('action', function ($data) {
            return "<div id=dp$data->id><button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-file-pdf-o'></i> PDF</button> <button class='btn btn-success btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-check'></i> Accept</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Decline</button></div>";
        })
        ->editColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->editColumn('date_held', function ($data) {
            return $data->date_held ? with(new Carbon($data->date_held))->format('M d, Y - h:i A ') : '';
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['strStudName','action']);
        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('strStudName', 'whereRaw', "CONCAT(users.last_name
                ,', ',users.first_name,' ',IFNULL(users.middle_name,'')) like ? ", ["%$keyword%"]);
        }
        return $datatables->make(true);
    }
    public function edit($id)
    {
        try {
            $achievement = Achievement::findorfail($id);
            $achievement->status = "Pending";
            $achievement->save();
            return Response::json($achievement);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $achievement = Achievement::findorfail($id);
            $achievement->status = "Accepted";
            $achievement->save();
            return Response::json($achievement);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function destroy($id)
    {
        try {
            $achievement = Achievement::findorfail($id);
            $achievement->status = "Declined";
            $achievement->save();
            return Response::json($achievement);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
}
