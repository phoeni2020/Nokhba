<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class questionResource extends JsonResource
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
          'question'=>$this->question,
          'created_at'=>$this->created_at->format('m-d-Y'),
          'actions'=>'',
          'updateLink' => route('admin.exam.question.edit',$this->id),
        ];
    }
}
