<?php

namespace App\DTOs;

/**
 * Data Transfer Object for App\Models\ProjectVersion
 */
class ProjectVersionDTO
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly int $version_number,
        public readonly string $client_id,
        public readonly string $project_version_name,
        public readonly string $project_progress_status,
        public readonly string $start_date,
        public readonly string $end_date,
        public readonly string $brd_document,
        public readonly string $contract,
        public readonly string $nda,
        public readonly ?string $quotation_id = null,
        public readonly int $sprint_duration_days = 0,
        public readonly float $hosting_and_domain_fee = 0.00,
        public readonly bool $has_whatsapp_integration = false,
        public readonly bool $has_ai_integration = false,
        public readonly bool $has_payments_integration = false,
        public readonly bool $has_other_third_party_integrations = false,
        public readonly string $maintenance_type,
        public readonly float $maintenance_fee_monthly = 0.00,
        public readonly string $billing_type,
        public readonly float $amount = 0.00,
        public readonly float $paid = 0.00,
        public readonly float $balance = 0.00,
        public readonly string $currency = 'USD'
    ) {
    }

    /**
     * Create a ProjectVersionDTO from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function from_array(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            version_number: isset($data['version_number']) ? (int) $data['version_number'] : 0,
            client_id: $data['client_id'] ?? '',
            project_version_name: $data['project_version_name'] ?? '',
            project_progress_status: $data['project_progress_status'] ?? '',
            start_date: $data['start_date'] ?? '',
            end_date: $data['end_date'] ?? '',
            brd_document: $data['brd_document'] ?? '',
            contract: $data['contract'] ?? '',
            nda: $data['nda'] ?? '',
            quotation_id: $data['quotation_id'] ?? null,
            sprint_duration_days: isset($data['sprint_duration_days']) ? (int) $data['sprint_duration_days'] : 0,
            hosting_and_domain_fee: isset($data['hosting_and_domain_fee']) ? (float) $data['hosting_and_domain_fee'] : 0.00,
            has_whatsapp_integration: isset($data['has_whatsapp_integration']) ? (bool) $data['has_whatsapp_integration'] : false,
            has_ai_integration: isset($data['has_ai_integration']) ? (bool) $data['has_ai_integration'] : false,
            has_payments_integration: isset($data['has_payments_integration']) ? (bool) $data['has_payments_integration'] : false,
            has_other_third_party_integrations: isset($data['has_other_third_party_integrations']) ? (bool) $data['has_other_third_party_integrations'] : false,
            maintenance_type: $data['maintenance_type'] ?? '',
            maintenance_fee_monthly: isset($data['maintenance_fee_monthly']) ? (float) $data['maintenance_fee_monthly'] : 0.00,
            billing_type: $data['billing_type'] ?? '',
            amount: isset($data['amount']) ? (float) $data['amount'] : 0.00,
            paid: isset($data['paid']) ? (float) $data['paid'] : 0.00,
            balance: isset($data['balance']) ? (float) $data['balance'] : 0.00,
            currency: $data['currency'] ?? 'USD',
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
            'version_number' => $this->version_number,
            'client_id' => $this->client_id,
            'project_version_name' => $this->project_version_name,
            'project_progress_status' => $this->project_progress_status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'brd_document' => $this->brd_document,
            'contract' => $this->contract,
            'nda' => $this->nda,
            'quotation_id' => $this->quotation_id,
            'sprint_duration_days' => $this->sprint_duration_days,
            'hosting_and_domain_fee' => $this->hosting_and_domain_fee,
            'has_whatsapp_integration' => $this->has_whatsapp_integration,
            'has_ai_integration' => $this->has_ai_integration,
            'has_payments_integration' => $this->has_payments_integration,
            'has_other_third_party_integrations' => $this->has_other_third_party_integrations,
            'maintenance_type' => $this->maintenance_type,
            'maintenance_fee_monthly' => $this->maintenance_fee_monthly,
            'billing_type' => $this->billing_type,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'balance' => $this->balance,
            'currency' => $this->currency,
        ];
    }
}
