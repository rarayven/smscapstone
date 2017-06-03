<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Barangay extends Model
{
	protected $table = 'Barangay';
	public $timestamps = false;
	public static $storeRule = [
	'strBaraDesc' => 'required|unique:barangay,description|max:25',
	'intDistID' => 'exists:districts,id',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strBaraDesc' => 'required|unique:barangay,description,'.$id.'|max:25',
		'intDistID' => 'exists:districts,id',
		];
	} 
}
