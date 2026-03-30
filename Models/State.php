<?php

namespace RoshanDhungana\NepalGeography\Models;


use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
