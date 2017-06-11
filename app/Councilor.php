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
	'strCounMiddleName' => 'nullable|max:25',
	'strCounLastName' => 'required|max:25',
	'strCounCell' => 'required|max:15',
	'intCounDistID' => 'exists:districts,id',
	'strCounFirstName' => 'required|max:25|unique_with:councilors, strCounMiddleName = middle_name, strCounLastName = last_name, strCounFirstName = first_name',
	'strCounEmail' => 'required|email|max:30|unique:councilors,email',
	'strUserEmail' => 'required|email|max:30|unique:users,email',
	'image' => 'required|image',
	];
	public static function updaterules($id, $coordinator)
	{
		return $rules = [
		'strCounMiddleName' => 'nullable|max:25',
		'strCounLastName' => 'required|max:25',
		'strCounCell' => 'required|max:15',
		'intCounDistID' => 'exists:districts,id',
		'strCounFirstName' => 'required|max:25|unique_with:councilors, strCounMiddleName = middle_name, strCounLastName = last_name, strCounFirstName = first_name,'.$id,
		'strCounEmail' => 'required|email|max:30|unique:councilors,email,'.$id,
		'strUserEmail' => 'required|email|max:30|unique:users,email,'.$coordinator,
		'image' => 'nullable|image',
		];
	}
}
