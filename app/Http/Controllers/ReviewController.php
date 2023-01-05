<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
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

        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }


            $restaurant = Restaurant::find($id);
            return view('restaurant.review_add', compact('restaurant', 'item_cart_count'));
        } else {
            $restaurant = Restaurant::find($id);
            return view('restaurant.review_add', compact('restaurant'));
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
        //
        $user_id = session('user_id');
        $user = User::find($user_id);


        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            $restaurant = Restaurant::find($id);

            $review = $restaurant->reviews;
            return view('restaurant.review', compact('review', 'restaurant', 'item_cart_count'));
        } else {
            $restaurant = Restaurant::find($id);

            $review = $restaurant->reviews;
            return view('restaurant.review', compact('review', 'restaurant', 'item_cart_count'));
        }
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

        $request->validate([
            'title' => 'required',
            'rate' => 'required',
            'content' => 'required',
        ]);

        $title = $request->title;
        $rate = $request->rate;
        $content = $request->content;


        $restaurant = Restaurant::find($id);



        $reviewww = Review::create([
            'user_id' => session('user_id'),
            'restaurant_id' => $restaurant->id,
            'title' => $title,
            'body' => $content,
            'rating' => $rate
        ]);




        $restaurant->reviews()->save($reviewww);

        $review = $restaurant->reviews()->get();


        $user_id = session('user_id');
        $user = User::find($user_id);


        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view('restaurant.review', compact('review', 'restaurant', 'item_cart_count'));
        } else {
            return view('restaurant.review', compact('review', 'restaurant'));
        }
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
}
