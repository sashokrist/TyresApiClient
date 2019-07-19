<?php

namespace App\Http\Resources;

use App\Gallery;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use App\Http\Resources\Images;

class Tyre extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //return all attribute from the collection
        // return parent::toArray($request);
        //return specific attributes from collection
        /*  $file_name = Gallery::all();
         foreach ($file_name as $img){
             $imgage = $img->file_name;
            // dd($imgage);
         }*/
        //dd($img);
        return [
            'id' => $this->id,
            'manufacture' => $this->manufacture->name,
            'description' => $this->manufacture->description,
            'logo' => $this->manufacture->logo,
            'price' => $this->price,
           // 'main_photo' => url($this->main_photo),
            'gallery' => $this->gallery,
            'type' => $this->tyre_type->type,
            'size' => $this->size,
            'manufactureDate' => $this->manufactureDate,

        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0.0',
            'author' => 'Great Token'
        ];
    }
}
