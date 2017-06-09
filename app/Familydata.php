<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Familydata extends Model
{
	protected $table = 'family_data';
	public $timestamps = false;
	public static $updateMInfo = [
	'motherfname' => 'required|max:25',
	'motherlname' => 'required|max:25',
	'mothercitizen' => 'required|max:25',
	'motherhea' => 'required|max:25',
	];
	public static $updateMOccu = [
	'motheroccupation' => 'required|max:25',
	'motherincome' => 'required|max:20',
	];
	public static $updateFInfo = [
	'fatherfname' => 'required|max:25',
	'fatherlname' => 'required|max:25',
	'fathercitizen' => 'required|max:25',
	'fatherhea' => 'required|max:25',
	];
	public static $updateFOccu = [
	'fatheroccupation' => 'required|max:25',
	'fatherincome' => 'required|max:20',
	];
}