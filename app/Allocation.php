<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Allocation extends Model
{
	protected $table = 'allocations';
	public $timestamps = false;
	protected $dates = ['allocation_date'];
}
