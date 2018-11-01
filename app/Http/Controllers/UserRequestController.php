<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRequestController extends Controller
{
           /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user_request.index');
    
    }

    public function create(Request $request)
    {
    	// dd($request->all());
        return view('user_request.create');
    
    }
}
