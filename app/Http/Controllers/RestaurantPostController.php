<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;
use App\Models\User;

class RestaurantPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = session('user_id');
        $user = User::find($user_id);

        $restaurant = Restaurant::find($id);
        $review = $restaurant->reviews()->avg('rating');
        //hun enu kam meal eendo l restaurant (relationship)
        $menu = $restaurant->menus()->count();


        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view('restaurant.restaurant_details', compact('restaurant', 'review', 'menu', 'item_cart_count'));
        } else {
            return view('restaurant.restaurant_details', compact('restaurant', 'review', 'menu'));
        }
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function add_review($id)
    {
    }



    public function search_restaurant(Request $request)
    {

        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }
            //
            $restaurant_name = $request->search_name;
            $restaurants = Restaurant::where("confirmed", true)
                ->where('restaurant_name', 'like', '%' . $restaurant_name . '%')
                ->get();

            return view('search.restaurant.restaurant_search', compact('restaurants', 'request', 'item_cart_count'));
        } else {
            $restaurant_name = $request->search_name;
            $restaurants = Restaurant::where("confirmed", true)
                ->where('restaurant_name', 'like', '%' . $restaurant_name . '%')
                ->get();
            return view('search.restaurant.restaurant_search', compact('restaurants', 'request'));
        }
    }
}
