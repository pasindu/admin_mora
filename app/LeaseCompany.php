<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseCompany extends Model
{

    protected $table = 'lease_companies';

		protected $fillable = [

        'company_name','email' ,'contact_no' ,
    ];
    
    public function districts()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    // public function leasecompanies(){

    //     return $this->hasMany(LeaseCompany::class);
    // }


}
