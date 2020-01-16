<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAudit extends Model
{
    public function store()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_audits_products', 'store_audit_id', 'prod_id')
            ->withPivot('balanced', 'missing', 'note')
            ->withTimestamps();
    }
}
