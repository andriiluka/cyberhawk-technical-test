<?php

namespace App\Http\Requests;

class UpdateTurbineRequest extends StoreTurbineRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'blades.*.id' => 'integer',
        ]);
    }
}
