<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Step extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strStepDesc' => 'required|unique:steps,description|max:100',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strStepDesc' => 'required|unique:steps,description,'.$id.'|max:100',
		];
	} 
}
