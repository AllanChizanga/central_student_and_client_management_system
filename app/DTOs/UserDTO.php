<?php

namespace App\DTOs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Data Transfer Object for App\Models\User
 */
class UserDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly string $fullname = '',
        public readonly string $email = '',
        public readonly string $password = '',
        public readonly string $phonenumber = '',
        public readonly string $user_type = '',
        public readonly string $status = ''
    ) {
    }

    /**
     * Create a UserDTO from a User model instance.
     */
    /**
     * Create a UserDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            fullname: $data['fullname'] ?? '',
            email: $data['email'] ?? '',
            password: Hash::make($data['password']) ?? '',
            phonenumber: $data['phonenumber'] ?? '',
            user_type: $data['user_type'] ?? '',
            status: $data['status'] ?? '',
        );
    }

    /**
     * Convert DTO to array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'password' => $this->password,
            'phonenumber' => $this->phonenumber,
            'user_type' => $this->user_type,
            'status' => $this->status,
        ];
    }
}
