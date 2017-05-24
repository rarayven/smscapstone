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
use App\Connection;
use Auth;
use Datatables;
class CoordinatorStudentsController extends Controller
{
	public function __construct()
	{
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
	public function create()
	{
        //
	}
	public function store(Request $request)
	{
		$connections = Connection::join('users','connections.user_id','users.id')
		->join('councilors','connections.councilor_id','councilors.id')
		->select('councilors.id')
		->where('connections.user_id',Auth::id())
		->first();
		$application = Application::join('users','student_details.user_id','users.id')
		->join('connections','users.id','connections.user_id')
		->join('student_steps','student_steps.user_id','users.id')
		->join('steps','student_steps.step_id','steps.id')
		->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'users.*','student_steps.step_id','steps.description','steps.order','student_details.*'])
		->where('users.type','Student')
		->where('connections.councilor_id',$connections->id)
		->where('student_details.is_steps_done',0);
		$datatables = Datatables::of($application)
		->editColumn('intStepOrder', function ($data) {
			$count = Step::where('is_active',1)->count();
			if($count!=0)
				$percentage = (($data->order/$count)*100);
			else
				$percentage = 0;
			return "<div id=detail$data->id><div id=stat$data->id>
			Todo: $data->description <div class='pull-right'>$data->order/$count </div></div><div class='progress progress-sm active'>
			<div class='progress-bar progress-bar-success progress-bar-striped' id=prog$data->id role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: $percentage%'></div></div></div>";
		})
		->addColumn('action', function ($data) {
			$count = Step::where('is_active',1)->count();
			if($count!=0)
				$state = "";
			else
				$state = "disabled";
			return "<div id=dp$data->id>
			<button id=$count class='btn btn-success btn-xs btn-progress' $state $state value=$data->id><i class='fa fa-check'></i> Check</button> <button id=$count class='btn btn-warning btn-undo btn-xs' $state $state value=$data->id><i class='fa fa-undo'></i> Undo</button> <button class='btn btn-info btn-xs open-modal'><i class='fa fa-eye'></i> View</button></div>";
		})
		->editColumn('strStudName', function ($data) {
			$images = url('images/'.$data->picture);
			return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
		})
		->setRowId(function ($data) {
			return $data = 'id'.$data->user_id;
		})->rawColumns(['strStudName','intStepOrder','action']);
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
			$datatables->where('student_steps.step_id', 'like', '%'.$intStepID.'%');
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
				,', ',users.first_name,' ',users.middle_name) like ? ", ["%$keyword%"]);
		}
		return $datatables->make(true);
	}
	public function show($id)
	{
		DB::beginTransaction();
		try{
			$steps = Step::where('is_active',1)->count();
			$student = Studentsteps::join('steps','student_steps.step_id','steps.id')
			->select('steps.order')
			->where('student_steps.user_id',$id)
			->first();
            $intStepOrder = $student->order;//get the order number
            if($intStepOrder>1){//check if higher than 0
            	$intStepOrder--;
            	$users = Studentsteps::find($id);
            	$users->step_id=$intStepOrder;
            	$users->save();
            }
            else{
                $step_id=1;//order when 0
            }
            $studentsteps = Studentsteps::join('steps','student_steps.step_id','steps.id')
            ->join('student_details','student_steps.user_id','student_details.user_id')
            ->select('student_steps.*','steps.description','steps.order','student_details.is_steps_done')
            ->where('student_steps.user_id',$id)
            ->first();
            DB::commit();
            return Response::json($studentsteps);
        }
        catch(\Exception $e)
        {
        	DB::rollBack();
        }
    }
    public function edit($id)
    {
    	DB::beginTransaction();
    	try{
    		$steps = Step::where('is_active',1)->count();
    		$userssteps = Studentsteps::find($id);
    		$userssteps->step_id=$steps;
    		$userssteps->save();
    		$users = Application::find($id);
    		$users->is_steps_done=0;
    		$users->save();
    		$studentsteps = Studentsteps::join('steps','student_steps.step_id','steps.id')
    		->join('student_details','student_steps.user_id','student_details.user_id')
    		->select('student_steps.*','steps.description','steps.order','student_details.is_steps_done')
    		->where('student_steps.user_id',$id)
    		->first();
    		DB::commit();
    		return Response::json($studentsteps);
    	}
    	catch(\Exception $e)
    	{
    		DB::rollBack();
    	}
    }
    public function update(Request $request, $id)
    {
    	DB::beginTransaction();
    	try{
    		$steps = Step::where('is_active',1)->count();
    		$student = Studentsteps::join('steps','student_steps.step_id','steps.id')
    		->select('steps.order')
    		->where('student_steps.user_id',$id)
    		->first();
            $intStepOrder = $student->order;//get the order number
            if($intStepOrder>=$steps){//check if lower the sum of active steps
                $intStepOrder=1;//value if = steps
                $users = Application::find($id);
                $users->is_steps_done=1;
                $users->save();
            }
            else{
                $intStepOrder+=1;//increment if < steps
            }
            $studsteps = Step::where('order',$intStepOrder)->first();
            $studentsteps = Studentsteps::find($id);//save the result
            $studentsteps->step_id = $studsteps->id;
            $studentsteps->save();
            $studentsteps = Studentsteps::join('steps','student_steps.step_id','steps.id')
            ->join('student_details','student_steps.user_id','student_details.user_id')
            ->select('student_steps.*','steps.description','steps.order','student_details.is_steps_done')
            ->where('student_steps.user_id',$id)
            ->first();
            DB::commit();
            return Response::json($studentsteps);
        }
        catch(\Exception $e)
        {
        	DB::rollBack();
        }
    }
    public function destroy($id)
    {
        //
    }
}
