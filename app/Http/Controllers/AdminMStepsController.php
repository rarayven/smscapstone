<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Step;
use Response;
use Datatables;
use Input;
use DB;
class AdminMStepsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function data()
    {   
        $steps = Step::all();
        return Datatables::of($steps)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('intStepOrder', function ($data) {
            return "<div id=num$data->id>$data->order</div>";
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
        ->rawColumns(['intStepOrder','isActive','action'])
        ->make(true);
    }
    public function checkbox($id)
    {
        try
        {
            $pivot = 0;
            $findorfail = false;
            $count = Step::where('is_active',1)->count('order');
            $get = Step::where('is_active',1)->select('order')->orderBy('order')->get();
            if($count==0){
                $pivot = 1;
            }
            try{
                for($x = 0; $x<$count; $x++){
                    if($x+1!=$get[$x]->order){
                        $pivot=$x+1;
                        $findorfail = true;
                        break;
                    }
                }
                if(!$findorfail){
                    $pivot=$count+1;
                }
            }catch(\Exception $e){
                $pivot = 0; 
            }
            $steps = Step::findorfail($id);
            if ($steps->is_active) {
                $steps->is_active=0;
                $steps->order=0;
            }
            else{
                $steps->is_active=1;
                $steps->order=$pivot;
            }
            $steps->save();
            return Response::json($steps);
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
        // dd($pivot);
        return view('SMS.Admin.Maintenance.AdminMSteps');
    }
    public function create()
    {
        $steps = Step::where('is_active',1)->max('order');
        $steps++;
        return Response::json($steps);
    }
    public function store(Request $request)
    {
        Input::merge(array_map('trim', Input::all()));
        try
        {
            $steps = new Step;
            $steps->description=$request->strStepDesc;
            $steps->deadline=$request->intStepDeadline;
            $steps->order=$request->intStepOrder;
            $steps->save();
            return Response::json($steps);
        }
        catch(\Exception $e) {
            if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else
                return var_dump($e->errorInfo[1]);
        } 
    }
    public function show($id)
    {
        return redirect('admin/maintenance/steps');
    }
    public function edit($id)
    {
        try
        {
            $steps = Step::findorfail($id);
            return Response::json($steps);
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
                $steps = Step::findorfail($id);
                $steps->description = $request->strStepDesc;
                $steps->deadline=$request->intStepDeadline;
                $steps->order=$request->intStepOrder;
                $steps->save();
                return Response::json($steps);
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
            $steps = Step::findorfail($id);
            try
            {
                $steps->delete();
                return Response::json($steps);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$steps]);
                else
                    return Response::json(['true',$steps,$e->errorInfo[1]]);
            }
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
}
