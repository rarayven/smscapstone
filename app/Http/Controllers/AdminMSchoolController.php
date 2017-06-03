<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\School;
use App\Academicgrade;
use Response;
use Datatables;
use Validator;
class AdminMSchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function data()
    {
        $school = School::join('academic_gradings','schools.academic_grading_id','academic_gradings.id')
        ->select(['schools.*','academic_gradings.description as academic_gradings_description']);
        return Datatables::of($school)
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
            $school = School::findorfail($id);
            if ($school->is_active) {
                $school->is_active=0;
            }
            else{
                $school->is_active=1;
            }
            $school->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        $grade = Academicgrade::where('is_active',1)->pluck('description','id');
        return view('SMS.Admin.Maintenance.AdminMSchool')->withGrade($grade);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), School::$storeRule);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            $school = new School;
            $school->description=$request->strSchoDesc;
            $school->academic_grading_id=$request->intSystID;
            $school->save();
            return Response::json($school);
        } catch(\Exception $e) {
            return var_dump($e->errorInfo[1]);
        } 
    }
    public function edit($id)
    {
        try {
            $school = School::join('academic_gradings','schools.academic_grading_id','academic_gradings.id')
            ->select(['schools.*','academic_gradings.description as academic_gradings_description'])
            ->where('schools.id',$id)
            ->firstorfail();
            return Response::json($school);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), School::updateRule($id));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            try {
                $school = School::findorfail($id);
                $school->description = $request->strSchoDesc;
                $school->academic_grading_id = $request->intSystID;
                $school->save();
                $school = School::join('academic_gradings','schools.academic_grading_id','academic_gradings.id')
                ->select(['schools.*','academic_gradings.description as academic_gradings_description'])
                ->where('schools.id',$id)
                ->first();
                return Response::json($school);
            } catch(\Exception $e) {
                return var_dump($e->errorInfo[1]);
            } 
        } catch(\Exception $e) {
            return Response::json("The record is invalid or deleted.", 422);
        }
    }
    public function destroy($id)
    {
        try {
            $school = School::findorfail($id);
            try {
                $school->delete();
                return Response::json($school);
            } catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$school]);
                else
                    return Response::json(['true',$school,$e->errorInfo[1]]);
            }
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
}
