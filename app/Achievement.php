<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Achievement extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	public $timestamps = false;
	public static $storeRule = [
	'description' => 'required|string',
	'place_held' => 'required|max:45',
	'date_held' => 'required',
	'pdf' => 'required|file',
	];
	public static function updateRule($id)
	{
		return $rules = [
		'description' => 'required|string',
		'place_held' => 'required|max:45',
		'date_held' => 'required',
		'pdf' => 'nullable|file',
		];
	} 
}
