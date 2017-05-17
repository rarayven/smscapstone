<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
	protected $table = 'student_details';
	protected $primaryKey = 'user_id';
	public $timestamps = false;
}
