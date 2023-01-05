<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Orders;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class StoreOrdersManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user=User::find(session('store_id'));
        $restaurant_id = $user->restaurant->id;
        


        $deliveries= Orders::where("shipping_type","Standard")->get();
        $orders= Orders::where("shipping_type","Local")->get();

        return view("store.manage.orders_manage", compact("deliveries","orders"));
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

        $order = Orders::find($id);
        $order->status="delivered";
        $order->save();
        return redirect('/orders_manage');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Orders::find($id);
        $order->status="completed";
        $order->save();
        return redirect('/orders_manage');
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
