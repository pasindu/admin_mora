<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseCompany extends Model
{

		protected $fillable = [

        'company_id', 'district_id', 'city_id' ,
'officer_name' ,
'nic' ,
'email' ,'contact_no' ,
    ];
    
    public function districts()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
