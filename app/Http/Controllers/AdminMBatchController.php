<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Batch;
use Response;
use Datatables;
use Validator;
class AdminMBatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function data()
    {   
        $batch = Batch::all();
        return Datatables::of($batch)
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
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['is_active','action'])
        ->make(true);
    }
    public function checkbox($id)
    {
        try {
            $batch = Batch::findorfail($id);
            if ($batch->is_active) {
                $batch->is_active=0;
            }
            else{
                $batch->is_active=1;
            }
            $batch->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        return view('SMS.Admin.Maintenance.AdminMBatch');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Batch::$storeRule);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            $batch = new Batch;
            $batch->description=$request->strBatcDesc;
            $batch->save();
            return Response::json($batch);
        } catch(\Exception $e) {
            return var_dump($e->getMessage());
        } 
    }
    public function edit($id)
    {
        try {
            $batch = Batch::findorfail($id);
            return Response::json($batch);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Batch::updateRule($id));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            try {
                $batch = Batch::findorfail($id);
                $batch->description = $request->strBatcDesc;
                $batch->save();
                return Response::json($batch);
            } catch(\Exception $e) {
                return var_dump($e->getMessage());
            }
        } catch(\Exception $e) {
            return Response::json("The record is invalid or deleted.", 422);
        }
    }
    public function destroy($id)
    {
        try {
            $batch = Batch::findorfail($id);
            try {
                $batch->delete();
                return Response::json($batch);
            } catch(\Exception $e) {
                if($e->getCode()==1451)
                    return Response::json(['true',$batch]);
                else
                    return Response::json(['true',$batch,$e->getMessage()]);
            }
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
}
