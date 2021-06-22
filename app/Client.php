<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
    public function sale()
    {
        return $this->hasOne('App\Sale');
    }
    public function scopeSlug($query, $slug)
    {
        if($slug)
        return $query->where('slug', 'LIKE', "%$slug%");
    }
}
