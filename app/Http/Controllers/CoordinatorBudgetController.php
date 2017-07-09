<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Allocation;
use App\Budget;
use Carbon\Carbon;
use Response;
use Datatables;
use Config;
use App\Connection;
use App\Budgtype;
use Auth;
use DB;
class CoordinatorBudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function data()
    {   
        $budget = Budget::where('user_id',Auth::id());
        return Datatables::of($budget)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('budget_date', function ($data) {
            return $data->budget_date ? with(new Carbon($data->budget_date))->format('M d, Y - h:i A') : '';
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function index()
    {
        $budgtype = Budgtype::where('is_active',1)->get();
        return view('SMS.Coordinator.Services.CoordinatorBudget')->withBudgtype($budgtype);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $connection = Connection::where('user_id',Auth::id())->first();
            $ctr = 0;
            $budget = new Budget;
            $budget->user_id=Auth::id();
            $budget->councilor_id = $connection->councilor_id;
            $budget->amount=$request->budget_amount;
            $budget->budget_per_student=$request->budget_per_student;
            $budget->slot_count=$request->slot_count;
            $budget->budget_date=Carbon::now(Config::get('app.timezone'));
            $budget->save();
            foreach ($request->amount as $amount) {
                $allocation = new Allocation;
                $allocation->budget_id = $budget->id;
                $allocation->allocation_type_id = $request->id[$ctr];
                $allocation->amount = $amount;
                $allocation->save();
                $ctr++;
            }
            DB::commit();
            return Response::json($budget);
        } catch(\Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(),500);
        } 
    }
    public function show($id)
    {
        $allocation = Allocation::join('budgets','allocations.budget_id','budgets.id')
        ->join('allocation_types','allocations.allocation_type_id','allocation_types.id')
        ->select('budgets.*','allocations.amount as allocation_amount','allocation_types.*')
        ->where('allocations.budget_id',$id)
        ->get();
        return Response::json($allocation);
    }
    public function edit($id)
    {
        $allocation = Allocation::join('budgets','allocations.budget_id','budgets.id')
        ->join('allocation_types','allocations.allocation_type_id','allocation_types.id')
        ->select('budgets.*','allocations.amount as allocation_amount','allocation_types.id as allocation_id')
        ->get();
        return Response::json($allocation);
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $connection = Connection::where('user_id',Auth::id())->first();
            $ctr = 0;
            $budget = Budget::find($id);
            $budget->councilor_id = $connection->councilor_id;
            $budget->amount=$request->budget_amount;
            $budget->budget_per_student=$request->budget_per_student;
            $budget->slot_count=$request->slot_count;
            $budget->budget_date=Carbon::now(Config::get('app.timezone'));
            $budget->save();
            $allo = Allocation::where('budget_id',$budget->id)->delete();
            foreach ($request->amount as $amount) {
                $allocation = new Allocation;
                $allocation->budget_id = $budget->id;
                $allocation->allocation_type_id = $request->id[$ctr];
                $allocation->amount = $amount;
                $allocation->save();
                $ctr++;
            }
            $allo = Budget::latest('id')->first();
            DB::commit();
            return Response::json($allo);
        } catch(\Exception $e) {
            DB::rollBack();
            return Response::json($e->getMessage(),500);
        } 
    }
    public function destroy($id)
    {
        $allocation = Allocation::where('budget_id',$id)->delete();
        $budget = Budget::find($id);
        $budget->delete();
        $allo = Budget::latest('id')->first();
        return Response::json($allo);
    }
}
