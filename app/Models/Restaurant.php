<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'location_id',
        'restaurant_name',
        'cuisine',
        'image',
        'description',
        'confirmed',
    ];



    public function menus()
    {
        return $this->hasMany(Menu::class,'restaurant_id');
    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }



    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    // $product = Product::find($id);
    // $reviews = $product->reviews;
    //
    // $review = Review::find($id);
    // $product = $review->product;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // $user = User::find(1);
    // $restaurant = $user->restaurant;
    // //
    // $restaurant = Restaurant::find(1);
    // $user = $restaurant->user;

}
