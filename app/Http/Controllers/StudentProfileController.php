<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\User;
use App\Application;
use App\Familydata;
use Image;
use Validator;
use Hash;
use Carbon\Carbon;
class StudentProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function index()
    {
        $application = Application::find(Auth::id());
        $mother = Familydata::where('student_detail_user_id',Auth::id())
        ->where('member_type',0)
        ->first();
        $father = Familydata::where('student_detail_user_id',Auth::id())
        ->where('member_type',1)
        ->first();
        return view('SMS.Student.StudentProfile')->withApplication($application)->withMother($mother)->withFather($father);
    }
    public function name(Request $request)
    {
        $validator = Validator::make($request->all(), User::updateName(Auth::id()));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $user = User::find(Auth::id());
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->save();
        return Response::json($user);
    }
    public function email(Request $request)
    {
        $validator = Validator::make($request->all(), User::updateEmail(Auth::id()));
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->save();
        return Response::json($user);
    }
    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), User::$updateCell);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $user = User::find(Auth::id());
        $user->cell_no = $request->cell_no;
        $user->save();
        return Response::json($user);
    }
    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), User::$updatePassword);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $user = User::find(Auth::id());
        if (!Hash::check($request->current_password, $user->password)) {
            return Response::json('Password Mismatch to the Record', 422);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return Response::json($user);
    }
    public function image(Request $request)
    {
        $validator = Validator::make($request->all(), User::$updateImage);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        try {
            $image = $request->file('image');
            $imagename = md5(Auth::user()->picture. time()).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$imagename);
            $user = User::find(Auth::id());
            $user->picture = $imagename;
            $user->save();
            Image::make($image)->resize(400,400)->save($location);
            return Response::json($user);
        } catch(\Exception $e) {
            return dd($e->getMessage());
        }  
    }
    public function birthday(Request $request)
    {
        $validator = Validator::make($request->all(), Application::$updateBirthday);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $birthday = Application::find(Auth::id());
        $birthday->birthday = Carbon::createFromFormat('Y-m-d', $request->birthday);
        $birthday->save();
        return Response::json($birthday);
    }
    public function minfo(Request $request)
    {
        $validator = Validator::make($request->all(), Familydata::$updateMInfo);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $mother = Familydata::where('student_detail_user_id',Auth::id())->where('member_type',0)->first();
        $mother->first_name = $request->motherfname;
        $mother->last_name = $request->motherlname;
        $mother->citizenship = $request->mothercitizen;
        $mother->highest_ed = $request->motherhea;
        $mother->save();
        return Response::json($mother);
    }
    public function moccu(Request $request)
    {
        $validator = Validator::make($request->all(), Familydata::$updateMOccu);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $mother = Familydata::where('student_detail_user_id',Auth::id())->where('member_type',0)->first();
        $mother->occupation = $request->motheroccupation;
        $mother->monthly_income = $request->motherincome;
        $mother->save();
        return Response::json($mother);
    }
    public function finfo(Request $request)
    {
        $validator = Validator::make($request->all(), Familydata::$updateFInfo);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $father = Familydata::where('student_detail_user_id',Auth::id())->where('member_type',1)->first();
        $father->first_name = $request->fatherfname;
        $father->last_name = $request->fatherlname;
        $father->citizenship = $request->fathercitizen;
        $father->highest_ed = $request->fatherhea;
        $father->save();
        return Response::json($father);
    }
    public function foccu(Request $request)
    {
        $validator = Validator::make($request->all(), Familydata::$updateFOccu);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $father = Familydata::where('student_detail_user_id',Auth::id())->where('member_type',1)->first();
        $father->occupation = $request->fatheroccupation;
        $father->monthly_income = $request->fatherincome;
        $father->save();
        return Response::json($father);
    }
    public function siblings(Request $request)
    {
        $validator = Validator::make($request->all(), Application::$updateSiblings);
        if ($validator->fails()) {
            return Response::json($validator->errors()->first(), 422);
        }
        $siblings = Application::find(Auth::id());
        $siblings->brothers = $request->intPersBrothers;
        $siblings->sisters = $request->intPersSisters;
        $siblings->save();
        return Response::json($siblings);
    }
}
