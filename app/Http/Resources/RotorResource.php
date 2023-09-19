<?php

namespace App\Http\Resources;

use App\Models\Rotor;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Rotor
 */
class RotorResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'grade' => $this->grade,
        ];
    }
}
