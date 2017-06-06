<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Announcement;
use Datatables;
use Auth;
use DB;
use Response;
use App\Connection;
use App\Notification;
use Carbon\Carbon;
class CoordinatorAnnouncementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
    public function data()
    {   
        $announcement = Announcement::where('user_id',Auth::id());
        return Datatables::of($announcement)
        ->addColumn('action', function ($data) {
            return "<button class='btn btn-info btn-xs btn-pdf' value='$data->id'><i class='fa fa-file-pdf-o'></i> PDF</button> <button class='btn btn-warning btn-xs btn-detail open-modal' value='$data->id'><i class='fa fa-edit'></i> Edit</button> <button class='btn btn-danger btn-xs btn-delete' value='$data->id'><i class='fa fa-trash-o'></i> Delete</button>";
        })
        ->editColumn('date_post', function ($data) {
            return $data->date_post ? with(new Carbon($data->date_post))->format('M d, Y - h:i A ') : '';
        })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function index()
    {
        return view('SMS.Coordinator.Services.CoordinatorAnnouncements');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $connection = Connection::where('user_id',Auth::id())
            ->select('councilor_id')
            ->first();
            $getScholar = Connection::join('users','user_councilor.user_id','users.id')
            ->where('user_councilor.councilor_id',$connection->councilor_id)
            ->where('users.type','Student')
            ->select('users.id')
            ->get();
            $dtm = Carbon::now('Asia/Manila');
            $announcement = new Announcement;
            $announcement->user_id = Auth::id();
            $announcement->title = $request->title;
            $announcement->description = $request->description;
            $announcement->date_post = $dtm;
            if ($request->file('pdf')!='') {
                $pdf = $request->file('pdf');
                $pdfname = md5(Auth::user()->email. time()).'.'.$pdf->getClientOriginalExtension();
                $announcement->pdf = $pdfname;
            }
            $announcement->save();
            foreach ($getScholar as $data) {
                $notification = new Notification;
                $notification->user_id = $data->id;
                $notification->announcement_id = $announcement->id;
                $notification->save();
            }
            if ($request->file('pdf')!='') {
                $pdf->move(base_path().'/public/docs/', $pdfname);
            }
            DB::commit();
            return Response::json($announcement);
        } catch(\Exception $e) {
            DB::rollBack();
            dd($e);
        }  
    }
}
