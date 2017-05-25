<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\District;
use Response;
use Datatables;
use Validator;
use Input;
class AdminMDistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function data()
    {   
        $district = District::all();
        return Datatables::of($district)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('isActive', function ($data) {
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
        ->rawColumns(['isActive','action'])
        ->make(true);
    }
    public function checkbox($id)
    {
        try
        {
            $district = District::findorfail($id);
            if ($district->is_active) {
                $district->is_active=0;
            }
            else{
                $district->is_active=1;
            }
            $district->save();
        }
        catch(\Exception $e) {
            try{
                if($e->errorInfo[1]==1062)
                    return "This Data Already Exists";
                else
                    return var_dump($e->errorInfo[1]);
            }
            catch(\Exception $e){
                return "Deleted";
            }
        } 
    }
    public function index()
    {
        return view('SMS.Admin.Maintenance.AdminMDistrict');
    }
    public function store(Request $request)
    {
        Input::merge(array_map('trim', Input::all()));
        $validator = Validator::make($request->all(), [
            'strDistDesc' =>  'required|max:15|min:3',
            ]);
        if ($validator->fails()) {
            return "Required";
        }
        try
        {
            $district = new District;
            $district->description=$request->strDistDesc;
            $district->save();
            return Response::json($district);
        }
        catch(\Exception $e) {
            if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else
                return var_dump($e->errorInfo[1]);
        } 
    }
    public function edit($id)
    {
        try
        {
            $district = District::findorfail($id);
            return Response::json($district);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        Input::merge(array_map('trim', Input::all()));
        try
        {
            try
            {
                $district = District::findorfail($id);
                $district->description = $request->strDistDesc;
                $district->save();
                return Response::json($district);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1062)
                    return "This Data Already Exists";
                else
                    return var_dump($e->errorInfo[1]);
            } 
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function destroy($id)
    {
        try
        {
            $district = District::findorfail($id);
            try
            {
                $district->delete();
                return Response::json($district);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$district]);
                else
                    return Response::json(['true',$district,$e->errorInfo[1]]);
            }
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
}
