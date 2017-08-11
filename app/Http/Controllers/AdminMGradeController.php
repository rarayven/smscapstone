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
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <a href=".route('grade.edit',$data->id)."><button class='btn btn-warning btn-xs btn-detail open-modal'><i class='fa fa-edit'></i> Edit</button></a> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
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
    public function checkbox(Request $request, $id)
    {
        try {
            $grade = Grading::findorfail($id);
            $grade->is_active = $request->is_active;
            $grade->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        return view('SMS.Admin.Maintenance.Grade.AdminMGrade');
    }
    public function create()
    {
        return view('SMS.Admin.Maintenance.Grade.AdminMGradeDetail');
    }
    public function store(Request $request)
    {
        $this->validate($request, Grading::$storeRule);
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
            return $e->getMessage();
        } 
    }
    public function show($id)
    {
        $grading = Grading::join('grading_details','gradings.id','grading_details.grading_id')
        ->where('gradings.id',$id)
        ->get();
        return Response::json($grading);
    }
    public function edit($id)
    {
        $grading = Grading::join('grading_details','gradings.id','grading_details.grading_id')
        ->where('gradings.id',$id)
        ->get();
        return view('SMS.Admin.Maintenance.Grade.AdminMGradeDetail')->withGrading($grading);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, Grading::updateRule($id));
        DB::beginTransaction();
        try {
            $grade = Grading::find($id);
            $grade->description=$request->strSystDesc;
            $grade->save();
            $ctr = 0;
            $grading = GradingDetail::where('grading_id',$id)->delete();
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
            return $e->getMessage();
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
