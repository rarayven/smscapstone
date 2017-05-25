<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
class SMSIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        return view('SMS.SMSIndex');
    }
}
