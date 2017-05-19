<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Achievement;
class CoordinatorAchievementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    public function data()
    {   
        $achievement = Achievement::where('user_id',5)->get();
        return Datatables::of($achievement)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-success btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-check'></i> Accept</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Remove</button>";
        })
        ->editColumn('status', function ($data) {
            if($data->status=='Accepted'){
                $status = 'success';
            }elseif ($data->status=='Pending') {
                $status = 'warning';
            }elseif ($data->status=='Declined') {
                $status = 'danger';
            }
            return "<span class='label label-$status'>$data->status</span>";
        })
        ->editColumn('token_process', function ($data) {
            if($data->token_process=='Received'){
                $token_process = 'success';
            }elseif ($data->token_process=='Pending') {
                $token_process = 'warning';
            }elseif ($data->token_process=='Cancelled') {
                $token_process = 'danger';
            }
            return "<span class='label label-$token_process'>$data->token_process</span>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['status','token_process','action'])
        ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('SMS.Coordinator.Scholar.CoordinatorAchievements');
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
