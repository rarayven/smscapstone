<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\User;
use Image;
use Validator;
use Hash;
class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index()
    {
        return view('SMS.Admin.Services.AdminProfile');
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
}
