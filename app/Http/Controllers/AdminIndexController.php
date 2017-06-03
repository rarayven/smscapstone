<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AdminIndexController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}
	public function index()
	{
		return view('SMS.Admin.AdminIndex');
	}
}
