<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class District extends Model
{
	public $timestamps = false;
	public static $storeRule = [
	'strDistDesc' => 'required|unique:districts,description|max:15',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strDistDesc' => 'required|unique:districts,description,'.$id.'|max:15',
		];
	} 
}
