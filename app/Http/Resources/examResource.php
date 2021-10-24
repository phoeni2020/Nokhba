<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class examResource extends JsonResource
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
            'grade'=>$this->grade,
            'done'=>$this->is_done,
            'student'=>$this->student->full_name
        ];
    }
}
