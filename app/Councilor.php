<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Councilor extends Model
{
	public $timestamps = false;
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	public static $storeRule = [
	'strCounFirstName' => 'required|max:25',
	'strCounMiddleName' => 'max:25',
	'strCounLastName' => 'required|max:25',
	'strCounEmail' => 'required|max:30',
	'strCounCell' => 'required|max:15',
	'strUserEmail' => 'required|max:30',
	'intCounDistID' => 'exists:districts,id',
	'strCounFirstName' => 'unique_with:councilors, strCounMiddleName = middle_name, strCounLastName = last_name, strCounFirstName = first_name',
	'strCounEmail' => 'unique:councilors,email',
	'strUserEmail' => 'unique:users,email',
	];
	public static function updaterules($id, $coordinator)
	{
		return $rules = [
		'strCounFirstName' => 'required|max:25',
		'strCounMiddleName' => 'max:25',
		'strCounLastName' => 'required|max:25',
		'strCounEmail' => 'required|max:30',
		'strCounCell' => 'required|max:15',
		'strUserEmail' => 'required|max:30',
		'intCounDistID' => 'exists:districts,id',
		'strCounFirstName' => 'unique_with:councilors, strCounMiddleName = middle_name, strCounLastName = last_name, strCounFirstName = first_name,'.$id,
		'strCounEmail' => 'unique:councilors,email,'.$id,
		'strUserEmail' => 'unique:users,email,'.$coordinator,
		];
	}
}
