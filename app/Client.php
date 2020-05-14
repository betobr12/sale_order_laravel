<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }

}
