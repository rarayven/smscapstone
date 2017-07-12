<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Requirement extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strStepDesc' => 'required|unique:requirements,description|max:100',
	'type' => 'required|numeric',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strStepDesc' => 'required|unique:requirements,description,'.$id.'|max:100',
		];
	} 
}