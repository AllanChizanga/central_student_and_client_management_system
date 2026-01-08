<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Log;
use Throwable;

class ClientRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // create($client_dto)
    public function create($client_dto)
    {
        $data = $client_dto->to_array();

        unset($data['id']);

        try {
            return Client::create($data);
        } catch (Throwable $e) {
            Log::error('Failed to create client', [
                'data' => $data,
                'exception' => $e,
            ]);
            return null;
        }
    }

    // update
    public function update($client_dto)
    {
        $data = $client_dto->to_array();

        if (!isset($data['id'])) {
            Log::error('Client ID is required for update', [
                'data' => $data,
            ]);
            return null;
        }

        $clientId = $data['id'];
        unset($data['id']);

        try {
            $client = Client::find($clientId);

            if (!$client) {
                Log::error('Client not found for update', [
                    'client_id' => $clientId,
                ]);
                return null;
            }

            $client->update($data);

            return $client;
        } catch (Throwable $e) {
            Log::error('Failed to update client', [
                'client_id' => $clientId,
                'data' => $data,
                'exception' => $e,
            ]);
            return null;
        }
    }

    // fetch_one_with_user

    public function fetch_one_with_user($clientId)
    {
        try {
            return Client::with('user')->find($clientId);
        } catch (Throwable $e) {
            Log::error('Failed to fetch client with user', [
                'client_id' => $clientId,
                'exception' => $e,
            ]);
            return null;
        }
    }

    public function fetch_all(): Collection
    {
        try
        {
            return Client::all();
        } 
        catch (Throwable $e) 
        {
            Log::error('Failed to fetch all clients', [
                'exception' => $e,
            ]);
            return collect();
        }
    }

    /**
     * Update the lifetime revenue contribution for the client associated with the provided ProjectVersion model.
     *
     * @param \App\Models\ProjectVersion $projectVersion
     * @param float $amount
     * @return bool
     */
    public function update_lifetime_revenue_contribution($projectVersion, float $amount): bool
    {
        try {
            $client = $projectVersion->client;

            if (!$client) {
                Log::error('Client not found for update_lifetime_revenue_contribution', [
                    'project_version_id' => $projectVersion->id,
                ]);
                return false;
            }

            $client->lifetime_revenue_contribution += $amount;
            $client->save();

            return true;
        } catch (Throwable $e) {
            Log::error('Failed to update lifetime revenue contribution', [
                'project_version_id' => $projectVersion->id,
                'amount' => $amount,
                'exception' => $e,
            ]);
            return false;
        }
    }
}
