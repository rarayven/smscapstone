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
    public function data()
    {
        $events = Event::where('user_id',Auth::id())
        ->where('date_held','>=',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Ongoing','Cancelled']);
        return Datatables::of($events)
        ->addColumn('action', function ($data) {
            return "<a href=".route('coordinatorevents.show',$data->id)."><button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button></a> <button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('date_held', function ($data) {
            if ($data->date_held != null)
                return $data->date_held ? with(new Carbon($data->date_held))->format('M d, Y') : '';
            return 'Never Logged In';
        })
        ->editColumn('time_from', function ($data) {
            if ($data->time_from != null)
                return $data->time_from ? with(new Carbon($data->time_from))->format('h:i A') : '';
            return 'Never Logged In';
        })
        ->editColumn('time_to', function ($data) {
            if ($data->time_to != null)
                return $data->time_to ? with(new Carbon($data->time_to))->format('h:i A') : '';
            return 'Never Logged In';
        })
        ->editColumn('status', function ($data) {
            $checked = '';
            if($data->status=='Ongoing'){
                $checked = 'checked';
            }
            return "<input type='checkbox' id='isActive' name='isActive' value='$data->id' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on=\"<i class='fa fa-check-circle'></i> Ongoing\" data-off=\"<i class='fa fa-times-circle'></i> Cancelled\" $checked data-size='mini'><script>
            $('[data-toggle=\'toggle\']').bootstrapToggle('destroy');   
            $('[data-toggle=\'toggle\']').bootstrapToggle();</script>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['status','action'])
        ->make(true);
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
        $done = Event::where('user_id',Auth::id())
        ->where('date_held','<',Carbon::today(Config::get('app.timezone')))
        ->whereIn('status',['Done','Cancelled'])
        ->get();
        return view('SMS.Coordinator.Services.CoordinatorEvents')->withDone($done);;
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
        $event->status = 'Cancelled';
        $event->save();
        $event->delete();
        return Response::json($event);
    }
}
