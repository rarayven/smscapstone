<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
class SmartCounter extends Controller
{
	public function increment($type)
	{
		$users = User::where('type',$type)->latest('id')->first();
		if (is_null($users)) {
			$users = (object)['id' => ''];
		}
		$string = $users->id;
		$date = Carbon::now();
		$number = substr($string,5,-2);
		$new = ltrim($number, '0');
		$increment = str_pad(++$new, 5, '0', STR_PAD_LEFT);
		if ($type == 'Admin') {
			$type = 0;
		} elseif ($type == 'Coordinator') {
			$type = 1;
		} else {
			$type = 2;
		}
		$string = $date->year.'-'.$increment.'-'.$type;
		return $string;
	}
}
