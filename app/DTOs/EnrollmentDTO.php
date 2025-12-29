<?php

namespace App\DTOs;

/**
 * Data Transfer Object for App\Models\Enrollment
 */
class EnrollmentDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly string $student_id = '',
        public readonly string $course_id = '',
        public readonly string $intake_id = '',
        public readonly string $enrollment_date = '',
        public readonly string $status = 'enrolled',
        public readonly float $amount = 0.0,
        public readonly float $paid = 0.0,
        public readonly float $balance = 0.0,
        public readonly string $currency = 'USD'
    ) {
    }

    /**
     * Create an EnrollmentDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            student_id: $data['student_id'],
            course_id: $data['course_id'],
            intake_id: $data['intake_id'],
            enrollment_date: $data['enrollment_date'],
            status: $data['status'],
            amount: isset($data['amount']) ? (float)$data['amount'] : 0.0,
            paid: isset($data['paid']) ? (float)$data['paid'] : 0.0,
            balance: isset($data['balance']) ? (float)$data['balance'] : 0.0,
            currency: $data['currency'],
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
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'intake_id' => $this->intake_id,
            'enrollment_date' => $this->enrollment_date,
            'status' => $this->status,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'balance' => $this->balance,
            'currency' => $this->currency,
        ];
    }
}
