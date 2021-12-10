<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class studentExamResource extends JsonResource
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
            'lesson' => $this->lesson->title ?? 'تم مسح الدرس',
            'grade' => $this->grade,
            'resultLink' => '<a href="' . route('resultExam', $this->id) . '">عرض النتيجة</a>',
        ];
    }
}
