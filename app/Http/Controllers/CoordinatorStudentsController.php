<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Requirement;
use App\User;
use App\District;
use App\Councilor;
use App\Application;
use App\Barangay;
use App\School;
use App\Grade;
use App\Course;
use App\Batch;
use Response;
use App\Studentsteps;
use Auth;
use Carbon\Carbon;
use Datatables;
use Config;
use App\Allocation;
use App\Allocatebudget;
use App\Budgtype;
class CoordinatorStudentsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('coordinator');
	}
	public function index()
	{
		$district = District::where('is_active',1)->get();
		$councilor = Councilor::where('is_active',1)->get();
		$barangay = Barangay::where('is_active',1)->get();
		$school = School::where('is_active',1)->get();
		$course = Course::where('is_active',1)->get();
		$batch = Batch::where('is_active',1)->get();
		$steps = Requirement::where('is_active',1)->get();
		return view('SMS.Coordinator.Scholar.CoordinatorStudents')->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withBatch($batch)->withSteps($steps);
	}
	public function store(Request $request)
	{
		$application = Application::join('users','student_details.user_id','users.id')
		->join('user_councilor','users.id','user_councilor.user_id')
		->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',IFNULL(users.middle_name,'')) as strStudName"),'users.*','student_details.*'])
		->where('users.type','Student')
		->where('user_councilor.councilor_id', function($query){
			$query->from('user_councilor')
			->join('users','user_councilor.user_id','users.id')
			->join('councilors','user_councilor.councilor_id','councilors.id')
			->select('councilors.id')
			->where('user_councilor.user_id',Auth::id())
			->first();
		})
		->where('student_details.application_status','Accepted')
		->where('student_status','Continuing');
		$datatables = Datatables::of($application)
		->addColumn('counter', function ($data) {
			$count = Requirement::where('is_active',1)
			->where('type',$data->is_renewal)
			->where('user_id',Auth::id())
			->count();
			$steps = Studentsteps::join('requirements','user_requirement.requirement_id','requirements.id')
			->where('user_requirement.user_id',$data->id)
			->where('requirements.type',$data->is_renewal)
			->where('requirements.user_id',Auth::id())
			->count();
			if($count!=0)
				$percentage = (($steps/$count)*100);
			else
				$percentage = 0;
			return "<div class='pull-right' style='margin-top: -5px; margin-left: 5px;'>$steps/$count </div></div><div class='progress progress-sm active'>
			<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: $percentage%'></div>";
		})
		->addColumn('stipend', function ($data) {
			$count = Budgtype::where('is_active',1)->count();
			$allocate = Allocatebudget::where('user_id',$data->id)->count();
			if($count!=0)
				$percentage = (($allocate/$count)*100);
			else
				$percentage = 0;
			return "<div class='pull-right' style='margin-top: -5px; margin-left: 5px;'>$allocate/$count </div></div><div class='progress progress-sm active'>
			<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: $percentage%'></div>";
		})
		->addColumn('action', function ($data) {
			$claim = "disabled";
			$list = '';
			if($data->is_steps_done){
				$claim = "";
				$list = 'disabled';
			}
			return "<button class='btn btn-primary btn-xs btn-progress' value=$data->id $list><i class='fa fa-files-o'></i> List</button> <button class='btn btn-success btn-xs open-modal' value='$data->id' $claim><i class='fa fa-money'></i> Claim</button>";
		})
		->editColumn('strStudName', function ($data) {
			$images = url('images/'.$data->picture);
			return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
		})
		->setRowId(function ($data) {
			return $data = 'id'.$data->user_id;
		})->rawColumns(['strStudName','stipend','counter','action']);
		if ($strUserFirstName = $request->get('strUserFirstName')) {
			$datatables->where('users.first_name', 'like', '%'.$strUserFirstName.'%');
		}
		if ($strUserMiddleName = $request->get('strUserMiddleName')) {
			$datatables->where('users.middle_name', 'like', '%'.$strUserMiddleName.'%');
		}
		if ($strUserLastName = $request->get('strUserLastName')) {
			$datatables->where('users.last_name', 'like', '%'.$strUserLastName.'%');
		}
		if ($intDistID = $request->get('intDistID')) {
			$datatables->where('student_details.district_id', 'like', '%'.$intDistID.'%');
		}
		if ($intStepID = $request->get('intStepID')) {
			$datatables->where('user_step.requirement_id', 'like', '%'.$intStepID.'%');
		}
		if ($intBaraID = $request->get('intBaraID')) {
			$datatables->where('student_details.barangay_id', 'like', '%'.$intBaraID.'%');
		}
		if ($intBatcID = $request->get('intBatcID')) {
			$datatables->where('student_details.batch_id', 'like', '%'.$intBatcID.'%');
		}
		if ($strPersStreet = $request->get('strPersStreet')) {
			$datatables->where('student_details.street', 'like', '%'.$strPersStreet.'%');
		}
		if ($strPersReligion = $request->get('strPersReligion')) {
			$datatables->where('student_details.religion', 'like', '%'.$strPersReligion.'%');
		}
		if ($keyword = $request->get('search')['value']) {
			$datatables->filterColumn('user_id', 'where', 'like', "$keyword%");
			$datatables->filterColumn('strStudName', 'whereRaw', "CONCAT(users.last_name
				,', ',users.first_name,' ',IFNULL(users.middle_name,'')) like ? ", ["%$keyword%"]);
		}
		return $datatables->make(true);
	}
	public function create($id)
	{
		$step = Requirement::whereNotIn('id', function($query) use($id) {
			$query->from('user_requirement')
			->select('requirement_id')
			->where('user_id',$id)
			->get();
		})
		->where('is_active',1)
		->where('type', function($query) use($id) {
			$query->from('student_details')
			->select('is_renewal')
			->where('user_id',$id)
			->first();
		})
		->where('user_id',Auth::id())
		->select('requirements.*')
		->get();
		return Response::json($step);
	}
	public function allocation($id)
	{
		$allocation = Allocation::leftJoin('allocation_types','allocations.allocation_type_id','allocation_types.id')
		->join('budgets','allocations.budget_id','budgets.id')
		->select('allocation_types.description','allocations.id')
		->where('budgets.id', function($query){
			$query->from('budgets')
			->select('id')
			->latest('id')
			->first();
		})
		->whereNotIn('allocations.id', function($query) use($id) {
			$query->from('user_allocation')
			->select('allocation_id')
			->where('user_id',$id)
			->get();
		})
		->get();
		return Response::json($allocation);
	}
	public function update(Request $request, $id)
	{
		DB::beginTransaction();
		try {
			$grade = Grade::where('student_detail_user_id',$id)->latest('id')->first();
			foreach ($request->steps as $step) {
				$steps = new Studentsteps;
				$steps->user_id = $id;
				$steps->requirement_id = $step;
				$steps->grade_id = $grade->id;
				$steps->save();
			}
			$requirements = Requirement::where('type', function($query) use($id) {
				$query->from('student_details')
				->select('is_renewal')
				->where('user_id',$id)
				->first();
			})
			->where('user_id',Auth::id())
			->count();
			$step = Studentsteps::where('grade_id',$grade->id)->count();
			if ($requirements == $step) {
				$application = Application::find($id);
				$application->is_steps_done = 1;
				$application->save();
			}
			DB::commit();
			return Response::json($grade);
		} catch (\Exception $e) {
			DB::rollBack();
			dd($e->getMessage());
			return Response::json('Input must not be nulled',500);
		}
	}
	public function stipend(Request $request, $id)
	{
		DB::beginTransaction();
		try {
			$grade = Grade::where('student_detail_user_id',$id)->latest('id')->first();
			foreach ($request->claim as $claim) {
				$allocate = new Allocatebudget;
				$allocate->user_id = $id;
				$allocate->allocation_id = $claim;
				$allocate->grade_id = $grade->id;
				$allocate->save();
			}
			DB::commit();
			return Response::json($grade);
		} catch (\Exception $e) {
			DB::rollBack();
			return Response::json('Input must not be nulled',500);
		}
	}
}
