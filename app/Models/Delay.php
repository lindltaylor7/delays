<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delay extends Model
{
    protected $fillable = [
        'vehicle_id',
        'start_time',
        'end_time',
        'reason_id',
        'status',
        'user_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}
