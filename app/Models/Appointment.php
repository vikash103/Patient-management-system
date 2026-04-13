<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
    'doctor_id',
    'patient_id',
    'appointment_date',
    'appointment_time', // 👈 MUST ADD THIS
    'start_time',
    'end_time',
    'status',
    'notes'
];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    /**
     * Get formatted start time
     */
    public function getStartTimeFormattedAttribute()
    {
        return Carbon::parse($this->start_time)->format('h:i A');
    }

    /**
     * Get formatted end time
     */
    public function getEndTimeFormattedAttribute()
    {
        return Carbon::parse($this->end_time)->format('h:i A');
    }

    /**
     * Get duration in minutes
     */
    public function getDurationAttribute()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        
        return $start->diffInMinutes($end);
    }

    /**
     * Get formatted duration
     */
    public function getDurationFormattedAttribute()
    {
        $minutes = $this->duration;
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        
        if ($hours > 0) {
            return $hours . 'h ' . ($mins > 0 ? $mins . 'm' : '');
        }
        
        return $mins . ' min';
    }

    // Relationships
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}