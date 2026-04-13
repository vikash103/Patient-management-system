<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'speciality_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship with Speciality
     */
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    /**
     * Get speciality name
     */
    public function getSpecialityNameAttribute()
    {
        return $this->speciality ? $this->speciality->name : 'General';
    }

    /**
     * Get speciality short form
     */
    public function getSpecialityShortAttribute()
    {
        return $this->speciality ? $this->speciality->short_form : 'General';
    }

    /**
     * Get badge color for speciality
     */
    public function getBadgeColorAttribute()
    {
        return $this->speciality ? $this->speciality->badge_color : 'bg-gray-100 text-gray-800';
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }
}