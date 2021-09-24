<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;

class AuthController extends AppBaseController
{

    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            // 'password' => 'required|string|min:6|confirmed',
            // 'id_no' => 'required|unique:oracle.haram.prm_users|string|max:255',
            // 'mobile_no' => 'required|string|max:15',
            // 'email' => 'required|string|email|unique:oracle.haram.prm_users,email',
            'email' => 'required|string|email',
            // 'nation_id' => 'required|string|max:5',
            // 'gender' => Rule::in(['1', '2']),
        ]);
        // dd($request['password']);
        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($request['password']),
            // 'id_no' => $attr['id_no'],
            // 'mobile_no' => $attr['mobile_no'],
            'email' => $request['email'],
            // 'nation_id' => $attr['nation_id'],
            // 'gender' => $attr['gender'],
            // 'user_type' => 4,
            // 'user_status' => 1,
        ]);
        
        return $this->sendResponse($user , 'Registered successfully');
    }


    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|min:5',
            'password' => 'required|string|min:6' , 
            // 'device_id' => 'required|string|min:10' , 
        ]);
        // dd('login2');
        $user = User::where('email', $request->email)->first();

        

        if(isset($user)){
            $credentials = $request->only('email', 'password');
            // $credentials['user_status'] = 1;       
        }

        if (!$user || !Auth::attempt($credentials)) {
        // if (!$user) {
            return $this->sendError('Credentials not match', 401);
        }

        $data = [
            'token' => auth()->user()->createToken($request->email)->plainTextToken,
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
        $user = User::where('id_no', '=', $id)->where('user_type', '=', 4)->first();

        if (empty($user)) {
            return $this->sendError('user not found');
        }

        $user->fill($request->only('user_name', 'mobile_no', 'email'));
        $user->save();

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }
}