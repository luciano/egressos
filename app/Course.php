<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'typ',
    ];

    public function studentCourse()
    {
        return $this->belongsTo('App\StudentCourse');
    }
}
