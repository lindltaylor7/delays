<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delay extends Model
{
    protected $fillable = [
        'vehicle',
        'start_time',
        'end_time',
        'reason',
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
}
