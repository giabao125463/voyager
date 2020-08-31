<?php

namespace App;

use App\Models\DoctorHospital;
use App\Models\Hospital;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'settings', 'avatar', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all hospital of this doctor
     *
     * @return belongsToMany
     */
    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'doctor_hospital', 'doctor_id', 'hospital_id')->withTimestamps();
    }

    /**
     * Return hospital's id list
     *
     * @return json
     */
    public function getHospitalIdsAttribute()
    {
        $hospitals = $this->hospitals()->pluck('hospitals.id');
        if ($hospitals->count() > 0) {
            return json_encode($hospitals->toArray());
        }

        return json_encode([]);
    }
}
