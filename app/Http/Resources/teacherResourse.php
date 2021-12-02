<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class teacherResourse extends JsonResource
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
            'name'=>$this->nickName,
            'short_description'=>$this->short_description,
            'long_description'=>$this->long_description,
            'image'=>$this->image,
            'subject'=>$this->subject,
            'vedio'=>$this->vedio,
            'created_at'=>$this->created_at->format('m-d-Y'),
            'actions'=>'',
            'deleteLink'=>route('admin.teachers.delete',$this->id)
        ];
    }
}
