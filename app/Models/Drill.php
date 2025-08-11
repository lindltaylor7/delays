<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drill extends Model
{
    /** @use HasFactory<\Database\Factories\DrillFactory> */
    use HasFactory;

    protected $fillable = [
        'area',
        'zone',
        'bank',
        'project',
        'hour',
        'operator',
        'helper',
        'hour_meter_diesel',
        'fuel',
        'shift',
        'supervisor_owm',
        'supervisor_client',
        'equipment',
        'hour_start',
        'hour_end',
        'hours_worked',
        'total_hours',
        'total_drills',
        'total_real_meters',
        'total_reconciled_meters',
    ];
}
