<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectBooking extends Model
{
    
    use SoftDeletes;
    //
    public $fillable = [
        'user_id',
        'username',
        'phone',
        'company_name',
        'pickup_address',
        'pickup_name',
        'pickup_latitude',
        'pickup_longitude',
        'dropoff_address',
        'dropoff_name',
        'dropoff_latitude',
        'dropoff_longitude',
        'status',
        'company_id'
    ];
}
