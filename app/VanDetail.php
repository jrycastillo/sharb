<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VanDetail extends Model
{
    //
    protected $fillable = [
        'van_id', 'product_id', 'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
