<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'speciality',
        'image',
        'success_rate',
        'experience_years',
        'total_patients',
        'qualification',
        'location',
        'consultation_fee',
        'availability',
        'about',
    ];

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}