<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
      protected $table = 'districts';

    public function leasecompanies(){

        return $this->hasMany(LeaseCompany::class);
    }
    public function leaseofficer(){

        return $this->hasMany(LeaseOfficer::class);
    }
   
}
