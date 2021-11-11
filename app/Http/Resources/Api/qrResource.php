<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class qrResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr =['qr_Code'=>[
            'qrcode_id'=>$this->id,
            'code_text'=>$this->code_text,
            'code_url'=>$this->code_url,
            'used'=>$this->used,
            'student_id'=>$this->student_id,
            'valid_till'=>$this->valid_till,
        ]];
        $arr['lessons']=[
            'id'=>$this->lessons->id,
            'title'=>$this->lessons,
        ];
        return $arr;
    }
}
