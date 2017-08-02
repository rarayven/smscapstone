<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Budgtype extends Model
{
	protected $table = 'allocation_types';
	public $timestamps = false;
	public static $storeRule = [
	'strTypeDesc' => 'required|unique:allocation_types,description|max:25',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strTypeDesc' => 'required|unique:allocation_types,description,'.$id.'|max:25',
		];
	} 
}
