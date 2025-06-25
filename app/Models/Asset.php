<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'functional_location',
        'description',
        'sap_functional_location',
        'status',
        'vertical',
        'subvertical',
        'location_category',
        'voltage_level',
        'business_area',
        'maintenance_work_center',
        'station_area'
    ];
}
