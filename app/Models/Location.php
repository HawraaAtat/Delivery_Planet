<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    protected $fillable = [
        'country',
        'city',
        'state',
        'building',
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
