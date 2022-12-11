<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;

class HomeController extends Controller
{
    //
    public function index()
    {

        //order_time to know the most popular menu
        $menu = Menu::where("confirmed",true)->orderBy("order_time","desc")->get()->take(6);
        $restaurants = Restaurant::where("confirmed",true)->orderBy("id","desc")->get()->take(8);
        return view('home.home', compact('restaurants','menu'));
    }

}
