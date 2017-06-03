<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class StudentIndexController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('student');
	}
	public function index()
	{
		return view('SMS.Student.StudentIndex');
	}
}
