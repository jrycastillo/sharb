<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortOfDischarge extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'city',
    ];
}
