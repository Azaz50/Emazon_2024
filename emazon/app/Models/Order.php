<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'orders';

    protected $fillable = [
        'rzp_order_id',
        'amount',
        'gross_total',
        'sub_total',
        'discount',
        'user_id',
        'tax',
        'shipment',
        'applied_coupon_id',
        'status',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
        // return $this->hasMany(OrderItem::class, 'order_id');
    }

    
}
