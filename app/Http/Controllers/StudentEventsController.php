<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Connection;
use Auth;
use Response;
class StudentEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function index()
    {
        $connect = Connection::join('users','user_councilor.user_id','users.id')
        ->select('user_councilor.councilor_id')
        ->where('user_councilor.user_id',Auth::id())
        ->first();
        $connection = Connection::join('users','user_councilor.user_id','users.id')
        ->join('councilors','user_councilor.councilor_id','councilors.id')
        ->select('users.id')
        ->where('users.type', 'Coordinator')
        ->where('user_councilor.councilor_id',$connect->councilor_id)
        ->where('users.is_deleted',0)
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
}
