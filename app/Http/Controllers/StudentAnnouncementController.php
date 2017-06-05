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
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function index()
    {
        $connection = Connection::join('users','user_councilor.user_id','users.id')
        ->select('user_councilor.councilor_id')
        ->where('user_councilor.user_id',Auth::id())
        ->first();
        $users = User::join('user_councilor','users.id','user_councilor.user_id')
        ->select('users.id')
        ->where('user_councilor.councilor_id',$connection->councilor_id)
        ->where('users.type','Coordinator')
        ->first();
        $announcement = Announcement::join('users','announcements.user_id','users.id')
        ->select('announcements.*','users.*')
        ->where('announcements.user_id',$users->id)
        ->orderBy('announcements.id','desc')
        ->paginate(10);
        return view('SMS.Student.StudentAnnouncement')->withAnnouncement($announcement);
    }
}
