<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
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
            'id' => (string) $this->id,
            'title'  => $this->title,
            'description' => $this->description,
            'publisher' => $this->publisher,
            'author' => $this->author,
            'cover_photo' => url($this->cover_photo),
            'price' => $this->price,
        ];
    }
}
