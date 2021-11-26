<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class centerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'address'=>$this->address,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'updated_at'=>$this->updated_at > '1999-12-30'?$this->updated_at->format('Y-m-d'):$this->created_at->format('Y-m-d'),
            'actions'=>'',
            'updateLink'=>route('admin.teachers.center.show',$this->id),
            'deleteLink'=>route('admin.teachers.center.delete',$this->id)
        ];
    }
}
