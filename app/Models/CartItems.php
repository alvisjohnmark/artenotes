<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CartItems extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'item_id', 'item_type', 'quantity', 'price', 'total_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function pictures()
    {
        return $this->hasMany(ProductPictures::class, 'product_id', 'item_id');
    }
}
