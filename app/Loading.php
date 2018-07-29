<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loading extends Model
{



    public function vans() {
        return $this->hasMany(Van::class);
    }

    public function loadingDetails() {
        return $this->hasMany(LoadingDetail::class);
    }
}
