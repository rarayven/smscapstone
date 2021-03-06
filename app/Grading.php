<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Grading extends Model
{
	public $timestamps = false;
	public static function updateRule($id)
	{
		return $rules = [
		// 'dblSystLowGrade' => 'required|max:4',
		// 'strSystFailGrade' => 'required|max:4',
		'strSystDesc' => 'required|max:25|unique:gradings,description,'.$id,
		// 'dblSystHighGrade' => 'required|max:4|unique_with:gradings, dblSystLowGrade = lowest_grade, dblSystHighGrade = highest_grade,'.$id
		];
	}
	public static $storeRule = [
	// 'dblSystLowGrade' => 'required|max:4',
	// 'strSystFailGrade' => 'required|max:4',
	// 'dblSystHighGrade' => 'required|max:4|unique_with:gradings, dblSystLowGrade = lowest_grade, dblSystHighGrade = highest_grade',
	'strSystDesc' => 'required|max:25|unique:gradings,description',
	];
}
