<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Resources\Tyre as TyreResource;
use Illuminate\Http\Request;
use App\Tyre;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function index(){
        $gallery = Gallery::all();
        return TyreResource::collection($gallery);
    }

    public function  store(Request $request) {


        $tyreId = $request->input('tyre_id');
        $images = $request->input('image');
        foreach ($images as $image) {

            $filePath = public_path(time());
            File::put($filePath, $image);
            $gallery = new Gallery();
            $gallery->tyre_id = $tyreId;
            $gallery->file_name = $filePath;
            $gallery->save();
        }


    }
}
