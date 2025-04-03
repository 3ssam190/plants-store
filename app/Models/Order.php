<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected $casts = [
        'payment_verified' => 'boolean',
        'payment_date' => 'datetime',
    ];
    
    protected $fillable = [
        // ... other fields
        'payment_verified',
        'payment_method', 
        'payment_date'
    ];
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}