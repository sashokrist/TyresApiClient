<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    public function tyres()
    {
        return $this->hasMany(Tyre::class);
    }

    public function typeTyre()
    {
        return $this->belongsTo(TyreType::class, 'type_type_id', 'id');
    }

    public function rules()
    {
        $this->sanitize();
        return [


        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['keyword'] = filter_var($input['keyword'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}
