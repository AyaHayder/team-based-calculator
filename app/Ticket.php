<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function history()
    {
        return $this->hasMany('App\History');
    }

    public function station()
    {
        return $this->belongsToMany('App\Station');
    }
}
