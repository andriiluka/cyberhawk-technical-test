<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property Blade[]|Collection $blades
 * @property Hub $hub
 * @property Rotor $rotor
 * @property Generator $generator
 */
class Turbine extends Model
{
    public function blades(): HasMany
    {
        return $this->hasMany(Blade::class);
    }

    public function rotor(): HasOne
    {
        return $this->hasOne(Rotor::class);
    }

    public function hub(): HasOne
    {
        return $this->hasOne(Hub::class);
    }

    public function generator(): HasOne
    {
        return $this->hasOne(Generator::class);
    }
}
