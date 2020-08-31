<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    protected $table = 'survey_results';

    protected $fillable = [
        'user_id',
        'survey_id',
        'answer'
    ];
}
