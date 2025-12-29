<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    protected ClientRepository $client_repository;
    public function __construct(ClientRepository $client_repository)
    {
        $this->client_repository = $client_repository;
    }


    #create 
    public function create($client_dto)
    {
        return  $this->client_repository->create($client_dto);
    }
}
