<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}
