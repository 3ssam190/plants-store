<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'payment_status',
        // other fields...
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}