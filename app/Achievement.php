<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Achievement extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'description' => 'required|string',
	'place_held' => 'required|max:45',
	'date_held' => 'required',
	'pdf' => 'required|file',
	];
	// public static function updateRule($id)
	// {
	// 	return $rules = [
	// 	'strDistDesc' => 'required|unique:districts,description,'.$id.'|max:15',
	// 	];
	// } 
}
