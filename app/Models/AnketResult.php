<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnketResult extends Model
{
    public $fillable = ['anket_access_id', 'doctor_id', 'answers', 'anket_id', 'created_by', 'hospital_id'];

    /**
     * Get Anket access
     *
     * @return model
     */
    public function anketAccess()
    {
        return $this->belongsTo(\App\Models\AnketAccess::class, 'anket_access_id', 'id')->withTrashed();
    }

    /**
     * Get User info
     *
     * @return model
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'created_by', 'id');
    }

    /**
     * Get Doctor info
     *
     * @return model
     */
    public function doctor()
    {
        return $this->belongsTo(\App\User::class, 'doctor_id', 'id');
    }

    /**
     * Get Hospital info
     *
     * @return model
     */
    public function hospital()
    {
        return $this->belongsTo(\App\Models\Hospital::class, 'hospital_id', 'id');
    }
}
