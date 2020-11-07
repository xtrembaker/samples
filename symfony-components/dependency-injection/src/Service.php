<?php

namespace App;

class Service
{
    private $repository;
    private $alertRepository;

    public function __construct(
        IRepository $repository,
        AlertRepository $alertRepository
    )
    {
        $this->repository = $repository;
        $this->alertRepository = $alertRepository;
    }

    public function process(): string
    {
        return implode("\n", [
            $this->repository->save(),
            $this->alertRepository->save()
        ]);
    }
}