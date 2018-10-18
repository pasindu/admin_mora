<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';

    public function leasecompanies(){

        return $this->hasMany(LeaseCompany::class);
    }

    public function leaseofficer(){

        return $this->hasMany(LeaseOfficer::class);
    }
}
