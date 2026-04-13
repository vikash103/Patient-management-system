<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $fillable = [
'doctor_id',
'start_time',
'end_time',
'slot_minutes',
'week_days',
'break_start',
'break_end'
];

public function doctor()
{
return $this->belongsTo(User::class,'doctor_id');
}
}