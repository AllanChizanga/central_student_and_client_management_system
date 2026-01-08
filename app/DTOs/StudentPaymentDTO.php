<?php

namespace App\DTOs;

class StudentPaymentDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?int $invoice_number = null,
        public readonly string $enrollment_id,
        public readonly float $previous_balance,
        public readonly float $amount_paid,
        public readonly float $current_balance,
        public readonly string $next_due_date,
        public readonly string $currency,
        public readonly string $payment_method
    ) {
    }

    /**
     * Create a StudentPaymentDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            invoice_number: $data['invoice_number'] ?? null,
            enrollment_id: $data['enrollment_id'],
            previous_balance: $data['previous_balance'],
            amount_paid: $data['amount_paid'],
            current_balance: $data['current_balance'],
            next_due_date: $data['next_due_date'],
            currency: $data['currency'] ?? 'USD',
            payment_method: $data['payment_method'] ?? 'Cash'
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
            'invoice_number' => $this->invoice_number,
            'enrollment_id' => $this->enrollment_id,
            'previous_balance' => $this->previous_balance,
            'amount_paid' => $this->amount_paid,
            'current_balance' => $this->current_balance,
            'next_due_date' => $this->next_due_date,
            'currency' => $this->currency,
            'payment_method' => $this->payment_method,
        ];
    }
}
