<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Database\Eloquent\Collection;

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

    # update 
    public function update($client_dto)
    {
        return  $this->client_repository->update($client_dto);
    }

    #fetch_one 
    public function fetch_one_with_user($client_id)
    { 

        return $this->client_repository->fetch_one_with_user($client_id);
    }
  
    public function fetch_all(): Collection
    {
        return $this->client_repository->fetch_all();
    }

public function update_lifetime_revenue_contribution($project_version, $amount)
{
    return $this->client_repository->update_lifetime_revenue_contribution($project_version, $amount);
}

}
