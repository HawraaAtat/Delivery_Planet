<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home",[HomeController::class,'index']);

// Route::get("/search",[MyController::class,'search']);

// Route::resource("movie",MyController::class);















/////////////////  data fill  ////////////////////
Route::get('datafill', function () {

    $restaurant = Restaurant::create([
        'location_id'=>1,
        'restaurant_name'=>'macdo',
        'password'=>'macdo123',
        'cuisine'=>'japanese',
        'description'=>'i am a retaurant',
        'image'=>'restaurant-1.jpg',
        'confirmed'=>true,
    ]);
    $restaurant = Restaurant::create([
        'location_id'=>1,
        'restaurant_name'=>'macdooooo',
        'password'=>'maadgcdo13',
        'cuisine'=>'japanessse',
        'description'=>'i am a retaurant',
        'image'=>'restaurant-3.jpg',
        'confirmed'=>true,
    ]);
    $restaurant = Restaurant::create([
        'location_id'=>2,
        'restaurant_name'=>'macdooo',
        'password'=>'macdo123',
        'cuisine'=>'japanessssssse',
        'description'=>'i am a retaurant',
        'image'=>'restaurant-2.jpg',
        'confirmed'=>true,
    ]);

    $menu = Menu::create([
        'restaurant_id'=>1,
        'menu_name'=>'Big Mac',
        'price'=>'15',
        'calorie_count'=>'556.45',
        'category'=>'keto',
        'description'=>'The Big Mac is a hamburger sold by the international fast food restaurant chain McDonald\'s. It was introduced in the Greater Pittsburgh area in 1967 and across the United States in 1968. It is one of the company\'s flagship products and signature dishes.',
        'order_time'=>9,
        'image'=>'menu-2.jpg',
        'confirmed'=>true,
    ]);

    $menu = Menu::create([
        'restaurant_id'=>2,
        'menu_name'=>'Big Macc',
        'price'=>'15',
        'calorie_count'=>'556.45',
        'category'=>'keto',
        'description'=>'The Big Mac is a hamburger sold by the international fast food restaurant chain McDonald\'s. It was introduced in the Greater Pittsburgh area in 1967 and across the United States in 1968. It is one of the company\'s flagship products and signature dishes.',
        'order_time'=>4,
        'image'=>'menu-5.jpg',
        'confirmed'=>true,
    ]);
    $menu = Menu::create([
        'restaurant_id'=>3,
        'menu_name'=>'Big Macccc',
        'price'=>'15',
        'calorie_count'=>'556.45',
        'category'=>'keto',
        'description'=>'The Big Mac is a hamburger sold by the international fast food restaurant chain McDonald\'s. It was introduced in the Greater Pittsburgh area in 1967 and across the United States in 1968. It is one of the company\'s flagship products and signature dishes.',
        'order_time'=>3,
        'image'=>'menu-6.jpg',
        'confirmed'=>true,
    ]);

    $location = Location::create([
        'country'=>'Lebanon',
        'city'=>'Beirouth',
        'state'=>'Beirouth',
        'building'=>'Building 1',
    ]);

    echo $restaurant;
    echo $menu;
    echo $location;


});
Route::get('relationship', function () {
    $restaurant =Restaurant::find(2);
    $menu =Menu::find(1);
    $restaurant->menus()->save($menu);

    return $restaurant->menus;

});
