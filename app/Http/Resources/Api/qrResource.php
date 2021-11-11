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
        $mainCats = [];
        foreach ($this->teacher->mainCategories as $cat){
           $mainCats[]= [ 'id'=> $cat->id,
                'name'=> $cat->name,
                'desc'=> $cat->desc,
                'user_id'=> $cat->user_id,];
        }
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
            'title'=>$this->lessons->title,
            'vedio'=>json_decode($this->lessons->vedio),
            'description'=>$this->lessons->description,
            'img'=>$this->lessons->img,
            'views'=>$this->lessons->views,
            'category_id'=>$this->lessons->category_id,
            'user_id'=>$this->lessons->user_id,
            'created_at'=>$this->lessons->created_at,
            'updated_at'=>$this->lessons->updated_at,
        ];
        $arr['teacher']=[
            'id'=>$this->teacher->id,
            'nickName'=>$this->teacher->nickName,
            'long_description'=>$this->teacher->long_description,
            'short_description'=>$this->teacher->short_description,
            'vedio'=>$this->teacher->vedio,
            'subject'=>$this->teacher->subject,
            'image'=>$this->teacher->image,
            'user_id'=>$this->teacher->user_id,
            'created_at'=>$this->teacher->created_at,
            'updated_at'=>$this->teacher->updated_at,
            'main_categories'=>$mainCats,
        ];
        return $arr;
    }
}
