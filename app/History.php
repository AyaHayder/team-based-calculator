<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function station()
    {
        return $this->belongsTo('App\Station');
    }

}
