<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqRecord extends Model
{
    protected $table = 'mcq_records';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'mcq_id',
        'select_ans',
        'is_correct',
    ];

    public function mcq()
    {
        return $this->belongsTo(Mcq::class, 'mcq_id');
    }
}