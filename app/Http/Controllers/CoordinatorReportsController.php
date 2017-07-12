<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Application;
use PDF;
class CoordinatorReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function index()
    {
        return view('SMS.Coordinator.Services.CoordinatorReports');
    }
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
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
