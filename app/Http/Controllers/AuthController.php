<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Services\AuthService;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;


    }
    // use AuthTrait;
    public function showRegistration(){

        return view('auth.register');

    }
    public function signup(SignupRequest $request){
       
        $data = $this->authService->register($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('dashboard');

    }
    public function showLogin(){
       
        return view('auth.login');

    }
    public function login(LoginRequest $request){
        $data = $this->authService->loginUser($request);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('dashboard');



    }

    public function logout(){
        $data = $this->authService->logoutUser();
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('dashboard');




    }
}
