<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'clinic_id',
        'doctor_id',
        'name'
    ];

    protected $table = 'clinics';
}
