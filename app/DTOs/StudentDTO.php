<?php

namespace App\DTOs;

use App\Models\Student;

/**
 * Data Transfer Object for App\Models\Student
 */
class StudentDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly string $user_id,
        public readonly string $student_number,
        public readonly string $enrollment_status,
        public readonly string $admission_date,
        public readonly string $graduation_date,
        public readonly string $gender,
        public readonly string $address,
        public readonly string $city
    ) {
    }

    /**
     * Create a StudentDTO from a Student model instance.
     */
    // Not implemented now; pattern match with UserDTO if ever needed

    /**
     * Create a StudentDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            user_id: $data['user_id'] ?? null,
            student_number: $data['student_number'] ?? '',
            enrollment_status: $data['enrollment_status'] ?? '',
            admission_date: $data['admission_date'] ?? null,
            graduation_date: $data['graduation_date'] ?? null,
            gender: $data['gender'] ?? '',
            address: $data['address'] ?? '',
            city: $data['city'] ?? ''
        );
    }

    /**
     * Convert DTO to array.
     *
     * @return array<string, mixed>
     */
    public function to_array(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'student_number' => $this->student_number,
            'enrollment_status' => $this->enrollment_status,
            'admission_date' => $this->admission_date,
            'graduation_date' => $this->graduation_date,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
        ];
    }
}
