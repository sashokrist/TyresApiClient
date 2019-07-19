<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['file_name'];

    protected $appends = [
        'file_url'
    ];

    protected $hidden = [
        'file_name',
        'created_at',
        'updated_at',
        'tyre_id',
        'id'
    ];

    public function tyres()
    {
        return $this->belongsTo(Tyre::class, 'tyre_id');
    }

    public function getFileUrlAttribute()
    {
        return url($this->file_name);
    }
}
