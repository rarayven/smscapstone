<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
	public $timestamps = false;
	protected $dates = ['date_post'];
}
