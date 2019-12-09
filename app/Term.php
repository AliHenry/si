<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}
