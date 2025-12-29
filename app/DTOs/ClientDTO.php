<?php

namespace App\DTOs;

/**
 * Data Transfer Object for App\Models\Client
 */
class ClientDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly string $user_id,
        public readonly string $company_name,
        public readonly string $industry,
        public readonly float $lifetime_revenue_contribution,
        public readonly string $country,
        public readonly string $city,
        public readonly string $occupation,
        public readonly string $address,
        public readonly string $client_type,
        public readonly string $client_status
    ) {
    }

    /**
     * Create a ClientDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            user_id: $data['user_id'] ?? '',
            company_name: $data['company_name'] ?? '',
            industry: $data['industry'] ?? '',
            lifetime_revenue_contribution: isset($data['lifetime_revenue_contribution']) ? (float) $data['lifetime_revenue_contribution'] : 0.0,
            country: $data['country'] ?? '',
            city: $data['city'] ?? '',
            occupation: $data['occupation'] ?? '',
            address: $data['address'] ?? '',
            client_type: $data['client_type'] ?? '',
            client_status: $data['client_status'] ?? ''
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
            'company_name' => $this->company_name,
            'industry' => $this->industry,
            'lifetime_revenue_contribution' => $this->lifetime_revenue_contribution,
            'country' => $this->country,
            'city' => $this->city,
            'occupation' => $this->occupation,
            'address' => $this->address,
            'client_type' => $this->client_type,
            'client_status' => $this->client_status,
        ];
    }
}
