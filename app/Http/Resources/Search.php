<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Search extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
          'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
           // 'price' => $this->tyres->price,
            'type' => $this->tyre_type,
            'tyre' => $this->tyres,
        ];

    }
}
