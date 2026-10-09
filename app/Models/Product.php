<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'sku',
        'price',
        'stock',
        'condition',
        'location',
        'description',
        'image',
    ];

    public function category()
    {  
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}


