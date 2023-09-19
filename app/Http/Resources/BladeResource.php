<?php

namespace App\Http\Resources;

use App\Models\Blade;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Blade
 */
class BladeResource extends JsonResource
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
