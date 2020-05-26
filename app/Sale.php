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
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function setItem() {

    $this->sale_value * $this->sale_amount;
    }
    public function item()
    {
        return $this->hasOne('App\Item');
    }
    public function product()
    {
        return $this->hasOne('App\Item');
    }



}
