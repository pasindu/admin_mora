<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\LeaseOfficer;
use App\District;
use App\City;
use Datatables;

class LeaseOfficerController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$districts = District::get();
    	$city = City::get();

        return view('lease_officer.index',compact('districts','city'));
    }

}
