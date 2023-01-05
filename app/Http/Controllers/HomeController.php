<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;
use App\Models\User;

class HomeController extends Controller
{
    //
    public function index()
    {

        //order_time to know the most popular menu
        $menu = Menu::where("confirmed", true)->orderBy("order_time", "desc")->get()->take(6);
        $restaurants = Restaurant::where("confirmed", true)->orderBy("id", "desc")->get()->take(8);

        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view('home.home', compact('restaurants', 'menu', 'item_cart_count'));
        } else {
            return view('home.home', compact('restaurants', 'menu'));
        }
    }


    public function admin_home()
    {
        return view('admin.home.admin_home');
    }

    public function store_home()
    {
        return view('store.home.store_home');
    }

    public function user_home(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('Email', '=', $email)->first();


        $data = $request->input();
        $request->session()->put('user', $user->name);
        $menu = Menu::where("confirmed", true)->orderBy("order_time", "desc")->get()->take(6);
        $restaurants = Restaurant::where("confirmed", true)->orderBy("id", "desc")->get()->take(8);

        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view('home.user_home', compact('restaurants', 'menu', 'item_cart_count'));
        } else {
            return view('home.user_home', compact('restaurants', 'menu'));
        }
    }


    public function about()
    {
        $menu = Menu::where("confirmed", true)->get()->count();
        $restaurants = Restaurant::where("confirmed", true)->get()->count();


        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view('about.about', compact('restaurants', 'menu', 'item_cart_count'));
        } else {
            return view('about.about', compact('restaurants', 'menu'));
        }
    }

    public function menu()
    {
        //order_time to know the most popular menu
        $menu = Menu::where("confirmed", true)->orderBy("order_time", "desc")->get()->take(20);


        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }


            return view('menu.menu', compact('menu', 'item_cart_count'));
        } else {

            return view('menu.menu', compact('menu'));
        }
    }

    public function restaurant()
    {
        $restaurants = Restaurant::where("confirmed", true)->get()->take(20);


        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view('restaurant.restaurant', compact('restaurants', 'item_cart_count'));
        } else {
            return view('restaurant.restaurant', compact('restaurants'));
        }
    }
}
