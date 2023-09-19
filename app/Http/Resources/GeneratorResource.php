<?php

namespace App\Http\Resources;

use App\Models\Generator;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Generator
 */
class GeneratorResource extends JsonResource
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
