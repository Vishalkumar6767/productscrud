<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    /**
     * Create a new class instance.
     */
    protected $userObject;
    public function __construct()
    {
      $this->userObject = new User;
    }
    public function register($input) {
        try {
            DB::beginTransaction();
            $user =$this->userObject->create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => bcrypt($input['password']),
            ]);

            $success = $this->successResponse('User Registered Successfully', $user->createToken("API TOKEN")->plainTextToken);
            DB::commit();

            return $success;
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => false,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }
    }

    public function loginUser($input) {
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            return $this->successResponse('User Logged In Successfully', Auth::user()->createToken("API TOKEN")->plainTextToken);
        } else {
             $data['errors'] = [
                'status' => false,
                'message' => 'Invalid credentials.',
                'code' => 401,
            ];
            return $data;
        }
    }

    private function successResponse($message, $token, $code = 200) {
        return $data['success']=[
            'status' => true,
            'message' => $message,
            'token' => $token,
            'token_type' => 'bearer',
            'code' => $code,
        ];
        return $data;
    }

    
    public function logoutUser()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $data['message'] = 'Successfully logged out';
        return $data;
    }


    
}
