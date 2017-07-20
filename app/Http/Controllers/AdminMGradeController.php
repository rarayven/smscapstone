<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Grading;
use Response;
use Datatables;
use Validator;
use DB;
use App\GradingDetail;
class AdminMGradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function data()
    {   
        $grade = Grading::all();
        return Datatables::of($grade)
        ->addColumn('action', function ($data) {
            return "<a href=".route('grade.show',$data->id)."><button class='btn btn-info btn-xs btn-view'><i class='fa fa-eye'></i> View</button></a> <a href=".route('grade.edit',$data->id)."><button class='btn btn-warning btn-xs btn-detail open-modal'><i class='fa fa-edit'></i> Edit</button></a> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
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
            $grade = Grading::findorfail($id);
            if ($grade->is_active) {
                $grade->is_active=0;
            }
            else{
                $grade->is_active=1;
            }
            $grade->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        return view('SMS.Admin.Maintenance.AdminMGrade');
    }
    public function create()
    {
        return view('SMS.Admin.Maintenance.AdminMGradeDetail');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Grading::$storeRule);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        DB::beginTransaction();
        try {
            $grade = new Grading;
            $grade->description=$request->strSystDesc;
            $grade->save();
            $ctr = 0;
            foreach ($request->status as $status) {
                $gradingDetails = new GradingDetail;
                $gradingDetails->grading_id = $grade->id;
                $gradingDetails->grade = $request->grading[$ctr];
                $gradingDetails->is_passed = $request->status[$ctr];
                $gradingDetails->save();
                $ctr++;
            }
            DB::commit();
            return redirect(route('grade.index'));
        } catch(\Exception $e) {
            DB::rollBack();
            return var_dump($e->getMessage());
        } 
    }
    public function show()
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Grading::updateRule($id));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            try {
                $grade = Grading::findorfail($id);
                $grade->description=$request->strSystDesc;
                $grade->highest_grade=$request->dblSystHighGrade;
                $grade->lowest_grade=$request->dblSystLowGrade;
                $grade->failing_grade=$request->strSystFailGrade;
                $grade->save();
                return Response::json($grade);
            } catch(\Exception $e) {
                return var_dump($e->errorInfo[2]);
            } 
        } catch(\Exception $e) {
            return Response::json("The record is invalid or deleted.", 422);
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $gradeDetail = GradingDetail::where('grading_id',$id)->delete();
            $grade = Grading::where('id',$id)->delete();
            DB::commit();
            return Response::json($grade);
        } catch(\Exception $e) {
            DB::rollBack();
            return "Deleted";
        }
    }
}
