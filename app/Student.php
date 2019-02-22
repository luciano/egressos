<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'register', 'bithday', 'gender', 'user_id',
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function studentCourse() 
    {
        return $this->hasMany('App\StudentCourse');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function phone()
    {
        return $this->hasMany('App\Phone');
    }
}
