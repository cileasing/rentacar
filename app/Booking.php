<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use softDeletes;
    //
    // public $fillable = ['contact_name' ,'contact_email_address', 'contact_phone_number', 'start_date','end_date', 'po_number', 'invoice_status',
    //                      'task_document', 'reservation_office', 'reservation_officer', 'client_type', 'credit_type', 'reservation_date', 
    //                     'reservation_remark', 'cost', 'cid', 'del', 'created_by', 'logged_by'];

    public $fillable = [
        'type',
        'departure',
        'destination',
        'drop_off_address',
        'pickup_address',
        'pick_up_date',
        'end_date',
        'vehicle_category',
        'additional_services',
        'vehicle_make',
        'company_name',
        'email',
        'phone',
        'driver_id',
        'status',
        'admin_id',
        'company_id'
    ];
}

