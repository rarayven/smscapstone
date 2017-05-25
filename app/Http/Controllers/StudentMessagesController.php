<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Message;
use App\Receiver;
use DB;
use Carbon\Carbon;
use Datatables;
use Session;
class StudentMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }
    public function inboxdata()
    {
        $message = Message::join('receivers','messages.id','receivers.message_id')
        ->join('users','messages.user_id','users.id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'users.*','messages.*'])
        ->where('receivers.user_id',Auth::id());
        $datatables = Datatables::of($message)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->editColumn('date_created', function ($data) {
            return $data->date_created ? with(new Carbon($data->date_created))->format('M d, Y - h:i A ') : '';
        })
        ->editColumn('description', function($data){
            return str_limit($data->description, 20);
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['strStudName','action']);
        return $datatables->make(true);
    }
    public function sentdata()
    {
        $message = Message::join('users','messages.user_id','users.id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'users.*','messages.*'])
        ->where('messages.user_id',Auth::id());
        $datatables = Datatables::of($message)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->editColumn('date_created', function ($data) {
            return $data->date_created ? with(new Carbon($data->date_created))->format('M d, Y - h:i A ') : '';
        })
        ->editColumn('description', function($data){
            return str_limit($data->description, 20);
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['strStudName','action']);
        return $datatables->make(true);
    }
    public function index()
    {
        return view('SMS.Student.Messages.StudentInbox');
    }
    public function sent()
    {
        return view('SMS.Student.Messages.StudentSent');
    }
    public function create()
    {
        $user = User::join('connections','users.id','connections.user_id')
        ->select('connections.councilor_id')
        ->where('connections.user_id',Auth::id())
        ->where('users.type','Student')
        ->first();
        $users = User::join('connections','users.id','connections.user_id')
        ->select('users.*')
        ->where('connections.councilor_id',$user->councilor_id)
        ->whereIn('users.type',['Student','Coordinator'])
        ->where('users.id','!=',Auth::id())
        ->where('users.is_active',1)
        ->get();
        return view('SMS.Student.Messages.StudentCompose')->withUsers($users);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $dtm = Carbon::now('Asia/Manila');
            $pdf = $request->file('pdf');
            $pdfname = md5(Auth::user()->email. time()).'.'.$pdf->getClientOriginalExtension();
            $message = new Message;
            $message->user_id = Auth::id();
            $message->title = $request->title;
            $message->description = $request->description;
            $message->pdf = $pdfname;
            $message->date_created = $dtm;
            $message->save();
            foreach ($request->receiver as $receive) {
                $receiver = new Receiver;
                $receiver->message_id = $message->id;
                $receiver->user_id = $receive;
                $receiver->save();
            }
            $pdf->move(base_path().'/public/docs/', $pdfname);
            Session::flash('success','Message successfully sent!');
            DB::commit();
            return redirect('/student/messages');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            dd($e);
            return dd($e->errorInfo[2]);
        }
    }
    public function show($id)
    {
        return view('SMS.Student.Messages.StudentRead');
    }
    public function destroy($id)
    {
        //delete here
    }
}
