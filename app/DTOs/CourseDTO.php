<?php

namespace App\DTOs;

/**
 * Data Transfer Object for App\Models\Course
 */
class CourseDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly string $name,
        public readonly string $category,
        public readonly bool $active,
        public readonly int $duration_months,
        public readonly string $mode_of_learning,
        public readonly float $total_fee,
        public readonly string $fee_currency,
        public readonly float $monthly_fee,
        public readonly string $syllabus_pdf,
        public readonly string $summary,
        public readonly string $prerequisites,
        public readonly string $weekly_schedule,
        public readonly string $grading,
        public readonly string $type_of_assessments
    ) {
    }

    /**
     * Create a CourseDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'] ?? '',
            category: $data['category'] ?? '',
            active: isset($data['active']) ? (bool)$data['active'] : false,
            duration_months: isset($data['duration_months']) ? (int)$data['duration_months'] : 0,
            mode_of_learning: $data['mode_of_learning'] ?? '',
            total_fee: isset($data['total_fee']) ? (float)$data['total_fee'] : 0.0,
            fee_currency: $data['fee_currency'] ?? '',
            monthly_fee: isset($data['monthly_fee']) ? (float)$data['monthly_fee'] : 0.0,
            syllabus_pdf: $data['syllabus_pdf'] ?? null,
            summary: $data['summary'] ?? '',
            prerequisites: $data['prerequisites'] ?? '',
            weekly_schedule: $data['weekly_schedule'] ?? '',
            grading: $data['grading'] ?? '',
            type_of_assessments: $data['type_of_assessments'] ?? ''
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
            'name' => $this->name,
            'category' => $this->category,
            'active' => $this->active,
            'duration_months' => $this->duration_months,
            'mode_of_learning' => $this->mode_of_learning,
            'total_fee' => $this->total_fee,
            'fee_currency' => $this->fee_currency,
            'monthly_fee' => $this->monthly_fee,
            'syllabus_pdf' => $this->syllabus_pdf,
            'summary' => $this->summary,
            'prerequisites' => $this->prerequisites,
            'weekly_schedule' => $this->weekly_schedule,
            'grading' => $this->grading,
            'type_of_assessments' => $this->type_of_assessments,
        ];
    }
}
