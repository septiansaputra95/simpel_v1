<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmasi_konsumsi extends Model
{
    use HasFactory;

    protected $table = "pharmacy_consumption";
 
    protected $fillable = [
        'document_no',
        'consumed_date',
        'department',
        'storename',
        'mrn',
        'visit_no',
        'patient_name',
        'gender',
        'admitting_doctor',
        'treating_doctor',
        'document_type',
        'item_type',
        'item_category',
        'item_code',
        'item_name',
        'batch_no',
        'qty',
        'vendor',
        'consumed_time',
        'visit_type',
        'tanggalinput'
    ];
}
