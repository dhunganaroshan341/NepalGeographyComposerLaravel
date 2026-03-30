<?php

namespace RoshanDhungana\NepalGeography\Models;


use Illuminate\Database\Eloquent\Model;

class District extends Model
{


public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }

   public function localLevels() {
        return $this->hasMany(Municipality::class, 'district_id');
    }
}
