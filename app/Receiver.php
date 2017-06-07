<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Receiver extends Model
{
	protected $table = 'user_message';
	public $timestamps = false;
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	public function message()
	{
		return $this->belongsTo('App\Message');
	}
}
