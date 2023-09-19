<?php

namespace App\DTO;

class TurbineDto
{
    /**
     * @var array|BladeDto[]
     */
    public array $blades = [];

    public RotorDto $rotor;

    public HubDto $hub;

    public GeneratorDto $generator;
}
