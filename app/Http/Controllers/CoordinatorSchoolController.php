<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use App\School;
use App\UserSchool;
use Auth;
use Response;
class CoordinatorSchoolController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('coordinator');
	}
	public function data()
	{
		$school = School::where('is_active',1);
		return Datatables::of($school)
		->addColumn('is_active', function ($data) {
			$school = UserSchool::where('school_id',$data->id)
			->where('user_id',Auth::id())
			->first();
			$checked = '';
			if($school != null){
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
			$school = UserSchool::where('user_id',Auth::id())->where('school_id',$id)->firstorfail();
			$school->delete();
		} catch(\Exception $e) {
			$school = new UserSchool;
			$school->school_id = $id;
			$school->user_id = Auth::id();
			$school->save();
		}
		return Response::json(200);
	}
	public function index()
	{
		return view('SMS.Coordinator.Services.CoordinatorSchool');
	}
}
