<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use App\User;
use Auth;
use DB;
use App\Connection;
use App\District;
use App\Councilor;
use App\Barangay;
use App\Course;
use App\School;
use App\Batch;
use App\Achievement;
use App\Message;
use App\Receiver;
use Response;
use Carbon\Carbon;
class CoordinatorTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    public function messages(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $dtm = Carbon::now('Asia/Manila');
            $message = new Message;
            $message->user_id = Auth::id();
            $message->title = $request->title;
            $message->description = $request->description;
            $message->date_created = $dtm;
            $message->save();
            $receiver = new Receiver;
            $receiver->message_id = $message->id;
            $receiver->user_id = $request->id;
            $receiver->save();
            DB::commit();
            return Response::json($message);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            dd($e);
            return dd($e->errorInfo[2]);
        }

    }
    public function index()
    {
        $district = District::where('is_active',1)->get();
        $councilor = Councilor::where('is_active',1)->get();
        $barangay = Barangay::where('is_active',1)->get();
        $school = School::where('is_active',1)->get();
        $course = Course::where('is_active',1)->get();
        $batch = Batch::where('is_active',1)->get();
        return view('SMS.Coordinator.Scholar.CoordinatorToken')->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withBatch($batch);
    }
    public function store(Request $request)
    {
        $connections = Connection::join('users','connections.user_id','users.id')
        ->join('councilors','connections.councilor_id','councilors.id')
        ->select('councilors.id')
        ->where('connections.user_id',Auth::id())
        ->first();
        $users = User::join('achievements','users.id','achievements.user_id')
        ->join('connections','users.id','connections.user_id')
        ->join('student_details','users.id','student_details.user_id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'users.*','student_details.*','achievements.*','users.id as user_id'])
        ->where('connections.councilor_id',$connections->id)
        ->where('users.type','Student')
        ->where('achievements.status','Accepted')
        ->get();
        $datatables = Datatables::of($users)
        ->addColumn('action', function ($data) {
            return "<div id=dp$data->user_id><button class='btn btn-info btn-xs btn-view' value='$data->user_id'><i class='fa fa-file-pdf-o'></i> PDF</button> <button class='btn btn-primary btn-xs btn-view' value='$data->user_id'><i class='fa fa-envelope'></i> Message</button> <button class='btn btn-success btn-xs btn-detail open-modal' value='$data->user_id'><i class='fa fa-share'></i> Receive</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->user_id'><i class='fa fa-remove'></i> Cancel</button></div>";
        })
        ->editColumn('date_held', function ($data) {
            return $data->date_held ? with(new Carbon($data->date_held))->format('M d, Y - h:i A ') : '';
        })
        ->editColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['strStudName','action']);
        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('user_id', 'where', 'like', "$keyword%");
            $datatables->filterColumn('strStudName', 'whereRaw', "CONCAT(users.last_name
                ,', ',users.first_name,' ',users.middle_name) like ? ", ["%$keyword%"]);
        }
        return $datatables->make(true);
    }
    public function edit($id)
    {
        try
        {
            $achievement = Achievement::findorfail($id);
            $achievement->token_process = "Pending";
            $achievement->save();
            return Response::json($achievement);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        try
        {
            $achievement = Achievement::findorfail($id);
            $achievement->token_process = "Received";
            $achievement->save();
            return Response::json($achievement);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
    public function destroy($id)
    {
        try
        {
            $achievement = Achievement::findorfail($id);
            $achievement->token_process = "Cancelled";
            $achievement->save();
            return Response::json($achievement);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
}
