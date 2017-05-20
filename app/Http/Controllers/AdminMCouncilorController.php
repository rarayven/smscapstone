<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Councilor;
use App\District;
use App\Connection;
use App\User;
use Response;
use DB;
use Datatables;
use Input;
use Validator;
class AdminMCouncilorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function data()
    {   
        $councilor = Councilor::join('districts', 'councilors.district_id','districts.id')
        ->select([DB::raw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',councilors.middle_name) as strCounName"),'councilors.*', 'districts.description as district_description']);
        return Datatables::of($councilor)
        ->filterColumn('strCounName', function($query, $keyword) {
            $query->whereRaw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',councilors.middle_name) like ?", ["%{$keyword}%"]);
        })
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('isActive', function ($data) {
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
        ->rawColumns(['strCounName','isActive','action'])
        ->make(true);
    }
    public function checkbox($id)
    {
        try
        {
            $councilor = Councilor::findorfail($id);
            if ($councilor->is_active) {
                $councilor->is_active=0;
            }
            else{
                $councilor->is_active=1;
            }
            $councilor->save();
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
    public function index()
    {
        $district = District::where('is_active',1)->pluck('description','id');
        return view('SMS.Admin.Maintenance.AdminMCouncilor')->withDistrict($district);
    }
    public function create()
    {
        return redirect('admin/maintenance/councilor');
    }
    public function store(Request $request)
    {
        Input::merge(array_map('trim', Input::all()));
        $validation = Validator::make(Input::all(), Councilor::$rules);
        if ($validation->fails()) {
            return "1";
        }
        $validation2 = Validator::make(Input::all(), Councilor::$email);
        if ($validation2->fails()) {
            return "2";
        }
        $validation3 = Validator::make(Input::all(), Councilor::$coordinator);
        if ($validation3->fails()) {
            return "3";
        }
        DB::beginTransaction();
        try
        {
            $randompassword = str_random(25);
            $randomnumber = str_random(15);
            $councilor = new Councilor;
            $councilor->first_name=$request->strCounFirstName;
            $councilor->middle_name=$request->strCounMiddleName;
            $councilor->last_name=$request->strCounLastName;
            $councilor->district_id=$request->intCounDistID;
            $councilor->email=$request->strCounEmail;
            $councilor->cell_no=$request->strCounCell;
            $councilor->save();
            $users = new User;
            $users->type='Coordinator';
            $users->password=$randompassword;
            $users->first_name=$randompassword;
            $users->middle_name=$randompassword;
            $users->last_name=$randompassword;
            $users->email=$request->strUserEmail;
            $users->cell_no=$randomnumber;
            $users->save();
            $connection = new Connection;
            $connection->user_id = $users->id;
            $connection->councilor_id = $councilor->id;
            $connection->save();
            DB::commit();
            return Response::json($councilor);
        }
        catch(\Exception $e) {
            DB::rollBack();
            if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else
                return var_dump($e->errorInfo[1]);
        } 
    }
    public function show($id)
    {
        try
        {
            $councilor = Councilor::join('districts','councilors.district_id','districts.id')
            ->select('councilors.*','districts.description as district_description')
            ->where('councilors.id',$id)
            ->firstorfail();
            return Response::json($councilor);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
    public function edit($id)
    {
        try
        {
            $councilor = Councilor::join('districts', 'councilors.district_id','districts.id')
            ->join('connections','connections.councilor_id','councilors.id')
            ->join('users','users.id','connections.user_id')
            ->select('councilors.*', 'districts.description as district_description', 'users.email as user_email')
            ->where('councilors.id',$id)
            ->firstorfail();
            return Response::json($councilor);
        }
        catch(\Exception $e)
        {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        Input::merge(array_map('trim', Input::all()));
        $validation = Validator::make(Input::all(), Councilor::updaterules($id));
        if ($validation->fails()) {
            return "1";
        }
        $validation2 = Validator::make(Input::all(), Councilor::updateemail($id));
        if ($validation2->fails()) {
            return "2";
        }
        $validation3 = Validator::make(Input::all(), Councilor::coordinator($id));
        if ($validation3->fails()) {
            return "3";
        }
        try
        {
            try
            {
                $councilor = Councilor::findorfail($id);
                $councilor->first_name=$request->strCounFirstName;
                $councilor->middle_name=$request->strCounMiddleName;
                $councilor->last_name=$request->strCounLastName;
                $councilor->district_id=$request->intCounDistID;
                $councilor->email=$request->strCounEmail;
                $councilor->cell_no=$request->strCounCell;
                $councilor->save();
                $connections = Connection::where('councilor_id',$id)
                ->select('user_id')
                ->first();
                $users = User::where('id',$connections->user_id)->where('type','Coordinator')
                ->update(['email' => $request->strUserEmail]);
                return Response::json($councilor);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1062)
                    return "This Data Already Exists";
                else
                    return var_dump($e->errorInfo[1]);
            } 
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function destroy($id)
    {
        try
        {
            $councilor = Councilor::findorfail($id);
            try
            {
                $councilor->delete();
                return Response::json($councilor);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$councilor]);
                else
                    return Response::json(['true',$councilor,$e->errorInfo[1]]);
            }
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
}
