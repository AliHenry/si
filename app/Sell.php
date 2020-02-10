<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(PaymentType::class, 'trans_type_id');
    }

    public function status()
    {
        return $this->belongsTo(PaymentStatus::class, 'trans_status_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sells_products', 'trans_id', 'prod_id')
            ->withPivot('qty', 'total', 'trans_status_id')
            ->withTimestamps();
    }
}
