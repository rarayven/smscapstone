<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
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
        $events = Event::where('user_id', function($subquery){
            $subquery->from('user_councilor')
            ->join('users','user_councilor.user_id','users.id')
            ->join('councilors','user_councilor.councilor_id','councilors.id')
            ->select('users.id')
            ->where('users.type', 'Coordinator')
            ->where('user_councilor.councilor_id', function($query){
                $query->from('user_councilor')
                ->where('user_id',Auth::id())
                ->select('councilor_id')
                ->first();
            })
            ->where('users.is_active',1)
            ->first();
        })
        ->where('date_held','>=',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Ongoing','Cancelled'])
        ->orderBy('date_held','asc')
        ->orderBy('time_from','asc')
        ->get();
        $done = Event::where('user_id', function($subquery){
            $subquery->from('user_councilor')
            ->join('users','user_councilor.user_id','users.id')
            ->join('councilors','user_councilor.councilor_id','councilors.id')
            ->select('users.id')
            ->where('users.type', 'Coordinator')
            ->where('user_councilor.councilor_id', function($query){
                $query->from('user_councilor')
                ->where('user_id',Auth::id())
                ->select('councilor_id')
                ->first();
            })
            ->where('users.is_active',1)
            ->first();
        })
        ->where('date_held','<',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Done','Cancelled'])
        ->orderBy('date_held','desc')
        ->orderBy('time_from','desc')
        ->get();
        return view('SMS.Student.StudentEvents')->withEvents($events)->withDone($done);
    }
    public function show($id)
    {
        try {
            $events = Event::findorfail($id);
            return Response::json($events);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function upcome()
    {
        $events = Event::where('user_id', function($subquery){
            $subquery->from('user_councilor')
            ->join('users','user_councilor.user_id','users.id')
            ->join('councilors','user_councilor.councilor_id','councilors.id')
            ->select('users.id')
            ->where('users.type', 'Coordinator')
            ->where('user_councilor.councilor_id', function($query){
                $query->from('user_councilor')
                ->where('user_id',Auth::id())
                ->select('councilor_id')
                ->first();
            })
            ->where('users.is_active',1)
            ->first();
        })
        ->where('date_held','>',Carbon::today(Config::get('app.timezone')))
        ->where('status', 'Ongoing')
        ->count();
        return Response::json($events);
    }
}
