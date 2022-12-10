<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryexamResource extends JsonResource
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
            'exam' => $this->exam,
            'description' => $this->description,
            'material' => $this->material,
            'method' => $this->method,
            'use' => $this->use,
            'bibliography' => $this->bibliography,
            'referencevalues' => ReferencevalueResource::collection($this->referencevalues),
        ];
    }
}
