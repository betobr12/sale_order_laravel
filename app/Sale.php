<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function client()
    {
       return $this->belongsTo('App\Client');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
