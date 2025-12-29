<?php

namespace App\Repositories;

use Log;
use Throwable;
use App\Models\Client;

class ClientRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    #create($client_dto) 
    public function create($client_dto)
    {
        $data = $client_dto->to_array();

        unset($data['id']);

        try 
        {
            return Client::create($data);
        }
         catch (Throwable $e) 
         {
            Log::error('Failed to create client', [
                'data' => $data,
                'exception' => $e,
            ]);
            return null;
        }
    }
}
