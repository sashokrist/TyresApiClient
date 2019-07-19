<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TyreType extends Model
{
    public function manufacture()
    {
        return $this->hasM(Manufacture::class);
    }
}
