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
use Validator;
use Hash;
use Image;
class AdminMCouncilorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function data()
    {   
        $councilor = Councilor::join('districts', 'councilors.district_id','districts.id')
        ->select([DB::raw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',IFNULL(councilors.middle_name,'')) as strCounName"),'councilors.*', 'districts.description as district_description']);
        return Datatables::of($councilor)
        ->filterColumn('strCounName', function($query, $keyword) {
            $query->whereRaw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',IFNULL(councilors.middle_name,'')) like ?", ["%{$keyword}%"]);
        })
        ->editColumn('strCounName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
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
        ->rawColumns(['strCounName','is_active','action'])
        ->make(true);
    }
    public function checkbox($id)
    {
        try {
            $councilor = Councilor::findorfail($id);
            if ($councilor->is_active) {
                $councilor->is_active=0;
            }
            else{
                $councilor->is_active=1;
            }
            $councilor->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function index()
    {
        $district = District::where('is_active',1)->pluck('description','id');
        return view('SMS.Admin.Maintenance.AdminMCouncilor')->withDistrict($district);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Councilor::$storeRule);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        DB::beginTransaction();
        try {
            // $randompassword = str_random(25);
            //Image Upload
            $image = $request->file('image');
            $imagename = md5($request->strCounEmail. time()).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$imagename);
            $randompassword = Hash::make('password');
            $randomnumber = str_random(15);
            $councilor = new Councilor;
            $councilor->first_name=$request->strCounFirstName;
            $councilor->middle_name=$request->strCounMiddleName;
            $councilor->last_name=$request->strCounLastName;
            $councilor->district_id=$request->intCounDistID;
            $councilor->email=$request->strCounEmail;
            $councilor->cell_no=$request->strCounCell;
            $councilor->picture=$imagename;
            $councilor->save();
            $users = new User;
            $users->type='Coordinator';
            $users->password=$randompassword;
            $users->first_name=$randomnumber;
            $users->middle_name=$randomnumber;
            $users->last_name=$randomnumber;
            $users->email=$request->strUserEmail;
            $users->cell_no=$randomnumber;
            $users->save();
            $connection = new Connection;
            $connection->user_id = $users->id;
            $connection->councilor_id = $councilor->id;
            $connection->save();
            Image::make($image)->resize(400,400)->save($location);
            DB::commit();
            return Response::json($councilor);
        } catch(\Exception $e) {
            DB::rollBack();
            return var_dump($e->getMessage());
        } 
    }
    public function show($id)
    {
        try {
            $councilor = Councilor::join('districts','councilors.district_id','districts.id')
            ->join('user_councilor','councilors.id','user_councilor.councilor_id')
            ->join('users','user_councilor.user_id','users.id')
            ->select(DB::raw("CONCAT(councilors.last_name,', ',councilors.first_name,' ',IFNULL(councilors.middle_name,'')) as strCounName"),'councilors.*','districts.description as district_description','users.email as user_email')
            ->where('councilors.id',$id)
            ->firstorfail();
            return Response::json($councilor);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function edit($id)
    {
        try {
            $councilor = Councilor::join('districts', 'councilors.district_id','districts.id')
            ->join('user_councilor','user_councilor.councilor_id','councilors.id')
            ->join('users','users.id','user_councilor.user_id')
            ->select('councilors.*', 'districts.description as district_description', 'users.email as user_email')
            ->where('councilors.id',$id)
            ->firstorfail();
            return Response::json($councilor);
        } catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $connection = Connection::join('users','user_councilor.user_id','users.id')
            ->select('users.id')
            ->where('user_councilor.councilor_id',$id)
            ->where('users.type','Coordinator')
            ->first();
        } catch(\Exception $e){
            dd("Error");
        }
        $validator = Validator::make($request->all(), Councilor::updaterules($id, $connection->id));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            try {
                if ($request->file('image')!='') {
                    $image = $request->file('image');
                    $imagename = md5($request->strCounEmail. time()).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/'.$imagename);
                }
                $councilor = Councilor::findorfail($id);
                $councilor->first_name=$request->strCounFirstName;
                $councilor->middle_name=$request->strCounMiddleName;
                $councilor->last_name=$request->strCounLastName;
                $councilor->district_id=$request->intCounDistID;
                $councilor->email=$request->strCounEmail;
                $councilor->cell_no=$request->strCounCell;
                if ($request->file('image')!='') {
                    $councilor->picture=$imagename;
                }
                $councilor->save();
                $connections = Connection::where('councilor_id',$id)
                ->select('user_id')
                ->first();
                $users = User::where('id',$connections->user_id)->where('type','Coordinator')
                ->update(['email' => $request->strUserEmail]);
                if ($request->file('image')!='') {
                    Image::make($image)->resize(400,400)->save($location);
                }
                return Response::json($councilor);
            } catch(\Exception $e) {
                return var_dump($e->getMessage());
            } 
        } catch(\Exception $e) {
            return Response::json("The record is invalid or deleted.", 422);
        }
    }
    public function destroy($id)
    {
        try {
            $connection = Connection::join('users','user_councilor.user_id','users.id')
            ->where('user_councilor.councilor_id',$id)
            ->where('users.type','Coordinator')
            ->where('users.deleted_at','!=',null)
            ->select('users.id')
            ->firstorfail();
            try {
                $councilor = Councilor::findorfail($id);
                $councilor->is_active = 0;
                $councilor->save();
                $councilor->delete();
                return Response::json($councilor);
            } catch(\Exception $e) {
                if($e->getCode()==1451)
                    return Response::json(['true',$councilor]);
                else
                    return Response::json(['true',$councilor,$e->getMessage()]);
            }
        } catch(\Exception $e) {
            $councilor = Councilor::find($id);
            return Response::json(['true',$councilor]);
        }
    }
}
