<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = ['recipient_detail_id','order_id', 'item_id', 'item_type', 'quantity', 'price', 'total_price'];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function recipientdetail()
    {
        return $this->belongsTo(RecipientDetail::class);
    }

    
}
