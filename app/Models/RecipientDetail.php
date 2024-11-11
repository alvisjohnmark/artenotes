<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientDetail extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'client_id',
        'font',
        'recipient_name',
        'province',
        'city_municipality',
        'barangay',
        'street',
        'message',
        'has_rose',
        'envelope_color',
    ];
    public function orderItem()
    {
        return $this->hasOne(OrderItems::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
