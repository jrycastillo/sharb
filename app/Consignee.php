<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consignee extends Model
{
    //
    use softDeletes;
    protected $fillable = [
        'name',
        'postal',
        'address',
        'country',
        'contact',
        'city'

    ];
}
