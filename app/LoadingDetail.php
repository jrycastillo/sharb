<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadingDetail extends Model
{
    const APPROVED = 'approved';
    const DISAPPROVED = 'disapproved';
    const UNCHECK = 'uncheck';
    const BOOKING = 'booking';
    const ADDPRODUCT = 'ADDPRODUCT';


    const NEW = 'new';
    const OLD = 'old';


    protected $fillable = [
        'loading_id',
        'BL_no',
        'productionWeek',
        'shipmentWeek',
        'rev',
        'rev_no',
        'ETD',
        'ETA',
        'voyage_no',
        'status',
        'year',
        'vessel',
        'supplier_id',
        'exporter_id',
        'carrier_id',
        'portOfDischarge_id',
        'portOfLoading_id'
    ];


    public function vans()
    {
        return $this->hasMany(Van::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
