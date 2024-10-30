<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'price',
        'color',
        'size',
        'sheets_per_set',
    ];

    // Relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function pictures()
    {
        return $this->hasMany(ProductPictures::class);
    }

    
}
