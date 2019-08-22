<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function user()
    {
        return $this->belongsToMany('App\User');
    }


    public function ticket()
    {
        return $this->belongsToMany('App\Ticket');
    }

    public function history()
    {
        return $this->hasMany('App\History');
    }
}
