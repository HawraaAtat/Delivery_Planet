<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'menu_name',
        'price',
        'calorie_count',
        'diet',
        'cuisine',
        'description',
        'order_time',
        'image',
        'confirmed',
        'has_offer',
        'new_price',
        'quantity',
    ];



    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
     // $menu = Menu::find(1);
    // $orderItems = $menu->orderItems;

    // //
    // $menu = Menu::find(1);
    // $orderItem = new OrderItem();
    // $orderItem->name = 'Pizza';
    // $orderItem->price = 15;
    // $menu->orderItems()->save($orderItem);



}
