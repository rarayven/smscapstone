<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Announcement;
use App\Connection;
use App\User;
use Auth;
class StudentAnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }
    public function index()
    {
        $connection = Connection::join('users','connections.user_id','users.id')
        ->select('connections.councilor_id')
        ->where('connections.user_id',Auth::id())
        ->first();
        $users = User::join('connections','users.id','connections.user_id')
        ->select('users.id')
        ->where('connections.councilor_id',$connection->councilor_id)
        ->where('users.type','Coordinator')
        ->first();
        $announcement = Announcement::where('user_id',$users->id)
        ->orderBy('id','desc')
        ->get();
        return view('SMS.Student.StudentAnnouncement')->withAnnouncement($announcement);
    }
}
