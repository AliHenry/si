<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Sell::class, 'tran_id');
    }
}
