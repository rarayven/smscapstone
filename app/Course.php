<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strCourDesc' => 'required|unique:courses,description|max:50',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strCourDesc' => 'required|unique:courses,description,'.$id.'|max:50',
		];
	} 
}
