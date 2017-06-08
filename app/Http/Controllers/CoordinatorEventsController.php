<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use Auth;
use Carbon\Carbon;
use Response;
use Validator;
use Config;
class CoordinatorEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
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
        $dtm = Carbon::now(Config::get('app.timezone'));
        $events = Event::where('user_id',Auth::id())
        ->where('date_held','>',$dtm)
        ->whereIn('status',['Ongoing','Cancelled'])
        ->orderBy('date_held','desc')
        ->orderBy('time_from','desc')
        ->get();
        $done = Event::where('user_id',Auth::id())
        ->where('status','Done')
        ->orderBy('date_held','desc')
        ->orderBy('time_from','desc')
        ->get();
        return view('SMS.Coordinator.Services.CoordinatorEvents')->withEvents($events)->withDone($done);
    }
    public function create()
    {
        $events = Event::where('user_id',Auth::id())
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
        try {
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
            return Response::json($event);
        } catch(\Exception $e) {
            return var_dump($e->getMessage());
        }
    }
    public function show($id)
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
