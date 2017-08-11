<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Connection extends Model
{
	protected $table = 'user_councilor';
	public $incrementing = false;
	public $timestamps = false;
}
