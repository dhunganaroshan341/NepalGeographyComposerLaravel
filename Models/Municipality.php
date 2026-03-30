<?php

namespace RoshanDhungana\NepalGeography\Models;


use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{

public function district()
    {
        return $this->belongsTo(District::class);
    }

    
   public function wards() {
        return $this->hasMany(Ward::class, 'municipality_id');
    }
}
