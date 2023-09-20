<?php

namespace App\Http\Resources;

use App\Models\Hub;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Hub
 */
class HubResource extends JsonResource
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
