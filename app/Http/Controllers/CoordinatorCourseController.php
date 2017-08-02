<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use App\Course;
use App\UserCourse;
use Auth;
use Response;
class CoordinatorCourseController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('coordinator');
	}
	public function data()
	{
		$course = Course::where('is_active',1);
		return Datatables::of($course)
		->addColumn('is_active', function ($data) {
			$course = UserCourse::where('course_id',$data->id)
			->where('user_id',Auth::id())
			->first();
			$checked = '';
			if($course != null){
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
			$course = UserCourse::where('user_id',Auth::id())->where('course_id',$id)->firstorfail();
			$course->delete();
		} catch(\Exception $e) {
			$course = new UserCourse;
			$course->course_id = $id;
			$course->user_id = Auth::id();
			$course->save();
		}
		return Response::json(200);
	}
	public function index()
	{
		return view('SMS.Coordinator.Services.CoordinatorCourse');
	}
}
