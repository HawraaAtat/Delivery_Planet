<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'order_id',

        'menu_name',
        'price',
        'calorie_count',
        'diet',
        'cuisine',
        'description',
        'image',
        'confirmed',
        'has_offer',
        'quantity',
        
    ];



    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // $menu = Menu::find(1);
    // $orderItems = $menu->orderItems;

    // //
    // $menu = Menu::find(1);
    // $orderItem = new OrderItem();
    // $orderItem->name = 'Pizza';
    // $orderItem->price = 15;
    // $menu->orderItems()->save($orderItem);

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
    // $order = Order::find(1);
    // $orderItems = $order->orderItems;

    // //

    // $orderItem = OrderItem::find(1);
    // $order = $orderItem->order;

}
