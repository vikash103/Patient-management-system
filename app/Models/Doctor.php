<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Speciality;
use App\Models\DoctorSchedule;
use App\Models\Appointment;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'name',
        'speciality_id'
    ];

    /**
     * Doctor belongs to User
     * Used to get doctor email from users table
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Doctor belongs to Speciality
     */
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    /**
     * Doctor has many schedules
     */
    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    /**
     * Doctor has many appointments
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * Get doctor email directly
     */
    public function getEmailAttribute()
    {
        return $this->user->email ?? null;
    }

    
}