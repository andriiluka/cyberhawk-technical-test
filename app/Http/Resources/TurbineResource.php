<?php

namespace App\Http\Resources;

use App\Models\Turbine;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Turbine
 */
class TurbineResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'blades' => BladeResource::collection($this->whenLoaded('blades')),
            'rotor' => new RotorResource($this->whenLoaded('rotor')),
            'hub' => new HubResource($this->whenLoaded('hub')),
            'generator' => new GeneratorResource($this->whenLoaded('generator')),
        ];
    }
}
