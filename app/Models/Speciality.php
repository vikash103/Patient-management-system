<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Speciality extends Model
{
    protected $fillable = ['name'];

    public function doctors()
    {
        return $this->hasMany(User::class, 'speciality_id')
                    ->where('role', 'doctor');
    }
}