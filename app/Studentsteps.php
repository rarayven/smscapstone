<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Studentsteps extends Model
{
	protected $table = 'student_steps';
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}
