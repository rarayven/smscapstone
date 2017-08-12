<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Notification extends Model
{
	protected $table = 'user_announcement';
	public $incrementing = false;
	public $timestamps = false;
}
