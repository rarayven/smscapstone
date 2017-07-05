<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Step;
use App\User;
use App\District;
use App\Councilor;
use App\Application;
use App\Barangay;
use App\School;
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
		$steps = Step::where('is_active',1)->get();
		$count = Step::where('is_active',1)->count();
		return view('SMS.Coordinator.Scholar.CoordinatorStudents')->withCount($count)->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withBatch($batch)->withSteps($steps);
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
		->where('student_status','Continuing')
		->where('student_details.is_steps_done',0);
		$datatables = Datatables::of($application)
		->addColumn('counter', function ($data) {
			$count = Step::where('is_active',1)->count();
			$steps = Studentsteps::where('user_id',$data->id)->count();
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
			$count = Step::where('is_active',1)->count();
			if($count!=0)
				$state = "";
			else
				$state = "disabled";
			return "<button class='btn btn-primary btn-xs btn-progress' $state $state value=$data->id><i class='fa fa-line-chart'></i> Step</button> <button class='btn btn-success btn-xs open-modal' value='$data->id'><i class='fa fa-money'></i> Stipend</button> ";
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
			$datatables->where('user_step.step_id', 'like', '%'.$intStepID.'%');
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
	public function create()
	{
		$step = Step::where('is_active',1)->get();
		return Response::json($step);
	}
	public function allocation()
	{
		$allocation = Allocation::join('allocation_types','allocations.allocation_type_id','allocation_types.id')
		->join('budgets','allocations.budget_id','budgets.id')
		->select('allocation_types.description','allocations.id')
		->where('budgets.id', function($query){
			$query->from('budgets')
			->select('id')
			->latest('id')
			->first();
		})
		->get();
		return Response::json($allocation);
	}
	public function show($id)
	{
		$steps = Studentsteps::where('user_id',$id)->get();
		return Response::json($steps);
	}
	public function checkclaim($id)
	{
		$allocate = Allocatebudget::where('user_id',$id)->get();
		return Response::json($allocate);
	}
	public function update(Request $request, $id)
	{
		try {
			$student_step = Studentsteps::where('user_id',$id)->delete();
			foreach ($request->steps as $step) {
				$steps = new Studentsteps;
				$steps->user_id = $id;
				$steps->step_id = $step;
				$steps->save();
			}
			return Response::json($student_step);
		} catch (\Exception $e) {
			return Response::json($e->getMessage().'Input must not be nulled',500);
		}
	}
	public function stipend(Request $request, $id)
	{
		try {
			$allocate = Allocatebudget::where('user_id',$id)->delete();
			foreach ($request->claim as $claim) {
				$steps = new Allocatebudget;
				$steps->user_id = $id;
				$steps->allocation_id = $claim;
				$steps->save();
			}
			return Response::json($allocate);
		} catch (\Exception $e) {
			return Response::json($e->getMessage().'Input must not be nulled',500);
		}
	}
}
