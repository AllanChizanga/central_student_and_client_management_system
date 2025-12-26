<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUserRequest;

class AuthController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // login

    public function login(LoginRequest $request)
    { 
        #VALIDATION
        $request->validated();
        $email = $request->email;
        $password = $request->password;
        #BUSINESS LOGIC
        $res = $this->userService->login($email, $password, $request);

        #RESPONSE
        return $res
            ? redirect()->route('dashboard')
            : back()->withErrors(['email' => 'The provided credentials do not match our records.']); //do not change the text
    }



    public function logout(Request $request)
    {
       $res =  $this->userService->logout($request); 

       return $res ?  redirect()->route('dashboard')  : back()->withErrors(['error' => 'Something went wrong']);

        
    }
}
