<?php

namespace App\DTOs;

/**
 * Data Transfer Object for App\Models\Intake
 */
class IntakeDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly string $cohort,
        public readonly string $start_date,
        public readonly string $graduation_date
    ) {
    }

    /**
     * Create an IntakeDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            cohort: $data['cohort'] ?? '',
            start_date: $data['start_date'] ?? '',
            graduation_date: $data['graduation_date'] ?? ''
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
            'cohort' => $this->cohort,
            'start_date' => $this->start_date,
            'graduation_date' => $this->graduation_date,
        ];
    }
}
