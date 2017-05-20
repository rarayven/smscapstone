<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\User;
use Auth;
use DB;
use App\Connection;
class CoordinatorTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    public function data()
    {   
        $connections = Connection::join('users','connections.user_id','users.id')
        ->join('councilors','connections.councilor_id','councilors.id')
        ->select('councilors.id')
        ->where('connections.user_id',Auth::id())
        ->first();
        $users = User::join('achievements','users.id','achievements.user_id')
        ->join('connections','users.id','connections.user_id')
        ->join('student_details','users.id','student_details.user_id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'users.*','student_details.*','achievements.*'])
        ->where('connections.councilor_id',$connections->id)
        ->where('users.type','Student')
        ->where('achievements.status','Accepted')
        ->get();
        $datatables = Datatables::of($users)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-primary btn-xs btn-view' value='$data->id'><i class='fa fa-envelope'></i> Message</button> <button class='btn btn-success btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-share'></i> Receive</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-remove'></i> Cancel</button>";
        })
        ->editColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='60'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['strStudName','action']);
        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('user_id', 'where', 'like', "$keyword%");
        //     $datatables->filterColumn('strStudName', 'whereRaw', "CONCAT(users.last_name
        //         ,', ',users.first_name,' ',users.middle_name) like ? ", ["%$keyword%"]);
        // }
        return $datatables->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('SMS.Coordinator.Scholar.CoordinatorToken');
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
