<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Requirement extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strStepDesc' => 'required|max:100|unique_with:requirements, strStepDesc = description, type',
	'type' => 'required|numeric',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strStepDesc' => 'required|unique_with:requirements, strStepDesc = description, type,'.$id.'|max:100',
		'type' => 'required|numeric',
		];
	} 
}
