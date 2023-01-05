<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class StoreAddRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("store.restaurant.restaurant_add");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=User ::find(session('store_id'));
        

        $request->validate([
            'restaurant_name' => 'required|min:3|max:50',
            'cuisine' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:150',
            "fileToUpload"=> 'required',
        ]);

        $restaurant_name = $request->restaurant_name;
        $cuisine = $request->cuisine;
        $description = $request->description;
        
        $image = $request->image;
        
        $fileName = $request->file("fileToUpload")->GetClientOriginalName();
        $file = $request->file('fileToUpload')->move('img',$fileName);
        
        
        $restaurant = Restaurant::create([
            'restaurant_name' => $restaurant_name,
            'cuisine' => $cuisine,
            'description' => $description,
            'image' => $fileName ,
            'confirmed' => true,
        ]);

        //eza eena restaurant abel
        if($user->restaurant){
        //am nemhe l restaurant l admin maa l rationship taba3o w nzid wahad jdid
        Restaurant::destroy($user->restaurant->id);
        $user->restaurant()->update(['user_id' => null]);
        $user->restaurant()->save($restaurant);
        $user->save();
        return redirect('/store_home')->with('flash' , 'Your Restaurant is updated successfully!');
        }else{
            $user->restaurant()->save($restaurant);
            $user->save();
            return redirect('/store_home')->with('flash' , 'Your Restaurant is created successfully!');
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
