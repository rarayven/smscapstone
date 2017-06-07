<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Announcement extends Model
{
	public $timestamps = false;
	use SoftDeletes;
	protected $dates = ['date_post','deleted_at'];
	public static $storeRule = [
	'title' => 'required|max:45',
	'description' => 'required|string',
	'pdf' => 'nullable|file',
	];
}
