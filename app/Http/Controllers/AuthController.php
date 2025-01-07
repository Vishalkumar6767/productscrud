<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthTrait;
    public function showRegistration(){

        return view('auth.register');

    }
    public function signup(SignupRequest $request){
       
        $data = $this->register($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('dashboard');

    }
    public function showLogin(){
       
        return view('auth.login');

    }
    public function login(LoginRequest $request){
        $data = $this->loginUser($request);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('dashboard');



    }

    public function logout(){
        $data = $this->logoutUser();
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('dashboard');




    }
}
