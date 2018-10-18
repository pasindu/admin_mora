<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseOfficer extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function districts()
    {
        return $this->belongsTo(District::class,'district_id');
    }

}
