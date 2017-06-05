<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
	protected $table = 'user_message';
	public $timestamps = false;
}
