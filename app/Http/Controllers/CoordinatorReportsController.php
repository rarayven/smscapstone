<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Application;
use PDF;
class CoordinatorReportsController extends Controller
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
        return view('SMS.Coordinator.Services.CoordinatorReports');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $application = Application::join('users','student_details.user_id','users.id')
        ->join('current_colleges','student_details.user_id','current_colleges.student_detail_user_id')
        ->join('schools','current_colleges.school_id','schools.id')
        ->select('users.*','schools.description')
        ->where('student_details.application_status','Accepted')->get();
        // return view('SMS.Coordinator.Reports.CoordinatorStudentReport')->withApplication($application);
        view()->share('application',$application);
        // $pdf = PDF::loadHTML('<h1>Test</h1>');
        $pdf = PDF::loadView('SMS.Coordinator.Reports.CoordinatorStudentReport', $application);
        return $pdf->stream();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
