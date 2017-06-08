<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    public static $storeRegister = [
    'first_name' => 'unique_with:users, middle_name, last_name',
    'middle_name' => 'max:25',
    'last_name' => 'required|max:25',
    'cell_no' => 'required|max:15',
    'password' => 'required|confirmed|max:61',
    'image' => 'image'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'first_name', 'email', 'password', 'middle_name', 'last_name', 'cell_no', 'is_active',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token', 'is_active',
    ];
}
