<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class notificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array = [];

        foreach (json_decode($this->body,true) as $key => $item) {
            $array[$key] = $item;
        }
        return [
            'id'=>$this->id,
            'title'=>$array['title'],
            'img'=>$array['img'],
            'thaumbnail'=>$array['thaumbnail'],
            'actionName'=>$array['action']['name'],
            'actionUrl'=>$array['action']['url'],
        ];
    }
}
