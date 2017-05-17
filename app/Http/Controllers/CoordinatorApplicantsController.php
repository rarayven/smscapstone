<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Studentsteps;
use App\User;
use DB;
class CoordinatorApplicantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    public function index()
    {
        $users = User::join('student_details','users.id','student_details.user_id')
        ->select('users.*','student_details.*')
        ->where('student_details.application_status','Pending')
        ->get();
        return view('SMS.Coordinator.Scholar.CoordinatorApplicants')->withUsers($users);
    }
    public function create()
    {
        //
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
