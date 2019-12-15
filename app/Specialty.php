<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'speciality_id',
        'doctor_id',
        'name'
    ];

    /**
     * @var string $table
     */
    protected $table = 'specialities';
}
