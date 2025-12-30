<?php

namespace App\DTOs;

/**
 * Data Transfer Object for App\Models\ProjectMilestone
 */
class ProjectMilestoneDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly string $project_version_id,
        public readonly string $title,
        public readonly string $deliverables,
        public readonly int $duration_days,
        public readonly float $amount,
        public readonly string $payment_status,
        public readonly string $due_date,
        public readonly string $developers_notes
    ) {
    }

    /**
     * Create a ProjectMilestoneDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            project_version_id: $data['project_version_id'] ?? '',
            title: $data['title'] ?? '',
            deliverables: $data['deliverables'] ?? '',
            duration_days: isset($data['duration_days']) ? (int) $data['duration_days'] : 0,
            amount: isset($data['amount']) ? (float) $data['amount'] : 0.0,
            payment_status: $data['payment_status'] ?? 'pending',
            due_date: $data['due_date'] ?? '',
            developers_notes: $data['developers_notes'] ?? ''
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
            'project_version_id' => $this->project_version_id,
            'title' => $this->title,
            'deliverables' => $this->deliverables,
            'duration_days' => $this->duration_days,
            'amount' => $this->amount,
            'payment_status' => $this->payment_status,
            'due_date' => $this->due_date,
            'developers_notes' => $this->developers_notes,
        ];
    }
}
