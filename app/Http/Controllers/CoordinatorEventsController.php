<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use Carbon\Carbon;
use Response;
class CoordinatorEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::where('user_id',Auth::user()->id)
        ->get();
        // dd($events);
        return view('SMS.Coordinator.Services.CoordinatorEvents')->withEvents($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $time_from = date("H:i:s", strtotime($request->time_from));
            $time_to = date("H:i:s", strtotime($request->time_to));
            $date_held = Carbon::createFromFormat('Y-m-d', $request->date_held);
            $event = new Event;
            $event->user_id = Auth::user()->id;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->place_held = $request->place_held;
            $event->date_held = $date_held;
            $event->time_from = $time_from;
            $event->time_to = $time_to;
            $event->save();
            $events = Event::where('user_id',Auth::user()->id)
            ->get();
            return Response::json($events);
        }catch(\Exception $e){
            if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else
                return var_dump($e->errorInfo[1]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
