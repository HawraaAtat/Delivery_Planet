<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = session('user_id');
        $user = User::find($user_id);

        $cart = Cart::where('user_id', $user_id)->get();
        $count = Cart::all()->count();

        $total = Cart::where('user_id', $user_id)->sum('price');


        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }


            return view("cart.cart_view", compact('cart', 'count', 'total', 'item_cart_count'));
        } else {
            return view("cart.cart_view", compact('cart', 'count', 'total'));
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Cart::find($id)->delete();

        
        $user_id = session('user_id');
        $user = User::find($user_id);

        $cart = Cart::where('user_id', $user_id)->get();
        $count = Cart::all()->count();

        $total = Cart::where('user_id', $user_id)->sum('price');



        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view("cart.cart_view", compact('cart', 'count', 'total', 'item_cart_count'));
        } else {
            return view("cart.cart_view", compact('cart', 'count', 'total'));
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
        // $user = User::find(3);

        // $cart= Cart::create(['user_id',3]);
        // echo $user->cart()->save($cart);
        // return $user->cart()->get();
        $menu = Menu::find($id);
        $user_id = session('user_id');
        $item_number = $request->item_number;
        $user = User::find($user_id);


        $cart = Cart::create([
            'menu_id' => $menu->id,
            'user_id' => $user_id,

            'menu_name' => $menu->menu_name,
            'price' => $menu->price * $item_number,
            'calorie_count' => $menu->calorie_count,
            'diet' => $menu->diet,
            'cuisine' => $menu->cuisine,
            'description' => $menu->description,
            'image' => $menu->image,
            'confirmed' => $menu->confirmed,
            'has_offer' => $menu->has_offer,
            'quantity' => $item_number,
        ]);


        // $user->menus()->save($menu);
        // $user->menus()->quantity= $item_number ;

        $menu = Menu::find($id);

        if ($user != null) {

            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }


            return view('menu.Meal_details', compact('menu', 'item_cart_count'));
        } else {
            return view('menu.Meal_details', compact('menu'));
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
    }
}
