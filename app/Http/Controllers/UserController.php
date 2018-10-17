<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Datatables;
use Response;
use Validator;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('role')->whereStatus(1)->where('id','<>',1)->get();
        // dd($users);
        $role = Role::get();
        return view('user.index',compact('role','users'));
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

        $user = User::create([

                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nic' => $request->nic_no,
                'contact_no' => $request->contact_no,
                                
        ]);
        return response()->json(['msg' => 'User added successfully'], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

     public function active(Request $request)
    {
      // dd('sdsd');   
        $this->validate($request, ['user_id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->user_id);

        if($request->active == 0){
        $user->active = 0;
         $user->save();
        }else{
        $user->active = 1;
        $user->save();
        }

        return response()->json(['msg' => 'action successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::with('users')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::whereStatus(1)->where('id',$id)->first();
        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {

      // dd($request->all());
        $validator = $this->validateData($request->all(),$request->id);
            if ($validator->fails()) {
              return Response::json($validator->errors(), 422);
            }

            if (!($this->checkCurrentUserPwd($request->admin_password))) {
              return Response::json(['error' => 'Current User password did not match'], 422);
            }

        $user = User::find($request->id);
        $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nic' => $request->nic_no,
                'contact_no' => $request->contact_no,
          ]);
        $user->save();
        return response()->json(['msg' => 'User updated successfully'], 200);
    }

    public function getAll(){

        $users = User::whereStatus(1)->where('id', '<>', 1)->get();

        return Datatables::of($users)

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

        // ->addColumn(
        //     'roles', function ($row) {
        //         return implode(',', $row->roles->pluck('title')->toArray());
        //     })

        ->rawColumns(['active','action'])
        ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        try {
          $user = User::find($id);
          $user->status = 0;
          $user->save();

          return Response::json(['msg'=>'User deleted successfully'], 200);

        } catch (\PDOException $e) {
              return Response::json(['error'=>"User has dependencies; can not delete"], 401);

        }catch (\Exception $e) {
              return Response::json(['error'=>"Internal Error"], 401);

        }
    }

    public function validateData($data, $id = 0)
    {
    $rules = [
          
            'name' => 'required|max:255',
            'nic_no' => 'required|regex:/^[0-9]{9}[V,v,X,x]$/',
            'contact_no'=>'required|regex:/^(0)[0-9]{9}$/',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|string|min:6|confirmed',
        ];


    $msg = [
     
            'name.required' => 'User\'s name is required',
            'name.max' => 'User\'s name exceeded character limit',
            'nic_no.required' => 'NIC Number is required',
            'contact_no.required' => 'Mobile Number is required',
            'contact_no.numeric' => 'Invalid Mobile Number',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email is already in use',
            'password.required' => 'Password is required',
            'password.min' => 'Password should be at least 6 characters',
            'password.confirmed' => 'Password Confimation did not match',
            'admin_password.required' => 'Current User Password is required',
    ];

    return Validator::make($data,$rules,$msg);
  }

    public function checkCurrentUserPwd($password)
      {
        $admin =  Auth::user();
        if(Hash::check($password, $admin->password))
        {
          return true;
        }
        return false;
  }

}
