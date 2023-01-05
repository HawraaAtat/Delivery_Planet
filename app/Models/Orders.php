<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
    "user_id",
    "total_amount",
    "shipping_type",
    "address",
    "status",
    "order_date",
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }



    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, "order_id");
    }
    // $order = Order::find(1);
    // $orderItems = $order->orderItems;

    // //

    // $orderItem = OrderItem::find(1);
    // $order = $orderItem->order;

}

