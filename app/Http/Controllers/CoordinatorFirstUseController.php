<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Image;
use Carbon\Carbon;
use Hash;
use Config;
class CoordinatorFirstUseController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('first_use');
	}
	public function index()
	{
		return view('SMS.Coordinator.Services.CoordinatorRegister');
	}
	public function store(Request $request)
	{
		$this->validate($request, User::$storeRegister);
		try {
			$dtm = Carbon::now(Config::get('app.timezone'));
			$password = Hash::make($request->password);
			$user = User::find(Auth::id());
			$user->first_name = $request->first_name;
			$user->middle_name = $request->middle_name;
			$user->last_name = $request->last_name;
			$user->cell_no = $request->cell_no;
			$user->password = $password;
			$user->last_login = $dtm;
			if($request->file('image') != null)
			{
				$image = $request->file('image');
				$imagename = md5($user->email. time()).'.'.$image->getClientOriginalExtension();
				$location = public_path('images/'.$imagename);
				$user->picture = $imagename;
				Image::make($image)->resize(400,400)->save($location);
			}
			$user->save();
			return redirect(route('coordinator.index'));
		} catch(\Exception $e) {
			dd('Something went wrong!');
		}
	}
}
