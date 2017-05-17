<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Councilor;
use App\Users;
class SMSAccountCoordinatorController extends Controller
{
    public function index()
    {
        $councilor = Councilor::where('isActive',1)->get();
        return view('SMS.Account.SMSAccountCoordinator')->withCouncilor($councilor);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $users = new Users;
        $users->intUserCounID=$request->intUserCounID;
        $users->UserType='Coordinator';
        $users->strUserUserName=$request->strUserUserName;
        $users->strUserPassword=$request->strUserPassword;
        $users->strUserFirstName=$request->strUserFirstName;
        $users->strUserLastName=$request->strUserLastName;
        $users->strUserMiddleName=$request->strUserMiddleName;
        $users->strUserEmail=$request->strUserEmail;
        $users->strUserCell=$request->strUserCell;
        $users->save();
        return view('SMS.SMSIndex');
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
