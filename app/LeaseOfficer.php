<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseOfficer extends Model
{
     protected $table = 'lease_officers';
     
			protected $fillable = [

        'company_id', 'district_id', 'city_id' ,'officer_name' ,'nic' ,'designation' ,'email' ,'contact_no' ,
    ];

    
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function districts()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function leasecompanies()
    {
        return $this->belongsTo(LeaseCompany::class , 'company_id','id');
    }

}