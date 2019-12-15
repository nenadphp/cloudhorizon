<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'name',
        'date_of_birth',
        'sex',
    ];
}
