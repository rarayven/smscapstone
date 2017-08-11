<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Requirement;
use Response;
use Datatables;
use Validator;
use DB;
use App\Councilor;
use App\Connection;
class AdminMRequirementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function data()
    {   
        $steps = Requirement::join('user_councilor','requirements.user_id','user_councilor.user_id')
        ->join('councilors','user_councilor.councilor_id','councilors.id')
        ->select([DB::raw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',IFNULL(councilors.middle_name,'')) as strCounName"),'councilors.*'])
        ->distinct();
        return Datatables::of($steps)
        ->addColumn('action', function ($data) {
            return "<a href=".route('requirements.show',$data->id)."><button class='btn btn-info btn-xs'><i class='fa fa-eye'></i> View</button></a>";
        })
        ->addColumn('renewal', function ($data) {
            $counter = Connection::join('requirements','user_councilor.user_id','requirements.user_id')
            ->where('user_councilor.councilor_id',$data->id)
            ->where('requirements.type',1)
            ->count();
            return $counter;
        })
        ->addColumn('application', function ($data) {
            $counter = Connection::join('requirements','user_councilor.user_id','requirements.user_id')
            ->where('user_councilor.councilor_id',$data->id)
            ->where('requirements.type',0)
            ->count();
            return $counter;
        })
        ->editColumn('strCounName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['strCounName','action'])
        ->make(true);
    }
    public function detail($id)
    {   
        $steps = Requirement::where('user_id',$id);
        return Datatables::of($steps)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('is_active', function ($data) {
            $checked = '';
            if($data->is_active==1){
                $checked = 'checked';
            }
            return "<input type='checkbox' id='isActive' name='isActive' value='$data->id' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on=\"<i class='fa fa-check-circle'></i> Active\" data-off=\"<i class='fa fa-times-circle'></i> Inactive\" $checked data-size='mini'><script>
            $('[data-toggle=\'toggle\']').bootstrapToggle('destroy');   
            $('[data-toggle=\'toggle\']').bootstrapToggle();</script>";
        })
        ->editColumn('type', function ($data) {
            $type = 'Applications';
            if($data->type){
                $type = 'Renewal';
            }
            return $type;
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['is_active','action'])
        ->make(true);
    }
    public function checkbox(Request $request, $id)
    {
        try {
            $steps = Requirement::findorfail($id);
            $steps->is_active = $request->is_active;
            $steps->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        $councilor = Councilor::where('is_active',1)->get();
        return view('SMS.Admin.Maintenance.Requirement.AdminMRequirements')->withCouncilor($councilor);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Requirement::$storeRule);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            $connection = Connection::join('users','user_councilor.user_id','users.id')
            ->select('users.id')
            ->where('user_councilor.councilor_id',$request->councilor_id)
            ->where('users.type','Coordinator')
            ->first();
            $steps = new Requirement;
            $steps->user_id = $connection->id;
            $steps->description=$request->strStepDesc;
            $steps->type=$request->type;
            $steps->save();
            return Response::json($steps);
        } catch(\Exception $e) {
            if ($e->getCode()==23000) {
                return Response::json('The requirement has already been taken.',500);
            }
            return $e->getMessage();
        } 
    }
    public function show($id)
    {
        $connection = Connection::join('users','user_councilor.user_id','users.id')
        ->where('user_councilor.councilor_id',$id)
        ->where('users.type','Coordinator')
        ->select('users.id')
        ->first();
        $councilor = Councilor::find($id);
        return view('SMS.Admin.Maintenance.Requirement.AdminMRequirementsDetail')->withConnection($connection)->withCouncilor($councilor);
    }
    public function edit($id)
    {
        $requirement = Requirement::find($id);
        return Response::json($requirement);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Requirement::updateRule($id));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            try {
                $steps = Requirement::findorfail($id);
                $steps->description = $request->strStepDesc;
                $steps->type=$request->type;
                $steps->save();
                return Response::json($steps);
            } catch(\Exception $e) {
                if ($e->getCode()==23000) {
                    return Response::json('The requirement has already been taken.',500);
                }
                return $e->getMessage();
            }
        } catch(\Exception $e) {
            return Response::json("The record is invalid or deleted.", 422);
        }  
    }
    public function destroy($id)
    {
        try {
            $steps = Requirement::findorfail($id);
            try {
                $steps->delete();
                return Response::json($steps);
            } catch(\Exception $e) {
                if($e->getCode()==1451)
                    return Response::json(['true',$steps]);
                else
                    return Response::json(['true',$steps,$e->getMessage()]);
            }
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
}
