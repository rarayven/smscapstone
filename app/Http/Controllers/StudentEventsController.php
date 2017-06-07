<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Connection;
use Auth;
use Response;
use Carbon\Carbon;
use Config;
class StudentEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function index()
    {
        $connect = Connection::where('user_id',Auth::id())
        ->select('councilor_id')
        ->first();
        $connection = Connection::join('users','user_councilor.user_id','users.id')
        ->join('councilors','user_councilor.councilor_id','councilors.id')
        ->select('users.id')
        ->where('users.type', 'Coordinator')
        ->where('user_councilor.councilor_id',$connect->councilor_id)
        ->where('users.is_active',1)
        ->first();
        $events = Event::where('user_id',$connection->id)
        ->whereIn('status',['Ongoing','Cancelled'])
        ->get();
        $done = Event::where('user_id',$connection->id)
        ->where('status','Done')
        ->get();
        return view('SMS.Student.StudentEvents')->withEvents($events)->withDone($done);
    }
    public function show($id)
    {
        try {
            $events = Event::find($id);
            return Response::json($events);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function upcome()
    {
        $connect = Connection::where('user_id',Auth::id())
        ->select('councilor_id')
        ->first();
        $connection = Connection::join('users','user_councilor.user_id','users.id')
        ->join('councilors','user_councilor.councilor_id','councilors.id')
        ->select('users.id')
        ->where('users.type', 'Coordinator')
        ->where('user_councilor.councilor_id',$connect->councilor_id)
        ->where('users.is_active',1)
        ->first();
        $events = Event::where('user_id',$connection->id)
        ->where('date_held','>',Carbon::now(Config::get('app.timezone')))
        ->where('status', 'Ongoing')
        ->count();
        return Response::json($events);
    }
}
