<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'service_id',
        'quantity',
        'total_amount',
    ];

    // Relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Optionally, relationships for Product and Service
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    
}
