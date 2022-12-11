<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'restaurant_name',
        'password',
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
        return $this->hasOne(Location::class);
    }


}
