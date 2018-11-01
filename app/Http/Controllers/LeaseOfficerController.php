<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
        $leasecompany = LeaseCompany::whereStatus(1)->get();
    	$leaseofficer = LeaseOfficer::whereStatus(1)->get();

        // dd($leasecompany);
        return view('lease_officer.index',compact('districts','city','leasecompany','leaseofficer'));
    }

    public function create(Request $request)
    {
        // dd($request->all());

          $validator = $this->validateData($request->all());
          if ($validator->fails()){
          return Response::json($validator->errors(), 422);
          }

        $leasecompany = LeaseOfficer::create([

                'company_id' => $request->c_name,
                'district_id' => $request->c_distric,
                'city_id' => $request->c_city,
                'officer_name' => $request->officer_name,
                'nic' => $request->nic_no,
                'designation' => $request->officer_post,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                // 'password' => Hash::make($request->password),
                                
        ]);
        return response()->json(['msg' => 'Company added successfully'], 200);

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,LeaseCompany $leasecompany)
    {

      // dd($request->all());
        $validator = $this->validateData($request->all(),$request->id);
            if ($validator->fails()) {
              return Response::json($validator->errors(), 422);
            }

        $leaseofficer = LeaseOfficer::find($request->id);
        $leaseofficer->update([
                
                'company_id' => $request->c_name,
                'district_id' => $request->c_distric,
                'city_id' => $request->c_city,
                'officer_name' => $request->officer_name,
                'nic' => $request->nic_no,
                'designation' => $request->officer_post,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
          ]);
        $leaseofficer->save();
        return response()->json(['msg' => 'Lease Officer updated successfully'], 200);
    }


        public function edit($id)
    {
        $leasecompany = LeaseCompany::whereStatus(1)->get();
        $districts = District::get();
        $city = City::get();
        $leaseofficer = LeaseOfficer::whereStatus(1)->where('id',$id)->first();
        // return $leaseofficer;
        return view('lease_officer.editmodal',compact('city','districts','leasecompany','leaseofficer'));
    }

    public function destroy($id)
    {
        // dd($id);
        try {
          $leaseofficer = LeaseOfficer::find($id);
          $leaseofficer->status = 0;
          $leaseofficer->save();

          return Response::json(['msg'=>'Lease Officer deleted successfully'], 200);

        } catch (\PDOException $e) {
              return Response::json(['error'=>"lease officer has dependencies; can not delete"], 401);

        }catch (\Exception $e) {
              return Response::json(['error'=>"Internal Error"], 401);

        }
    }



    public function getAll(){

        $leaseofficer = LeaseOfficer::with('city','districts','leasecompanies')->whereStatus(1)

        ->get();
        // dd($leaseofficer);
        // dd($leaseofficer);
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


        ->rawColumns(['action'])
        ->make(true);
    }




    public function validateData($data, $id = 0)
    {
    $rules = [
            'c_name' => 'required|max:255',
            'c_distric' => 'required|max:255',
            'c_city' => 'required|max:255',
            'officer_name' => 'required|max:255',
            'officer_post' => 'required|max:255',
            'nic_no' => 'required|regex:/^[0-9]{9}[V,v,X,x]$/',
            'contact_no' => 'required|regex:/^(0)[0-9]{9}$/',
            'email' => 'required|email|unique:users,email,'.$id,
        ];


    $msg = [
            'c_name.required' => 'Company name is required',
            'c_name.max' => 'Company name exceeded character limit',
            'c_distric.required' => 'Company District is required',
            'c_city.required' => 'Company City is required',
            'name.required' => 'Officer Name is required',
            'post.required' => 'Officer Post is required',
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
