<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Event extends Model
{
	public $timestamps = false;
	use SoftDeletes;
	protected $dates = ['date_held','deleted_at'];
	public static $storeRule = [
	'time_from' => 'required',
	'time_to' => 'required',
	'date_held' => 'required',
	'title' => 'required|max:20',
	'description' => 'required|string',
	'place_held' => 'required|max:45',
	'title' => 'unique_with:events, title, user_id, place_held, date_held, status, deleted_at',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'time_from' => 'required',
		'time_to' => 'required',
		'date_held' => 'required',
		'title' => 'required|max:20',
		'description' => 'required|string',
		'place_held' => 'required|max:45',
		'title' => 'unique_with:events, title, user_id, place_held, date_held, status, deleted_at,'.$id,
		];
	} 
	public static $messages = [
	'unique_with' => 'Event Exist!',
	];
}
