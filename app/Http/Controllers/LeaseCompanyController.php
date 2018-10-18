<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\City;

class LeaseCompanyController extends Controller
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
    	// dd($city);
        return view('lease_company.index',compact('districts','city'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());

        $user = User::create([

                'company_name' => $request->c_name,
                'manager_name' => $request->c_manager,
                'email' => $request->c_email,
                // 'password' => Hash::make($request->password),
                'contact_no' => $request->contact_no,
                                
        ]);
        return response()->json(['msg' => 'User added successfully'], 200);

    }

}
