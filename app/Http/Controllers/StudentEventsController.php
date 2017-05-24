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
        $this->middleware('student');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $connect = Connection::join('users','connections.user_id','users.id')
        ->select('connections.councilor_id')
        ->where('connections.user_id',Auth::id())
        ->first();
        $connection = Connection::join('users','connections.user_id','users.id')
        ->join('councilors','connections.councilor_id','councilors.id')
        ->select('users.id')
        ->where('users.type', 'Coordinator')
        ->where('connections.councilor_id',$connect->councilor_id)
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
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $events = Event::where('id',$id)
            ->first();
            return Response::json($events);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
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
