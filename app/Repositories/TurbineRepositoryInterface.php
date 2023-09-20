<?php

namespace App\Repositories;

use App\DTO\TurbineDto;
use App\Models\Turbine;
use Illuminate\Database\Eloquent\Collection;

interface TurbineRepositoryInterface
{
    /**
     * @return Collection|Turbine[]
     */
    public function getAll(): Collection;

    public function create(TurbineDto $turbineDto): Turbine;

    public function find(int $id): Turbine|null;

    public function update(TurbineDto $turbineDto, Turbine $turbine): void;

    public function delete(int $id): void;
}
