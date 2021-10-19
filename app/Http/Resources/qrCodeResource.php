<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class qrCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->used != 0){
            return [
                'id'=>$this->id,
                'qrUrl'=>$this->code_url,
                'lesson'=>$this->lessons->title,
                'student'=>$this->student->fullName(),
                'created_at'=>$this->created_at->format('Y-m-d'),
                'valid_till'=>$this->valid_till,
            ];
        }
        return [
          'id'=>$this->id,
          'qrUrl'=>$this->code_url,
          'lesson'=>$this->lessons->title,
          'created_at'=>$this->created_at->format('Y-m-d'),
        ];
    }
}
