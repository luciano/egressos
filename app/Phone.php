<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'number', 'student_id',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
