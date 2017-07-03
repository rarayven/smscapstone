<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Studentsteps extends Model
{
	protected $table = 'user_step';
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}
