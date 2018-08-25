<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primaryKey = 'province_id';

    public function citiesRelation() {
        return $this->hasMany('App\Models\City', 'province_id','province_id');
    }
}
