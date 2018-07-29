<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    const CLASS_A = 'A';
    const CLASS_B = 'B';

    protected $fillable = [
        'name', 'unit_id', 'class',
    ];

    public function products()
    {
        return $this->hasMany(VanDetail::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
