<?php

namespace App\Services;

use App\DTOs\IntakeDTO;
use App\Repositories\IntakeRepository;

class IntakeService
{
    protected IntakeRepository $intake_repository;

    public function __construct(IntakeRepository $intake_repository)
    {
        $this->intake_repository = $intake_repository;
    }

    // create
    public function create(IntakeDTO $intake_dto)
    {
        $intake = $this->intake_repository->create($intake_dto);
        return $intake;
    }

    // update
    public function update(IntakeDTO $intake_dto)
    {
        $intake = $this->intake_repository->update($intake_dto);
        return $intake;
    }

    // fetch_all
    public function fetch_all()
    {
        return $this->intake_repository->fetch_all();
    }
}
