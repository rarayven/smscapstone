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
class CoordinatorMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    public function checkbox($id)
    {
        try
        {
            $receiver = Receiver::findorfail($id);
            if ($receiver->is_read) {
                $receiver->is_read=0;
            }
            else{
                $receiver->is_read=1;
            }
            $receiver->save();
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
    public function inboxdata()
    {
        $message = Message::join('receivers','messages.id','receivers.message_id')
        ->join('users','messages.user_id','users.id')
        ->select([DB::raw("CONCAT(users.last_name,', ',users.first_name,' ',users.middle_name) as strStudName"),'users.*','messages.*','receivers.id as receivers_id','receivers.is_read'])
        ->where('receivers.is_deleted',0)
        ->where('receivers.user_id',Auth::id());
        $datatables = Datatables::of($message)
        ->addColumn('action', function ($data) {
            return "<a href=".route('studentmessage.reply',$data->user_id)."><button class='btn btn-success btn-xs btn-view' value='$data->id'><i class='fa fa-reply'></i> Reply</button></a> <a href=".route('coordinatormessage.show',$data->receivers_id)."><button class='btn btn-info btn-xs btn-view' value='$data->receivers_id'><i class='fa fa-eye'></i> View</button></a> <button class='btn btn-danger btn-xs btn-delete' value='$data->receivers_id'><i class='fa fa-trash-o'></i> Delete</button>";
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
        ->editColumn('description', function($data){
            return str_limit($data->description, 20);
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->receivers_id;
        })
        ->rawColumns(['is_read','strStudName','action']);
        return $datatables->make(true);
    }
    public function sentdata()
    {
        $message = Message::where('user_id',Auth::id())
        ->where('is_deleted',0);
        $datatables = Datatables::of($message)
        ->addColumn('action', function ($data) {
            return "<a href=".route('coordinatormessage.showsent',$data->id)."><button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button></a> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
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
        ->where('is_deleted',0)
        ->count();
        return Response::json($count);
    }
    public function reply($id)
    {
        $user = User::find($id);
        return view('SMS.Coordinator.Services.Messages.CoordinatorReply')->withUser($user);
    }
    public function index()
    {
        return view('SMS.Coordinator.Services.Messages.CoordinatorInbox');
    }
    public function sent()
    {
        return view('SMS.Coordinator.Services.Messages.CoordinatorSent');
    }
    public function create()
    {
        $user = User::join('connections','users.id','connections.user_id')
        ->select('connections.councilor_id')
        ->where('connections.user_id',Auth::id())
        ->where('users.type','Coordinator')
        ->first();
        $users = User::join('connections','users.id','connections.user_id')
        ->select('users.*')
        ->where('connections.councilor_id',$user->councilor_id)
        ->where('users.type','Student')
        ->where('users.is_active',1)
        ->get();
        return view('SMS.Coordinator.Services.Messages.CoordinatorCompose')->withUsers($users);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $dtm = Carbon::now('Asia/Manila');
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
            return redirect(route('coordinatormessage.index'));
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
        try
        {
            $receiver = Receiver::where('id',$id)
            ->where('is_deleted',0)
            ->where('user_id',Auth::id())
            ->firstorfail();
            $receiver->is_read = 1;
            $receiver->save();
            $message = Message::join('users','messages.user_id','users.id')
            ->select('messages.*','users.*','users.id as sender')
            ->where('messages.id',$receiver->message_id)
            ->first();
            return view('SMS.Coordinator.Services.Messages.CoordinatorRead')->withMessage($message);
        }catch(\Exception $e){
            return redirect(route('coordinatormessage.index'));
        }
    }
    public function destroy($id)
    {
        try
        {
            $receiver = Receiver::findorfail($id);
            try
            {
                $receiver->is_deleted = 1;
                $receiver->save();
                $message = Message::find($receiver->message_id);
                return Response::json($message);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$receiver]);
                else
                    return Response::json(['true',$receiver,$e->errorInfo[1]]);
            }
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
    public function showsent($id)
    {
        try
        {
            $message = Message::join('users','messages.user_id','users.id')
            ->select('messages.*','users.*')
            ->where('messages.id',$id)
            ->where('user_id',Auth::id())
            ->where('messages.is_deleted',0)
            ->firstorfail();
            $users = User::join('receivers','users.id','receivers.user_id')
            ->select('users.*')
            ->where('receivers.message_id',$id)
            ->get();
            return view('SMS.Coordinator.Services.Messages.CoordinatorSentRead')->withMessage($message)->withUsers($users);
        }catch(\Exception $e){
            return redirect(route('coordinatormessage.sent'));
        }
    }
    public function destroysent($id)
    {
        try
        {
            $message = Message::findorfail($id);
            try
            {
                $message->is_deleted = 1;
                $message->save();
                return Response::json($message);
            }
            catch(\Exception $e) {
                if($e->errorInfo[1]==1451)
                    return Response::json(['true',$message]);
                else
                    return Response::json(['true',$message,$e->errorInfo[1]]);
            }
        } 
        catch(\Exception $e) {
            return "Deleted";
        }
    }
}
