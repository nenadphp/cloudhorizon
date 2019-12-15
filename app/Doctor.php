<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'doctor_id',
        'name'
    ];

    /**
     * @return Doctor[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getDoctors()
    {
        return self::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id','doctor_id')
            ->distinct('start_date');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clinic()
    {
        return $this->hasMany(Clinic::class, 'doctor_id','doctor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specialities()
    {
        return $this->hasMany(Specialty::class, 'doctor_id', 'doctor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients()
    {
        return $this->hasMany(Patient::class, 'doctor_id', 'doctor_id');
    }


}
