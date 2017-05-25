<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Academicgrade;
use Response;
use Datatables;
use Input;
use Validator;
class AdminMGradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function data()
    {   
        $grade = Academicgrade::all();
        return Datatables::of($grade)
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
            $grade = Academicgrade::findorfail($id);
            if ($grade->is_active) {
                $grade->is_active=0;
            }
            else{
                $grade->is_active=1;
            }
            $grade->save();
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
        return view('SMS.Admin.Maintenance.AdminMGrade');
    }
    public function store(Request $request)
    {
        Input::merge(array_map('trim', Input::all()));
        $validation = Validator::make(Input::all(), Academicgrade::$desc);
        if ($validation->fails()) {
            return "1";
        }
        $validation2 = Validator::make(Input::all(), Academicgrade::$value);
        if ($validation2->fails()) {
            return "2";
        }
        try
        {
            $grade = new Academicgrade;
            $grade->description=$request->strSystDesc;
            $grade->highest_grade=$request->dblSystHighGrade;
            $grade->lowest_grade=$request->dblSystLowGrade;
            $grade->failing_grade=$request->strSystFailGrade;
            $grade->save();
            return Response::json($grade);
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
            $grade = Academicgrade::findorfail($id);
            return Response::json($grade);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        Input::merge(array_map('trim', Input::all()));
        $validation = Validator::make(Input::all(), Academicgrade::updatedesc($id));
        if ($validation->fails()) {
            return "1";
        }
        $validation2 = Validator::make(Input::all(), Academicgrade::updatevalue($id));
        if ($validation2->fails()) {
            return "2";
        }
        try
        {
            try
            {
                $grade = Academicgrade::findorfail($id);
                $grade->description=$request->strSystDesc;
                $grade->highest_grade=$request->dblSystHighGrade;
                $grade->lowest_grade=$request->dblSystLowGrade;
                $grade->failing_grade=$request->strSystFailGrade;
                $grade->save();
                return Response::json($grade);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1062)
                    return "This Data Already Exists";
                else
                    return var_dump($e->errorInfo[2]);
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
            $grade = Academicgrade::findorfail($id);
            try
            {
                $grade->delete();
                return Response::json($grade);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$grade]);
                else
                    return Response::json(['true',$grade,$e->errorInfo[1]]);
            }
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
}
