<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = 'student_courses';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'conclusion_date', 'student_id', 'course_id'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'course_id');
    }
}
