<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Semester extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strSemDesc' => 'required|unique:semesters,description|max:20',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strSemDesc' => 'required|unique:semesters,description,'.$id.'|max:20',
		];
	} 
}
