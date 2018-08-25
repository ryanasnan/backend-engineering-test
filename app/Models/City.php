<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'city_id';

    public function provinceRelation() {
        return $this->belongsTo('App\Models\Province', 'province_id','province_id');
    }
}
