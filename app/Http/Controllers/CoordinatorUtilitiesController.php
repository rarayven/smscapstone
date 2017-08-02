<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Application;
use Auth;
use DB;
use App\Requirement;
use Response;
use App\Allocation;
use App\Grade;
use App\Studentsteps;
use App\Allocatebudget;
use App\Budgtype;
use App\UserAllocationType;
use App\Utility;
class CoordinatorUtilitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function checkbox($id)
    {
        try {
            $type = UserAllocationType::where('user_id',Auth::id())->where('allocation_type_id',$id)->firstorfail();
            $type->delete();
        } catch(\Exception $e) {
            $type = new UserAllocationType;
            $type->allocation_type_id = $id;
            $type->user_id = Auth::id();
            $type->save();
        }
        return Response::json(200);
    }
    public function index()
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
        ->get();
        $claiming = Budgtype::leftJoin('user_allocation_type','allocation_types.id','user_allocation_type.allocation_type_id')
        ->select('allocation_types.*','user_allocation_type.allocation_type_id')
        ->where('allocation_types.is_active',1)
        ->get();
        return view('SMS.Coordinator.Services.CoordinatorUtilities')->withApplication($application)->withClaiming($claiming);
    }
    public function create($id)
    {
        $step = Requirement::whereIn('id', function($query) use($id) {
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
        ->whereIn('allocations.id', function($query) use($id) {
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
                $steps = Studentsteps::where('user_id',$id)
                ->where('requirement_id',$step)
                ->where('grade_id',$grade->id)
                ->delete();
            }
            $application = Application::find($id);
            $application->is_steps_done = 0;
            $application->save();
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
                $allocate = Allocatebudget::where('user_id',$id)
                ->where('allocation_id',$claim)
                ->where('grade_id',$grade->id)
                ->delete();
            }
            DB::commit();
            return Response::json($grade);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::json('Input must not be nulled',500);
        }
    }
    public function question(Request $request)
    {
        $utility = new Utility;
        $utility->user_id = Auth::id();
        $utility->essay = $request->essay;
        $utility->save();
        return redirect(route('coordinatorutilities.index'));
    }
}
