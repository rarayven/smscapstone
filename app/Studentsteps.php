<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Studentsteps extends Model
{
	protected $table = 'user_requirement';
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}
