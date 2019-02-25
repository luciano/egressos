<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'name', 'typ',
    ];

    public function student_course()
    {
        return $this->belongsTo('App\StudentCourse');
    }
}
