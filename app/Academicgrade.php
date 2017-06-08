<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Academicgrade extends Model
{
	protected $table = 'academic_gradings';
	public $timestamps = false;
	public static function updateRule($id)
	{
		return $rules = [
		'strSystDesc' => 'required|max:25',
		'dblSystHighGrade' => 'required|max:4',
		'dblSystLowGrade' => 'required|max:4',
		'strSystFailGrade' => 'required|max:4',
		'strSystDesc' => 'unique:academic_gradings,description,'.$id,
		'dblSystHighGrade' => 'unique_with:academic_gradings, dblSystLowGrade = lowest_grade, dblSystHighGrade = highest_grade,'.$id
		];
	}
	public static $storeRule = [
	'strSystDesc' => 'required|max:25',
	'dblSystHighGrade' => 'required|max:4',
	'dblSystLowGrade' => 'required|max:4',
	'strSystFailGrade' => 'required|max:4',
	'dblSystHighGrade' => 'unique_with:academic_gradings, dblSystLowGrade = lowest_grade, dblSystHighGrade = highest_grade',
	'strSystDesc' => 'unique:academic_gradings,description',
	];
}
