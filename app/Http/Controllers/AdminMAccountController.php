<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Response;
use Datatables;
use DB;
use Carbon\Carbon;
class AdminMAccountController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}
	public function data()
	{   
		$user = User::select([DB::raw("CONCAT(last_name,', ',first_name,' ',IFNULL(middle_name,'')) as strUserName"),'users.*']);
		return Datatables::of($user)
		->addColumn('action', function ($data) {
			return "<button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
		})
		->filterColumn('strUserName', function($query, $keyword) {
			$query->whereRaw("CONCAT(last_name,', ',first_name,' ',IFNULL(middle_name,'')) like ?", ["%{$keyword}%"]);
		})
		->filterColumn('last_login', function($query, $keyword) {
			$query->whereRaw("DATE_FORMAT(last_login,'%M %d, %Y - %h:%i %A') like ?", ["%$keyword%"]);
		})
		->editColumn('last_login', function ($data) {
			if ($data->last_login != null)
				return $data->last_login ? with(new Carbon($data->last_login))->format('M d, Y - h:i A') : '';
			return 'Never Logged In';
		})
		->editColumn('strUserName', function ($data) {
			$images = url('images/'.$data->picture);
			return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
		})
		->editColumn('type', function ($data) {
			if ($data->type == 'Student') {
				$color = 'success';
			}elseif ($data->type == 'Admin') {
				$color = 'danger';
			}else {
				$color = 'warning';
			}
			return "<small class='label label-$color'>$data->type</small>";
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
		->rawColumns(['is_active','type','strUserName','action'])
		->make(true);
	}
	public function checkbox($id)
	{
		try {
			$user = User::findorfail($id);
			if ($user->is_active) {
				$user->is_active=0;
			}
			else{
				$user->is_active=1;
			}
			$user->save();
		} catch(\Exception $e) {
			return "Deleted";
		} 
	}
	public function index()
	{
		return view('SMS.Admin.Maintenance.AdminMAccount');
	}
	public function destroy($id)
	{
		$user = User::find($id);
		$user->is_active = 0;
		$user->save();
		$user->delete();
		return Response::json($user);
	}
}
