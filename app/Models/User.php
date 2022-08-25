<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
//use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens; // Add this line

class User extends Authenticatable
{

    use Sortable;
    use Loggable;
    use SoftDeletes; // add this
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    public $sortable = ['id', 'name', 'email', 'role_id', 'created_by', 'created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name', 'email', 'password','google2fa_secret'
        'name', 'email', 'password', 'role_id', 'created_by','customer_id','enterprise_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token','google2fa_secret'
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];
    //protected function google2faSecret(): Attribute
    //{
       // return new Attribute(
           // get: fn ($value) =>  decrypt($value),
          // set: fn ($value) =>  encrypt($value),
        //);
    //}
    public function role()
    {
        return $this->belongsTo('App\Models\Adminrole', 'role_id', 'id');
    }
    public function log()
    {
        return $this->hasMany('App\Models\Log', 'id', 'uid');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\User', 'created_by','id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\User', 'created_by','id');
    }
}
