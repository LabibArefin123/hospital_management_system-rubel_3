<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'doctor_id',
        'service_id',
        'name',
        'age',
        'phone',
        'gender',
        'email',
        'appointment_date',
        'appointment_time',
        'payment_method',
        'amount',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
        'amount' => 'decimal:2',
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}