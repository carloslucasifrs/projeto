<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferencevalueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'rule' => $this->rule,
            'biologic_sex' => $this->biologic_sex,
            'age_min' => $this->age_min,
            'age_max' => $this->age_max,
            'value_min' => $this->value_min,
            'value_max' => $this->value_max,
            'laboratoryexam_id' => $this->laboratoryexam_id,
        ];
    }
}
