<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Batch extends Model
{
	protected $table = 'batches';
	public $timestamps = false;
	public static $storeRule = [
	'strBatcDesc' => 'required|unique:batches,description|max:20',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'strBatcDesc' => 'required|unique:batches,description,'.$id.'|max:20',
		];
	} 
}
