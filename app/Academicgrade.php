<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academicgrade extends Model
{
	protected $table = 'academic_gradings';
	public $timestamps = false;

	public static $value = [
	'dblSystHighGrade' => 'unique_with:academic_gradings, dblSystLowGrade = lowest_grade, dblSystHighGrade = highest_grade'
	];
	public static $desc = [
	'strSystDesc' => 'unique:academic_gradings,description'
	];
	public static function updatevalue($id)
	{
		return $rules = [
		'dblSystHighGrade' => 'unique_with:academic_gradings, dblSystLowGrade = lowest_grade, dblSystHighGrade = highest_grade,'.$id
		];
	} 
	public static function updatedesc($id)
	{
		return $rules = [
		'strSystDesc' => 'unique:academic_gradings,description,'.$id
		];
	}
}
