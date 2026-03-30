<?php

namespace RoshanDhungana\NepalGeography\Models;

use Illuminate\Database\Eloquent\Model;
use RoshanDhungana\NepalGeography\Models\State;

class Country extends Model
{
    protected $table = 'countries';

    public function states()
    {
        return $this->hasMany(State::class);
    }
}