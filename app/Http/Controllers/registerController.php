<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function create()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'username' => 'required|min:6|max:20|unique:users',
        ]);
        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['username'] = $request->username;
        $data['profile_picture'] = 'images/default_profile_picture.png';
        User::create($data);
        return redirect()->route('login.index');
    }
            
}
