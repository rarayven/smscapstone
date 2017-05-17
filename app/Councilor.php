<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
class Councilor extends Model
{
	public $timestamps = false;

	public static $rules = [
	'strCounFirstName' => 'unique_with:councilors, strCounMiddleName = middle_name, strCounLastName = last_name, strCounFirstName = first_name'
	];
	public static $email = [
	'strCounEmail' => 'unique:councilors,email'
	];
	public static $coordinator = [
	'strUserEmail' => 'unique:users,email'
	];
	public static function updaterules($id)
	{
		return $rules = [
		'strCounFirstName' => 'unique_with:councilors, strCounMiddleName = middle_name, strCounLastName = last_name, strCounFirstName = first_name,'.$id
		];
	} 
	public static function updateemail($id)
	{
		return $rules = [
		'strCounEmail' => 'unique:councilors,email,'.$id
		];
	} 
	public static function coordinator($id)
	{
		return $rules = [
		'strUserEmail' => 'unique:users,email,'.$id
		];
	} 
}
