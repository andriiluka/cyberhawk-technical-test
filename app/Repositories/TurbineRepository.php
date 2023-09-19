<?php

namespace App\Repositories;

use App\DTO\TurbineDto;
use App\Models\Blade;
use App\Models\Generator;
use App\Models\Hub;
use App\Models\Rotor;
use App\Models\Turbine;
use Illuminate\Database\Eloquent\Collection;

class TurbineRepository implements TurbineRepositoryInterface
{
    /**
     * @return Collection|Turbine[]
     */
    public function getAll(): Collection
    {
        return Turbine::all();
    }

    public function create(TurbineDto $turbineDto): Turbine
    {
        $turbine = new Turbine();
        $turbine->save();

        foreach ($turbineDto->blades as $bladeDto) {
            $blade = new Blade();
            $blade->grade = $bladeDto->grade;
            $turbine->blades()->save($blade);
        }

        $hub = new Hub();
        $hub->grade = $turbineDto->hub->grade;
        $turbine->hub()->save($hub);

        $rotor = new Rotor();
        $rotor->grade = $turbineDto->rotor->grade;
        $turbine->rotor()->save($rotor);

        $generator = new Generator();
        $generator->grade = $turbineDto->generator->grade;
        $turbine->generator()->save($generator);

        return $turbine;
    }

    public function find(int $id): Turbine|null
    {
        return Turbine::query()
            ->with(['blades', 'rotor', 'hub', 'generator'])
            ->where('id', $id)
            ->first();
    }

    public function update(TurbineDto $turbineDto, Turbine $turbine): void
    {
        foreach ($turbineDto->blades as $bladeDto) {
            /** @var Blade $blade */
            $blade = $turbine->blades->firstWhere('id', $bladeDto->id);
            $blade->grade = $bladeDto->grade;
            $blade->save();
        }

        $turbine->hub->grade = $turbineDto->hub->grade;
        $turbine->hub->save();

        $turbine->rotor->grade = $turbineDto->rotor->grade;
        $turbine->rotor->save();

        $turbine->generator->grade = $turbineDto->generator->grade;
        $turbine->generator->save();
    }

    public function delete(int $id): void
    {
        Turbine::destroy($id);
    }
}
