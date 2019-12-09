<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'pay_type_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function lga()
    {
        return $this->belongsTo(LGA::class, 'lga_id');
    }
}
