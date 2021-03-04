<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function discount()
    {
        return $this->morphTo(__FUNCTION__, 'discount_type_type', 'discount_type_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
