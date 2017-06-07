<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Message extends Model
{
	public $timestamps = false;
	use SoftDeletes;
	protected $dates = ['date_created','deleted_at'];
	public static $storeRule = [
	'title' => 'required|max:45',
	'description' => 'required|string',
	'pdf' => 'nullable|file',
	'receiver' => 'required',
	];
	public function receiver()
	{
		return $this->hasMany('App\Receiver');
	}
}
