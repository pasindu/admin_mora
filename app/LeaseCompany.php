<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseCompany extends Model
{
    public function districts()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
