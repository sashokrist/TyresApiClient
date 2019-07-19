<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTyreRequest;
use App\Http\Resources\Search as SearchResources;
use App\Manufacture;
use App\TyreType;
use function foo\func;
use Illuminate\Http\Request;
use App\Tyre;
use App\Gallery;
use App\Http\Resources\Tyre as TyreResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class TyreController extends Controller
{

    public function index()
    {
        if (request()->has('query')) {
            $tyres = Tyre::search(request()->get('query'))->get();
        } else {
            $tyres = Tyre::with('gallery', 'manufacture', 'tyre_type')->get();
        }
        return TyreResource::collection($tyres);
    }

    public function store(Request $request)
    {
        $manufacture = new Manufacture();
        $manufacture->name = $request->input('manufacture');
        $manufacture->description = $request->input('description');
        $logoImg = $request->input('logo');
        $logo = base64_decode($logoImg);
        $logoName = 'logo'.md5(time()).'.jpg';
        File::put($logoName, $logo);
        $manufacture->logo = $logoName;
        $manufacture->save();

        $tyre_type = new TyreType();
        $tyre_type->type = $request->input('type');
        $tyre_type->save();

        $manufacture_id = $manufacture->id;
        $type_type_id = $tyre_type->id;

        $tyre = new Tyre();
        $tyre->manufacture_id = $manufacture_id ;
        $tyre->type_type_id = $type_type_id;
        $tyre->price = $request->input('price');
        $tyre->size = $request->input('size');
        //$tyre->type = $request->input('type');
        $tyre->manufactureDate = $request->input('manufactureDate');
        $tyre->save();

        $id = $tyre->id;

        $images = $request->input('image');

        foreach ($images as $image) {
            $image = base64_decode($image);
            $fileName = md5(time()).'.jpg';
            File::put($fileName, $image);
            $tyreImg = new Gallery();
            $tyreImg->tyre_id = $id;
            $tyreImg->file_name = $fileName;
            $tyreImg->save();
        }

        return new TyreResource($tyre);
    }

    public function edit(Request $request, $id)
    {
        $manufacture = Manufacture::findOrFail($id);

        $manufacture_id = $manufacture->id;

        $tyre = Tyre::findOrFail($manufacture_id);
        $tyre->manufacture->name = $request->input('manufacture');
        $tyre->manufacture->description = $request->input('description');

        $logoImg = $request->input('logo');
        $logoName = md5(time()).'.jpg';
        File::put($logoName, $logoImg);
        $tyre->manufacture->logo = $logoName;

        $tyre->manufacture_id = $$manufacture_id;
        $tyre->type_type_id = $tyre->tyre_type->id;
        $tyre->price = $request->input('price');
        $tyre->size = $request->input('size');
        $tyre->tyre_type->type = $request->input('type');
        $tyre->manufactureDate = $request->input('manufactureDate');
        $tyre->save();

        $id = $tyre->id;

        $images = $request->input('image');

        foreach ($images as $image) {
            $image = base64_decode($image);
            $fileName = md5(time()).'.jpg';
            File::put($fileName, $image);
            $tyreImg = new Gallery();
            $tyreImg->tyre_id = $id;
            $tyreImg->file_name = $fileName;
            $tyreImg->save();
        }

        return new TyreResource($tyre);
    }




    public function show($id)
    {
       $tyre = Tyre::findOrFail($id);
        return new TyreResource($tyre);

    }


    public function destroy($id)
    {
        $tyre = Tyre::findOrFail($id);

        if ($tyre->delete()){
            return new TyreResource($tyre);
        }

    }

    public function search(SearchTyreRequest $request)
    {
       $keyword = $request->validated();
       //dd($keyword);

       foreach ($keyword as $item){
           $query = $item;
           if (request()->has($query)) {
               $tyres = Tyre::search(request()->get($query))->get();
               return TyreResource::collection($tyres);
           } else {
               return response()->json('No record found');
           }

       }





      /* $exists = Manufacture::with('tyres.tyre_type' )
           ->where('name', 'like', '%'. $keyword['keyword']. '%')
           ->orWhere('description', 'like', '%'. $keyword['keyword']. '%')
           ->orWhereHas('tyres.tyre_type', function ($query) use ($keyword) {
            $query->where('type', 'like', '%'. $keyword['keyword']. '%');
        })
         ->orWhereHas('tyres', function ($query) use ($keyword) {
             $query->where('size', 'like', '%'. $keyword['keyword']. '%');
         })->get();*/

       //return new SearchResources($exists);
       /* if ($exists->count() == 0){
            //return SearchResources::collection($exists);
            return response()->json('Record not found', 404);
        } else{
           // echo 'No records';
            return SearchResources::collection($exists);
        }*/

    }

}
