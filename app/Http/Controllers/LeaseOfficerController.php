<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\LeaseOfficer;
use App\District;
use App\City;
use App\LeaseCompany;
use Datatables;
use Response;
use Validator;

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
    	$leaseofficer = LeaseCompany::get();
        // dd($leaseofficer);
        return view('lease_officer.index',compact('districts','city','leaseofficer'));
    }

    public function create(Request $request)
    {
        // dd($request->all());

          // $validator = $this->validateData($request->all());
          // if ($validator->fails()){
          // return Response::json($validator->errors(), 422);
          // }

        $leasecompany = LeaseOfficer::create([

                'company_id' => $request->c_name,
                'district_id' => $request->c_distric,
                'city_id' => $request->city_id,
                'officer_name' => $request->name,
                'nic' => $request->nic,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                // 'password' => Hash::make($request->password),
                                
        ]);
        return response()->json(['msg' => 'Company added successfully'], 200);

    }



    public function getAll(){

        $leaseofficer = LeaseOfficer::whereStatus(1)->get();
        dd($leasecompany);
        return Datatables::of($leaseofficer)

        ->addColumn(
            'action', function ($row) {
                return '<a class="btn btn-info" data-id="'.$row->id.'">
                    EDIT
                </a>
                <button type="button" class="btn btn-danger" data-id="'.$row->id.'">
                    DELETE
                </button>';
            })

        ->editColumn(
            'active', function ($row){
                $check = $row->active ? 'checked':'';
                return '<div class="switch">
                            <label>
                                <input value="'.$row->id.'" name="my-checkbox" type="checkbox" '.$check.'>
                                <span class="lever switch-col-green"></span>
                            </label>
                        </div>';
            })

        ->rawColumns(['active','action'])
        ->make(true);
    }


    public function validateData($data, $id = 0)
    {
    $rules = [
        

            'c_name' => 'required|max:255',
            'c_distric' => 'required|max:255',
            'c_city' => 'required|max:255',
            'name' => 'required|max:255',
            'post' => 'required|max:255',
            'nic_no' => 'required|max:255',
            'contact_no' => 'required|regex:/^(0)[0-9]{9}$/',
            'email' => 'required|email|unique:users,email,'.$id,


        ];


    $msg = [
     
            'c_name.required' => 'Company\'s name is required',
            'c_name.max' => 'Company\'s name exceeded character limit',
            'nic_no.required' => 'NIC Number is required',
            'contact_no.required' => 'Mobile Number is required',
            'contact_no.numeric' => 'Invalid Mobile Number',
            'c_email.required' => 'Email is required',
            'c_email.email' => 'Email is not valid',
            'c_email.unique' => 'Email is already in use',
            'password.required' => 'Password is required',
            'password.min' => 'Password should be at least 6 characters',
            'password.confirmed' => 'Password Confimation did not match',
            'admin_password.required' => 'Current User Password is required',
    ];

    return Validator::make($data,$rules,$msg);
}

}
