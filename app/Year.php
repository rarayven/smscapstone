<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strYearDesc' => 'required|unique:years,description|max:20',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strYearDesc' => 'required|unique:years,description,'.$id.'|max:20',
		];
	} 
}
