<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\City;
use App\LeaseCompany;
use App\LeaseOfficer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Datatables;
use Response;
use Validator;

class LeaseCompanyController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $leasecompany = LeaseCompany::whereStatus(1)->get();
    	$districts = District::get();
    	$city = City::get();
    	// dd($city);
        return view('lease_company.index',compact('districts','city','leasecompany'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());

          $validator = $this->validateData($request->all());
          if ($validator->fails()){
          return Response::json($validator->errors(), 422);
          }

        $leasecompany = LeaseCompany::create([

                'company_name' => $request->c_name,
                'email' => $request->c_email,
                'contact_no' => $request->contact_no,
                // 'manager_name' => $request->c_manager,
                // 'password' => Hash::make($request->password),
                                
        ]);
        return response()->json(['msg' => 'Company added successfully'], 200);

    }

        public function edit($id)
    {

        $leasecompany = LeaseCompany::whereStatus(1)->where('id',$id)->first();
        return $leasecompany;
        // $leasecompany = LeaseCompany::where('id',$id)->first();
        // $districts = District::get();
        // $city = City::get();
        // return view('lease_officer.editmodal',compact('city','districts','leasecompany'));
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

        $leasecompany = LeaseCompany::find($request->id);
        $leasecompany->update([
                'company_name' => $request->c_name,
                'email' => $request->c_email,
                'contact_no' => $request->contact_no,
                // 'manager_name' => $request->c_manager,
          ]);
        $leasecompany->save();
        return response()->json(['msg' => 'Company updated successfully'], 200);
    }



    public function destroy($id)
    {
        // dd($id);
        try {
          $leasecompany = LeaseCompany::find($id);
          $leasecompany->status = 0;
          $leasecompany->save();

          return Response::json(['msg'=>'Company deleted successfully'], 200);

        } catch (\PDOException $e) {
              return Response::json(['error'=>"Company has dependencies; can not delete"], 401);

        }catch (\Exception $e) {
              return Response::json(['error'=>"Internal Error"], 401);

        }
    }


    public function getAll(){

        $leasecompany = LeaseCompany::whereStatus(1)->get();
        // dd($leasecompany);
        return Datatables::of($leasecompany)

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
            // 'c_manager' => 'required|max:255',
            'contact_no'=>'required|regex:/^(0)[0-9]{9}$/',
            'c_email' => 'required|email|unique:users,email,'.$id,

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
