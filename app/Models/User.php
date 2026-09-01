<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'phone_2',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
 
    /* Profile Image Helpers*/
    public function getProfilePictureUrl()
    {
        return $this->profile_picture
            ? asset('images/' . $this->profile_picture)
            : asset('uploads/images/default.jpg');
    }

    public function getProfileImageAttribute()
    {
        return $this->profile_picture
            ? Storage::url($this->profile_picture)
            : asset('uploads/images/default.jpg');
    }

    public function adminlte_image()
    {
        return $this->profile_picture
            ? Storage::url($this->profile_picture)
            : asset('uploads/images/default.jpg');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
