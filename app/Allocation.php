<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Allocation extends Model
{
	protected $table = 'tblAllocation';
	protected $primaryKey = 'intAlloID';
	public $timestamps = false;
	protected $dates = 'dtmAlloBudgDate';
}
