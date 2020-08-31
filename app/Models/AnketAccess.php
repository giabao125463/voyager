<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnketAccess extends Model
{
    use SoftDeletes;

    public $fillable = ['patient_code', 'password', 'doctor_id', 'anket_id','qrcode_hash', 'hospital_id'];

    /**
     * Get doctor information
     *
     * @return model
     */
    public function doctor()
    {
        return $this->belongsTo(\App\User::class, 'doctor_id', 'id');
    }

    /**
     * Get Anket Result list
     *
     * @return collection
     */
    public function results()
    {
        return $this->hasMany(\App\Models\AnketResult::class, 'anket_access_id', 'id');
    }

    /**
     * Get Hospital information
     *
     * @return model
     */
    public function hospital()
    {
        return $this->belongsTo(\App\Models\Hospital::class, 'hospital_id', 'id');
    }
}
