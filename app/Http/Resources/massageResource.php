<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class massageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullName' => $this->user->full_name,
            'read' => $this->not_read == 0 ? 2 : 1,
            'status' => $this->not_read == 0 ? 'Read' : 'NOT Read',
            'actions' => '',
            'viewLink' => route('admin.chat.view', $this->id),
        ];
    }
}
