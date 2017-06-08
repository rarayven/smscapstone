<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use App\Achievement;
use Response;
use Auth;
use Carbon\Carbon;
use Validator;
use DB;
class StudentAchievementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function data()
    {   
        $achievement = Achievement::where('user_id',Auth::id())->get();
        return Datatables::of($achievement)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
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
        ->editColumn('date_held', function ($data) {
            return $data->date_held ? with(new Carbon($data->date_held))->format('M d, Y - h:i A ') : '';
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
    public function index()
    {
        return view('SMS.Student.StudentAchievements');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Achievement::$storeRule);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            $pdf = $request->file('pdf');
            $pdfname = md5(Auth::user()->email. time()).'.'.$pdf->getClientOriginalExtension();
            $achievement = new Achievement;
            $achievement->user_id = Auth::id();
            $achievement->description = $request->description;
            $achievement->place_held = $request->place_held;
            $achievement->date_held = $request->date_held;
            $achievement->pdf = $pdfname;
            $achievement->save();
            $pdf->move(base_path().'/public/docs/', $pdfname);
            return Response::json($achievement);
        } catch(\Exception $e) {
            dd($e);
            return dd($e->getMessage());
        }
        // $validator = Validator::make($request->all(), Achievement::updateRule($id));
        // if ($validator->fails()) {
        //     return Response::json($validator->errors()->first(), 422);
        // }
    }
}
