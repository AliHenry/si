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
}
