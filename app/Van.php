<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Van extends Model
{
    //
    protected $fillable = [
        'loading_id', 'van_no', 'seal_no'
    ];


    public function vanDetails() {
        return $this->hasMany(VanDetail::class);
    }
}
