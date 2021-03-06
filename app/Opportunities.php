<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunities extends Model
{
    public function admin() {
        // a sigle post belongs to an admin
        return $this->belongsTo('App\Admin');
    }
}
