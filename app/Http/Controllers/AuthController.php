<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AppBaseController;

class AuthController extends AppBaseController
{

    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'id_no' => 'unique:users|numeric',
            'mobile_no' => 'unique:users|required|numeric|min:10',
            'email' => 'nullable|string|email|unique:users',
            'nation_id' => 'required|numeric|exists:nations,id',
            'passport_no' => 'string|min:4',
            'gender' => Rule::in(['1', '2']),
        ]);

        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email'],
            'mobile_no' => $attr['mobile_no'],
            'id_no' => $request['id_no'],
            'passport_no' => $request['passport_no'],
            'nation_id' => $request['nation_id'],
            'gender' => $request['gender'],
            'user_type' => 1, 
            'user_status' => 1,
        ]);
        
        return $this->sendResponse($user , 'Registered successfully');
    }


    public function login(Request $request)
    {
        $attr = $request->validate([
            'mobile_no' => 'required|string|min:10',
            'password' => 'required|string|min:6' , 
            // 'device_id' => 'required|string|min:10' , 
        ]);
        
        $user = User::where('mobile_no', $attr['mobile_no'])->first();
        
        if(isset($user)){
            $credentials = $request->only('mobile_no', 'password');
            $credentials['user_status'] = 1;       
        }

        if (!$user || !Auth::attempt($credentials)) {
        // if (!$user) {
            return $this->sendError('Credentials not match', 401);
        }

        $data = [
            'token' => auth()->user()->createToken($attr['mobile_no'])->plainTextToken,
            'profile' => $user->toArray()
        ];

        return $this->sendResponse($data , 'token created successfully');
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendSuccess('Tokens Revoked');
    }


    public function editProfile($id, Request $request)
    {
        $user = User::where('id', '=', $id)->where('user_status', '=', 1)->first();

        if (empty($user)) {
            return $this->sendError('user not found');
        }

        $user->fill($request->only('name', 'mobile_no', 'email','id_no'));
        $user->save();

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }
}