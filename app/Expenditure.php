<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    public function type()
    {
        return $this->belongsTo(ExpenditureType::class, 'type_id');
    }
}
