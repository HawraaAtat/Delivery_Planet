<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;



    protected $fillable = [
        'user_id',
        'restaurant_id',
        'title',
        'body',
        'rating',
    ];


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
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


}
