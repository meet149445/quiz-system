<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $table = 'quiz_results';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'total'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}