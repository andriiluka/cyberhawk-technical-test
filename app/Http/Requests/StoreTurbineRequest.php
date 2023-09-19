<?php

namespace App\Http\Requests;

use App\DTO\BladeDto;
use App\DTO\GeneratorDto;
use App\DTO\HubDto;
use App\DTO\RotorDto;
use App\DTO\TurbineDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreTurbineRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'blades' => 'array|max:3',
            'blades.*.grade' => 'integer|max:5',
            'rotor.grade' => 'integer|max:5',
            'hub.grade' => 'integer|max:5',
            'generator.grade' => 'integer|max:5',
        ];
    }

    public function data(): TurbineDto
    {
        $turbine = new TurbineDto();

        foreach ($this->input('blades', []) as $bladeItem) {
            $blade = new BladeDto();
            $blade->id = Arr::get($bladeItem, 'id');
            $blade->grade = $bladeItem['grade'];
            $turbine->blades[] = $blade;
        }

        $rotor = new RotorDto();
        $rotor->grade = $this->input('rotor.grade');
        $turbine->rotor = $rotor;

        $hub = new HubDto();
        $hub->grade = $this->input('hub.grade');
        $turbine->hub = $hub;

        $generator = new GeneratorDto();
        $generator->grade = $this->input('generator.grade');
        $turbine->generator = $generator;

        return $turbine;
    }
}
