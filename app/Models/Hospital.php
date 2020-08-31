<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['name', 'code', 'ankets'];

    protected $casts = [
        'ankets' => 'array',
    ];

    /**
     * Get Anket Types as string
     *
     * @return string
     */
    public function getAnketTypesAttribute()
    {
        $anketTypes  = [];
        $anketConfig = config('consts.anketo.items');
        foreach (json_decode($this->ankets) as $anketId) {
            $anketTypes[] = $anketConfig[$anketId];
        }

        return implode('<br>', $anketTypes);
    }

    /**
     * Get all doctor of this hospital
     *
     * @return belongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_hospital', 'hospital_id', 'doctor_id');
    }
}
