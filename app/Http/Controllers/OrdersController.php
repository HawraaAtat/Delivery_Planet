<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Location;
use App\Models\OrderItems;
use Carbon\Carbon;


class OrdersController extends Controller
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

        $request->validate([
            'shipping_type' => 'required',
            'address' => 'required',
            'date_time' => 'required',
        ]);


        $user_id = session('user_id');

        $order = new Orders([
            'user_id' => $user_id,
            "total_amount" => $request->total_price,
            "shipping_type" => $request->shipping_type,
            "address" => $request->address,
            "order_date" => $request->input('date_time')

        ]);



        // Save the order to the database
        $order->save();

        // Get all items in the cart for the user
        $cart = Cart::where('user_id', session('user_id'))->get();

        $cart_count = Cart::all()->count();


        if ($cart_count) {

            foreach ($cart as $rec) {


                $orderItem = new OrderItems([


                    'menu_id' => $rec->menu_id,
                    'order_id' => $order->id,
                    'menu_name' => $rec->menu_name,
                    'price' => $rec->price,
                    'calorie_count' => $rec->calorie_count,
                    'diet' => $rec->diet,
                    'cuisine' => $rec->cuisine,

                    'description' => $rec->description,
                    'image' => $rec->image,
                    'confirmed' => $rec->confirmed,
                    'has_offer' => $rec->has_offer,
                    'quantity' => $rec->quantity,


                ]);

                // Attach the cart items to the order
                $order->orderItems()->save($orderItem);

                // adding the order time in the menu to determine the most oredered item
                $menu = Menu::find($rec->menu_id);
                $menu->order_time = $menu->order_time + 1;
                $menu->save();
            }


            // Clear the cart
            Cart::where('user_id', session('user_id'))->delete();







            $user_id = session('user_id');
            $user = User::find($user_id);

            if ($user != null) {
                if ($user->cart) {
                    $item_cart_count = $user->cart->count();
                } else {
                    $item_cart_count = 0;
                }
            }



            if ($request->shipping_type == "Standard") {

                // return view("cart.payment",compact('item_cart_count'));
                return redirect('/stripe');
            } else if ($request->shipping_type == "Local") {

                // $orders = Orders::where('user_id',  session('user_id'))->get();
                $orderr = Orders::find($order->id);

                return view("cart.order", compact('item_cart_count', 'orderr'));
            }
        } else {

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


                return view("cart.cart_view_error", compact('cart', 'count', 'total', 'item_cart_count'));
            } else {
                return view("cart.cart_view_error", compact('cart', 'count', 'total'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return "hi". $id;

        $user_id = session('user_id');
        $user = User::find($user_id);


        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }


            $orderr = Orders::find($id);
            $orderItem = OrderItems::where("order_id", $orderr->id)->get();
            // return $orderItem;

            return view("cart.order_details", compact('item_cart_count', 'orderItem', 'orderr'));
        } else {
            $orderr = Orders::find($id);
            $orderItem = OrderItems::where("order_id", $orderr->id)->get();
            // return $orderItem;

            return view("cart.order_details", compact('orderItem', 'orderr'));
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
        // return $id;
        //
        $user_id = session('user_id');
        $user = User::find($user_id);


        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            $orderr = Orders::find($id);

            return view("cart.order", compact('item_cart_count', 'orderr'));
        } else {
            $orderr = Orders::find($id);

            return view("cart.order", compact('orderr'));
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
