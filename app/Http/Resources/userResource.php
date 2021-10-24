<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
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
          'fullName'=>$this->fullName(),
          'email'=>$this->email,
          'phone'=>$this->phone,
          'parentPhone'=>$this->parentPhone,
          'created_at'=>$this->created_at->format('m-d-Y'),
          'actions'=>'',
          'deleteLink'=>route('admin.user.delete',$this->id),
          'viewLink'=>route('admin.user.view',$this->id),
        ];
    }
}
