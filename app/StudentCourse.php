<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = [
        'conclusion_date', 'student_id', 'course_id'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function course()
    {
        return $this->hasOne('App\Course');
    }
}
