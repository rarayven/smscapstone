<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Allocation;
use App\Allocatebudget;
use Auth;
use DB;
use Response;
use App\Budgtype;
class StudentIndexController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('student');
	}
	public function index()
	{
		$allocation = Allocation::join('allocation_types','allocations.allocation_type_id','allocation_types.id')
		->leftJoin('user_allocation','allocations.id','user_allocation.allocation_id')
		->select('allocation_types.description','allocations.amount','user_allocation.id')
		->where('allocations.budget_id', function($query){
			$query->from('budgets')
			->select('id')
			->latest('id')
			->first();
		})
		->where('user_allocation.user_id',Auth::id())
		->get();
		return view('SMS.Student.StudentIndex')->withAllocation($allocation);
	}
}
