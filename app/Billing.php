<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
