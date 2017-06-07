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
use Response;
use Config;
class StudentMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    public function checkbox($id)
    {
        try {
            $receiver = Receiver::findorfail($id);
            if ($receiver->is_read) {
                $receiver->is_read=0;
            }
            else {
                $receiver->is_read=1;
            }
            $receiver->save();
        } catch(\Exception $e) {
            return "Deleted";
        } 
    }
    public function inboxdata()
    {
        $message = Message::withTrashed()
        ->join('user_message','messages.id','user_message.message_id')
        ->join('users','messages.user_id','users.id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',IFNULL(users.middle_name,'')) as strStudName"),'users.*','messages.*','user_message.id as receivers_id','user_message.is_read'])
        ->where('user_message.deleted_at',null)
        ->where('user_message.user_id',Auth::id());
        $datatables = Datatables::of($message)
        ->filterColumn('strStudName', function($query, $keyword) {
            $query->whereRaw("CONCAT(users.last_name,', ',users.first_name,' ',IFNULL(users.middle_name,'')) like ?", ["%{$keyword}%"]);
        })
        ->addColumn('action', function ($data) {
            return "<a href=".route('studentmessage.reply',$data->user_id)."><button class='btn btn-success btn-xs btn-view' value='$data->id'><i class='fa fa-reply'></i> Reply</button></a> <a href=".route('studentmessage.show',$data->receivers_id)."><button class='btn btn-info btn-xs btn-view' value='$data->receivers_id'><i class='fa fa-eye'></i> View</button></a> <button class='btn btn-danger btn-xs btn-delete' value='$data->receivers_id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('is_read', function ($data) {
            $checked = '';
            if($data->is_read==1){
                $checked = 'checked';
            }
            return "<input type='checkbox' id='isActive' name='isActive' value='$data->receivers_id' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='warning' data-on=\"<i class='fa fa-envelope-o'></i> Read\" data-off=\"<i class='fa fa-envelope'></i> Unread\" $checked data-size='mini'><script>
            $('[data-toggle=\'toggle\']').bootstrapToggle('destroy');   
            $('[data-toggle=\'toggle\']').bootstrapToggle();</script>";
        })
        ->addColumn('strStudName', function ($data) {
            $images = url('images/'.$data->picture);
            return "<table><tr><td><div class='col-md-2'><img src='$images' class='img-circle' alt='data Image' height='40'></div></td><td>$data->last_name, $data->first_name $data->middle_name</td></tr></table>";
        })
        ->editColumn('date_created', function ($data) {
            return $data->date_created ? with(new Carbon($data->date_created))->format('M d, Y - h:i A ') : '';
        })
        ->editColumn('type', function ($data) {
            if ($data->type == 'Student') {
                $color = 'success';
            }elseif ($data->type == 'Admin') {
                $color = 'danger';
            }else {
                $color = 'warning';
            }
            return "<small class='label label-$color'>$data->type</small>";
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->receivers_id;
        })
        ->rawColumns(['is_read','strStudName','type','action']);
        return $datatables->make(true);
    }
    public function sentdata()
    {
        $message = Message::where('user_id',Auth::id());
        $datatables = Datatables::of($message)
        ->addColumn('action', function ($data) {
            return "<a href=".route('studentmessage.showsent',$data->id)."><button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button></a> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
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
        ->rawColumns(['action']);
        return $datatables->make(true);
    }
    public function unreadmessage()
    {
        $count = Receiver::where('is_read',0)
        ->where('user_id',Auth::id())        
        ->count();
        return Response::json($count);
    }
    public function reply($id)
    {
        $user = User::find($id);
        return view('SMS.Student.Messages.StudentReply')->withUser($user);
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
        $user = User::join('user_councilor','users.id','user_councilor.user_id')
        ->select('user_councilor.councilor_id')
        ->where('user_councilor.user_id',Auth::id())
        ->where('users.type','Student')
        ->first();
        $users = User::join('user_councilor','users.id','user_councilor.user_id')
        ->select('users.*')
        ->where('user_councilor.councilor_id',$user->councilor_id)
        ->whereIn('users.type',['Student','Coordinator'])
        ->where('users.id','!=',Auth::id())
        ->where('users.is_active',1)
        ->get();
        return view('SMS.Student.Messages.StudentCompose')->withUsers($users);
    }
    public function store(Request $request)
    {
        $this->validate($request, Message::$storeRule);
        DB::beginTransaction();
        try {
            $dtm = Carbon::now(Config::get('app.timezone'));
            $message = new Message;
            $message->user_id = Auth::id();
            $message->title = $request->title;
            $message->description = $request->description;
            $message->date_created = $dtm;
            if ($request->file('pdf')!='') {
                $pdf = $request->file('pdf');
                $pdfname = md5(Auth::user()->email. time()).'.'.$pdf->getClientOriginalExtension();
                $message->pdf = $pdfname;
            }
            $message->save();
            foreach ($request->receiver as $receive) {
                $receiver = new Receiver;
                $receiver->message_id = $message->id;
                $receiver->user_id = $receive;
                $receiver->save();
            }
            if ($request->file('pdf')!='') {
                $pdf->move(base_path().'/public/docs/', $pdfname);
            }
            Session::flash('success','Message successfully sent!');
            DB::commit();
            return redirect(route('studentmessage.index'));
        } catch(\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
    public function show($id)
    {
        try {
            $receiver = Receiver::where('id',$id)
            ->where('user_id',Auth::id())
            ->firstorfail();
            $receiver->is_read = 1;
            $receiver->save();
            $message = Message::join('users','messages.user_id','users.id')
            ->select('messages.*','users.*','users.id as sender')
            ->where('messages.id',$receiver->message_id)
            ->first();
            return view('SMS.Student.Messages.StudentRead')->withMessage($message);
        } catch(\Exception $e) {
            return redirect(route('studentmessage.index'));
        }
    }
    public function destroy($id)
    {
        $receiver = Receiver::find($id);
        $receiver->is_read = 1;
        $receiver->save();
        $receiver->delete();
        $message = Message::find($receiver->message_id);
        return Response::json($message);
    }
    public function showsent($id)
    {
        try {
            $message = Message::join('users','messages.user_id','users.id')
            ->select('messages.*','users.*')
            ->where('messages.id',$id)
            ->where('user_id',Auth::id())
            ->where('messages.is_deleted',0)
            ->firstorfail();
            $users = User::join('user_message','users.id','user_message.user_id')
            ->select('users.*')
            ->where('user_message.message_id',$id)
            ->get();
            return view('SMS.Student.Messages.StudentSentRead')->withMessage($message)->withUsers($users);
        } catch(\Exception $e) {
            return redirect(route('studentmessage.sent'));
        }
    }
    public function destroysent($id)
    {
        $message = Message::find($id);
        $message->delete();
        return Response::json($message);
    }
}
