<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_id', 'user_name', 'consultant_id', 'name',
        'email', 'phone', 'state', 'country',
        'city', 'zip', 'address', 'alt_address','role', 'status',
        'password','is_consultant'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function consultant()
    // {
    //     return $this->hasOne('App\User', 'consultant_id');
    // }

    // public function consultant()
    // {
    //     return $this->hasMany('App\User', 'consultant_id'); // specifying the foreign key because it is non-conventional
    // }

    public function consultant()
    {
        return $this->belongsTo('App\User', 'consultant_id'); // specifying the foreign key because it is non-conventional
    }

    public function detail()
    {
        return $this->hasOne('App\UserDetail', 'user_id');
    }

}
