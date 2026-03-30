<?php

namespace RoshanDhungana\NepalGeography\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = [
        'municipality_id',
        'province_id',
        'ward_number',
        'name',
    ];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    public function province()
    {
        return $this->belongsTo(State::class, 'province_id');
    }
}