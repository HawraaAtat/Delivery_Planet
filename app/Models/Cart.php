<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'user_id',

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

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

   
}
