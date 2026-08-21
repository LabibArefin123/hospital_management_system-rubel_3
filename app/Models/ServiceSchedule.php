<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    protected $fillable = [
        'service_id',
        'date',
        'time',
        'is_booked',
    ];

    protected $casts = [
        'date' => 'date',
        'is_booked' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
