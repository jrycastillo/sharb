<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = [
        'unit_id',
        'price'
    ];


    public function loadings() {
        return $this->belongsToMany(Loading::class);
    }
}
