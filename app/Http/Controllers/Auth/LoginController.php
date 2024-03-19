<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends BaseController
{
    public function login(LoginRequest $request)
    {   
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $login = User::find($user->id)->first();

                $tokenResult = $user->createToken('authToken'); 
                $success['token'] =  $tokenResult->plainTextToken; 

                $expirationDate = $tokenResult->accessToken->expires_at;
                $success['token_expires_at'] = $expirationDate->format('Y-m-d H:i:s');
                $success['user'] =  $login;
               
                return $this->petnetResponse(200, 'User login successfully', $success, 200, 'Login', "Success");
            } 
            else{ 
                return $this->petnetResponse(401, 'Invalid Credentials', null, 401, 'Login', "Failed");
            } 
        } catch (\Throwable $th) {
            return $this->petnetResponse(500, 'An error occurred during login', null, 500, 'Login', $th->getMessage());
        }
    }

    public function logout()
    {
        try {
            $accessToken = Auth::user()->currentAccessToken();
            $token = $accessToken->delete();

            return $this->petnetResponse(200, 'Logout successfully', $token, 200, 'Logout', "Success");
        } catch (\Throwable $th) {
            return $this->petnetResponse(500, 'An error occurred during login', null, 500, 'Login', $th->getMessage());
        }
    }

    public function refreshToken()
    {
        try {
            $user = Auth::user();
            $accessToken = $user->currentAccessToken();
    
            if($accessToken) {
                $accessToken->delete();
                $login = User::find($user->id)->login($user->email);
    
                $tokenResult = $user->createToken('authToken');
                $success['token'] =  $tokenResult->plainTextToken; 
    
                $expirationDate = $tokenResult->accessToken->expires_at;
                $success['token_expires_at'] = $expirationDate->format('Y-m-d H:i:s');
                $success['user'] =  $login;
    
                return $this->petnetResponse(200, 'Refresh token successfully', $success, 200, 'Login', "Success");
            }
        } catch (\Throwable $th) {
            return $this->petnetResponse(500, 'An error occurred during refreshing token', null, 500, 'Login', $th->getMessage());
        }
    }
}