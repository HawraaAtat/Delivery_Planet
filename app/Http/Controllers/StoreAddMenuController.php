<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class StoreAddMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $user=User::find(session('store_id'));
        $menu = $user->restaurant->menus;
        return view('store.manage.menu_list',compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.manage.menu_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user=User::find(session('store_id'));
        $restaurant_id = $user->restaurant->id;

        $request->validate([
            'menu_name' => 'required|min:3|max:50',
            'price' => 'required|numeric',
            'calorie_count' => 'required|numeric',
            'diet' => 'required',
            'cuisine' => 'required',
            'description' => 'required|min:3|max:150',
            "fileToUpload"=> 'required',
        ]);

        $menu_name = $request->menu_name;
        $price = $request->price;
        $calorie_count = $request->calorie_count;
        $diet = $request->diet;
        $cuisine = $request->cuisine;
        $description = $request->description;
        $image = $request->image;
        
        $fileName = $request->file("fileToUpload")->GetClientOriginalName();
        $file = $request->file('fileToUpload')->move('img',$fileName);
        
        
        $menu = Menu::create([
            'restaurant_id' => $restaurant_id,
            'menu_name' => $menu_name,
            'price' => $price,
            'calorie_count' => $calorie_count,
            'diet' => $diet,
            'cuisine' => $cuisine,
            'description' => $description,
            'image' => $fileName ,
            'confirmed' => true,
        ]);

        
        return redirect('/menu_add')->with('flash' , 'Your Plate is added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu= Menu::find($id);
        return view('store.manage.menu_edit', compact('menu'));
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
        

        $request->validate([
            'menu_name' => 'required|min:3|max:50',
            'price' => 'required|numeric',
            'calorie_count' => 'required|numeric',
            'diet' => 'required',
            'cuisine' => 'required',
            'description' => 'required|min:3|max:150',
            "fileToUpload"=> 'required',
        ]);

        $menu_name = $request->menu_name;
        $price = $request->price;
        $calorie_count = $request->calorie_count;
        $diet = $request->diet;
        $cuisine = $request->cuisine;
        $description = $request->description;
        $image = $request->image;
        
        $fileName = $request->file("fileToUpload")->GetClientOriginalName();
        $file = $request->file('fileToUpload')->move('img',$fileName);
        
        
        $menu = Menu::find($id);

        $menu->menu_name = $menu_name;
        $menu->price = $price;
        $menu->calorie_count = $calorie_count;
        $menu->diet = $diet;
        $menu->cuisine = $cuisine;
        $menu->description = $description;
        $menu->image = $fileName;

        $menu->save();

        
        return redirect('/menu_add')->with('flash' , 'Your Plate is updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::destroy($id);
        return redirect('/menu_add')->with('flash' , 'Your Menu is deleted successfully!');
    }
}
