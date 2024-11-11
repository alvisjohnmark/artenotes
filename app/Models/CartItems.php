<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CartItems extends Model
{
    use HasFactory;

    protected $fillable = ['recipient_detail_id','cart_id', 'item_id', 'item_type', 'quantity', 'price', 'total_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'item_id');
    }
    public function recipientDetail()
    {
        return $this->belongsTo(RecipientDetail::class, 'recipient_detail_id');
    }
    

    public function pictures()
    {
        return $this->hasMany(ProductPictures::class, 'product_id', 'item_id');
    }
}
