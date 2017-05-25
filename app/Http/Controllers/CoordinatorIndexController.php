<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CoordinatorIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('coordinator');
    }
    public function index()
    {
        return view('SMS.Coordinator.CoordinatorIndex');
    }
}
