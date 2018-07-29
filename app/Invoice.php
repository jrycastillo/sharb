<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    const TERM_FOB = 'FOB';
    const TERM_CNF = 'CNF';

    const NEW = 'new';
    const OLD = 'old';

    protected $fillable = [
        'loading_id', 'term'
    ];
}
