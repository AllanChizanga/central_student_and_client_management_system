<?php

namespace App\Repositories;

use Log;
use Throwable;
use App\Models\User;
use App\DTOs\UserDTO;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    } 

    public function create(UserDTO $userDTO)
    {
        try {
            $user = User::create([
                'fullname' => $userDTO->fullname,
                'email' => $userDTO->email,
                'password' => $userDTO->password,
                'phonenumber' => $userDTO->phonenumber,
                'user_type' => $userDTO->user_type,
                'status' => $userDTO->status,
            ]);
            return $user;
        } catch (Throwable $e) {
        Log::error($e);
        $user = null;
        }
    }
}
