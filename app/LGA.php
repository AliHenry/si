<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LGA extends Model
{
    protected $table = 'lgas';

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
