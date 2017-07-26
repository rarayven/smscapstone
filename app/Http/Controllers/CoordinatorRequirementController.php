<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Requirement;
use Response;
use Datatables;
use Validator;
use DB;
use Auth;
class CoordinatorRequirementController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('coordinator');
	}
	public function data()
	{   
		$steps = Requirement::where('user_id',Auth::id());
		return Datatables::of($steps)
		->addColumn('action', function ($data) {
			return "<button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
		})
		->editColumn('type', function ($data) {
			$type = 'Applications';
			if ($data->type) {
				$type = 'Renewal';
			}
			return $type;
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
			$steps = Requirement::findorfail($id);
			if ($steps->is_active) {
				$steps->is_active=0;
			}
			else {
				$steps->is_active=1;
			}
			$steps->save();
			return Response::json($steps);
		} catch(\Exception $e) {
			return "Deleted";
		} 
	}
	public function index()
	{
		return view('SMS.Coordinator.Services.CoordinatorRequirements');
	}
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), Requirement::$storeRule);
		if ($validator->fails()) {
			return Response::json($validator->errors()->first(), 422);
		}
		try {
			$steps = new Requirement;
			$steps->description=$request->strStepDesc;
			$steps->type=$request->type;
			$steps->user_id = Auth::id();
			$steps->save();
			return Response::json($steps);
		} catch(\Exception $e) {
			return var_dump($e->getMessage());
		} 
	}
	public function edit($id)
	{
		try {
			$steps = Requirement::findorfail($id);
			return Response::json($steps);
		} catch(\Exception $e) {
			return "Deleted";
		}
	}
	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), Requirement::updateRule($id));
		if ($validator->fails()) {
			return Response::json($validator->errors()->first(), 422);
		}
		try {
			try {
				$steps = Requirement::findorfail($id);
				$steps->description = $request->strStepDesc;
				$steps->type=$request->type;
				$steps->save();
				return Response::json($steps);
			} catch(\Exception $e) {
				return var_dump($e->getMessage());
			}
		} catch(\Exception $e) {
			return Response::json("The record is invalid or deleted.", 422);
		}  
	}
	public function destroy($id)
	{
		try {
			$steps = Requirement::findorfail($id);
			try {
				$steps->delete();
				return Response::json($steps);
			} catch(\Exception $e) {
				if($e->getCode()==1451)
					return Response::json(['true',$steps]);
				else
					return Response::json(['true',$steps,$e->getMessage()]);
			}
		} catch(\Exception $e) {
			return "Deleted";
		}
	}
}
