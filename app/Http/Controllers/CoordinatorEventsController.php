<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use Auth;
use Carbon\Carbon;
use Response;
use Validator;
use Config;
use App\Attendance;
use Datatables;
use DB;
use App\Application;
class CoordinatorEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function attendance($id)
    {
        try {
            $attendance = Attendance::findorfail($id);
            if ($attendance->is_attending) {
                $attendance->is_attending=0;
            }
            else{
                $attendance->is_attending=1;
            }
            $attendance->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function checkbox($id)
    {
        try {
            $event = Event::findorfail($id);
            if ($event->status=='Ongoing') {
                $event->status='Cancelled';
            }
            else {
                $event->status='Ongoing';
            }
            $event->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        $events = Event::where('user_id',Auth::id())
        ->where('date_held','>=',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Ongoing','Cancelled'])
        ->orderBy('date_held','desc')
        ->orderBy('time_from','desc')
        ->get();
        $done = Event::where('user_id',Auth::id())
        ->where('date_held','<',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Done','Cancelled'])
        ->orderBy('date_held','desc')
        ->orderBy('time_from','desc')
        ->get();
        return view('SMS.Coordinator.Services.CoordinatorEvents')->withEvents($events)->withDone($done);
    }
    public function create()
    {
        $events = Event::where('user_id',Auth::id())
        ->where('date_held','>=',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Ongoing','Cancelled'])
        ->orderBy('date_held','desc')
        ->orderBy('time_from','desc')
        ->get();
        return Response::json($events);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Event::$storeRule, Event::$messages);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        DB::beginTransaction();
        try {
            $application = Application::join('users','student_details.user_id','users.id')
            ->join('user_councilor','users.id','user_councilor.user_id')
            ->select('users.*')
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
            ->where('student_details.is_steps_done',0)
            ->get();
            $time_from = date("H:i:s", strtotime($request->time_from));
            $time_to = date("H:i:s", strtotime($request->time_to));
            $date_held = Carbon::createFromFormat('Y-m-d', $request->date_held);
            $event = new Event;
            $event->user_id = Auth::id();
            $event->title = $request->title;
            $event->description = $request->description;
            $event->place_held = $request->place_held;
            $event->date_held = $date_held;
            $event->time_from = $time_from;
            $event->time_to = $time_to;
            $event->save();
            foreach ($application as $value) {
                $attendance = new Attendance;
                $attendance->event_id = $event->id;
                $attendance->user_id = $value->id;
                $attendance->save();
            }
            DB::commit();
            return Response::json($event);
        } catch(\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function show($id)
    {
        try {
            $events = Event::where('id',$id)
            ->where('user_id',Auth::id())
            ->firstorfail();
            $attendance = Attendance::join('events','user_event.event_id','events.id')
            ->join('users','user_event.user_id','users.id')
            ->select('users.*','user_event.id as user_event_id','user_event.*','events.*')
            ->where('user_event.event_id',$id)
            ->get();
            return view('SMS.Coordinator.Services.CoordinatorEventsDetails')->withEvents($events)->withAttendance($attendance);
        } catch(\Exception $e) {
            return redirect(route('coordinatorevents.index'));
        }
    }
    public function edit($id)
    {
        try {
            $events = Event::where('id',$id)
            ->where('user_id',Auth::id())
            ->first();
            return Response::json($events);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Event::updateRule($id), Event::$messages);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            $time_from = date("H:i:s", strtotime($request->time_from));
            $time_to = date("H:i:s", strtotime($request->time_to));
            $date_held = '';
            try {
                $date_held = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_held);
            } catch(\Exception $e) {
                $date_held = Carbon::createFromFormat('Y-m-d', $request->date_held);
            }
            $event = Event::findorfail($id);
            $event->user_id = Auth::id();
            $event->title = $request->title;
            $event->description = $request->description;
            $event->place_held = $request->place_held;
            $event->date_held = $date_held;
            $event->time_from = $time_from;
            $event->time_to = $time_to;
            $event->save();
            return Response::json($event);
        } catch(\Exception $e) {
            dd($e);
            return var_dump($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->status = 'Done';
        $event->save();
        $event->delete();
        return Response::json($event);
    }
}
