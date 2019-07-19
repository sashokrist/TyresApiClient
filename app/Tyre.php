<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tyre extends Model
{
    use Searchable;


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'tyres_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['manufacturer'] = $this->manufacture->name;
        $array['price'] = $this->price;
        $array['size'] = $this->size;
        $array['type'] = $this->tyre_type->type;
        $array['dot'] = $this->manufactureDate;

        // Customize array...

        return $array;
    }

        public function gallery(){
        return $this->hasMany(Gallery::class);
    }

    public function manufacture(){
        return $this->belongsTo(Manufacture::class);
    }

    public function tyre_type(){
        return $this->belongsTo(TyreType::class, 'type_type_id', 'id');
    }


}
