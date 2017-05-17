<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Allocation;
use Carbon\Carbon;
use Response;
class CoordinatorBudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allocation = Allocation::orderBy('intAlloID', 'desc')
        ->paginate(10);
        return view('SMS.Coordinator.Services.CoordinatorBudget')->withAllocation($allocation);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current = Carbon::now('Asia/Manila');
        $allocation = new Allocation;
        $allocation->intAlloCoorID=$request->intAlloCoorID;
        $allocation->dblAlloBudgetAmount=$request->dblAlloBudgetAmount;
        $allocation->intAlloSlotsNumber=$request->intAlloSlotsNumber;
        $allocation->dblAlloStudAllowance=$request->dblAlloStudAllowance;
        $allocation->dblAlloStudTuition=$request->dblAlloStudTuition;
        $allocation->dtmAlloBudgDate=$current;
        $allocation->save();
        return Response::json($allocation);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
