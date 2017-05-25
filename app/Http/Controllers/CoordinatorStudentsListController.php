<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Application;
use App\District;
use App\Councilor;
use App\Barangay;
use App\Course;
use App\School;
use App\Batch;
use Response;
use App\Connection;
use Auth;
use Datatables;
class CoordinatorStudentsListController extends Controller
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
        return view('SMS.Coordinator.Scholar.CoordinatorStudentsList')->withDistrict($district)->withCouncilor($councilor)->withBarangay($barangay)->withSchool($school)->withCourse($course)->withBatch($batch);
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
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'student_details.*','users.*'])
        ->where('users.type','Student')
        ->where('connections.councilor_id',$connections->id)
        ->where('student_details.application_status','Accepted');
        $datatables = Datatables::of($application)
        ->editColumn('checkbox', function ($data) {
            $checked = '';
            if($data->is_active==1){
                $checked = 'checked';
            }
            return "<input type='checkbox' id='isActive' name='isActive' value='$data->user_id' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on=\"<i class='fa fa-check-circle'></i> Active\" data-off=\"<i class='fa fa-times-circle'></i> Inactive\" $checked data-size='mini'><script>
            $('[data-toggle=\'toggle\']').bootstrapToggle('destroy');   
            $('[data-toggle=\'toggle\']').bootstrapToggle();</script>";
        })
        ->editColumn('student_status', function ($data) {
            if ($data->student_status == 'Graduated') {
                $color = 'success';
            }elseif ($data->student_status == 'Forfeit') {
                $color = 'danger';
            }else {
                $color = 'warning';
            }
            return "<small class='label label-$color'>$data->student_status</small>";
        })
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-info btn-xs open-modal'><i class='fa fa-eye'></i> View</button>";
        })
        ->editColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='User Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->user_id;
        })->rawColumns(['strStudName','student_status','checkbox','action']);
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
            $datatables->filterColumn('strStudName', 'whereRaw', "CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) like ? ", ["%$keyword%"]);
        }
        return $datatables->make(true);
    }
    public function update(Request $request, $id)
    {
        try
        {
            $user = User::findorfail($id);
            if ($user->is_active) {
                $user->is_active=0;
            }
            else{
                $user->is_active=1;
            }
            $user->save();
        }
        catch(\Exception $e) {
            try{
                if($e->errorInfo[1]==1062)
                    return "This Data Already Exists";
                else
                    return var_dump($e->errorInfo[1]);
            }
            catch(\Exception $e){
                return "Deleted";
            }
        } 
    }
}
