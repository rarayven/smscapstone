<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	public $timestamps = false;
	protected $dates = ['date_created'];
}
