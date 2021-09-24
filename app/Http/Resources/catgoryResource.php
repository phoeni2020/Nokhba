<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class catgoryResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'main'=>$this->main == 0 ? 'تصنيف رئيسي':'تصنيف فرعي',
            'is_parent'=>$this->is_parent == 0 ? 'تصنيف فرعي ليس له تصنيفات ترث منه':'تصنيف فرعي له تصنيفات اخري ترث منه',
            'desc'=>$this->desc,
            'created_at'=>$this->created_at->format('m-d-Y'),
            'updated_at'=>$this->updated_at->format('m-d-Y'),
        ];
    }
}
