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
        'name', 'email', 'password',
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

    public function ticket()
    {
        return $this->belongsToMany('App\Ticket');
    }

    public function history()
    {
        return $this->hasMany('App\History');
    }

    public function station()
    {
        return $this->hasOne('App\Station','station_id');
    }

    public function getfullNameAttribute()//the words get and attribute are fixed
    {
        return $this->first_name." ".$this->last_name;
    }
}
