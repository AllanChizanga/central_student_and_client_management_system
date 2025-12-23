<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use App\DTOs\UserDTO;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    
    private $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }
     

    #LOGIN
     public function login($email, $password,$request)

     {
         $credentials = ['email' => $email, 'password' => $password];
         #remeber 
         $remember = $request->remember ? true:false;
        
         if (Auth::attempt(['email' => $email, 'password' => $password],$remember)) {
            
             // Regenerate the session to prevent fixation attacks
             $request->session()->regenerate();

              // Manually save session (usually not required if using web middleware)
             $request->session()->save();

             return true;
     
         }
         return false;
     }
     

     #LOGOUT
     public function logout($request)
     {
         try {
             Auth::logout();

             $request->session()->invalidate();

             $request->session()->regenerateToken();
             return true;
         } catch (Throwable $e) {
            
            return false;
         }
     }


     #CREATE 
     public function create(UserDTO $userDTO)
     { 

        #pass data to repository 
        $user = $this->user_repository->create($userDTO);

        return $user;
      
     }

}//endof class 

