<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street', 'neighbor', 'city', 'state', 'cep', 'student_id',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
